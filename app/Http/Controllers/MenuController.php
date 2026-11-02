<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /** Everyday menu, optionally filtered with ?category=tarts */
    public function menu(Request $request)
    {
        $categories = Category::ordered()
            ->whereHas('menus', fn ($q) => $q->general()->available())
            ->get();

        $active = $categories->firstWhere('slug', $request->query('category'));

        $menus = Menu::general()->available()
            ->with('category')
            ->when($active, fn ($q) => $q->where('category_id', $active->id))
            ->ordered()
            ->get();

        // Group by category (in category order) for the "All" view.
        $groups = $categories
            ->map(fn ($category) => [
                'category' => $category,
                'menus' => $menus->where('category_id', $category->id)->values(),
            ])
            ->filter(fn ($group) => $group['menus']->isNotEmpty())
            ->values();

        $uncategorised = $menus->whereNull('category_id')->values();

        return view('menu', compact('categories', 'active', 'menus', 'groups', 'uncategorised'));
    }

    public function christmas()
    {
        $menus = Menu::christmas()->available()->with('category')->ordered()->get();

        $cakes = $menus->filter(fn ($m) => $m->category?->slug === 'cheesecakes')->values();
        $gifts = $menus->reject(fn ($m) => $m->category?->slug === 'cheesecakes')->values();

        return view('christmas', compact('menus', 'cakes', 'gifts'));
    }

    public function show(Menu $menu)
    {
        abort_unless($menu->is_available, 404);

        $menu->load('category');

        $related = Menu::available()
            ->where('catalog', $menu->catalog)
            ->whereKeyNot($menu->getKey())
            ->orderByRaw('category_id = ? desc', [$menu->category_id ?? 0])
            ->ordered()
            ->take(4)
            ->get();

        return view('menu-show', compact('menu', 'related'));
    }
}
