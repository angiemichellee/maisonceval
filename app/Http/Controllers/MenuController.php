<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    /** Every product, grouped by catalog. Filter with ?category=tarts */
    public function menu(Request $request)
    {
        $categories = Category::ordered()
            ->whereHas('menus', fn ($q) => $q->available()->inActiveCatalog())
            ->get();

        $active = $categories->firstWhere('slug', $request->query('category'));

        $menus = Menu::available()->inActiveCatalog()
            ->with(['category', 'catalog'])
            ->when($active, fn ($q) => $q->where('category_id', $active->id))
            ->ordered()
            ->get();

        // One section per catalog, in catalog order.
        $groups = Catalog::active()->ordered()->get()
            ->map(fn ($catalog) => [
                'catalog' => $catalog,
                'menus' => $menus->where('catalog_id', $catalog->id)->values(),
            ])
            ->filter(fn ($group) => $group['menus']->isNotEmpty())
            ->values();

        $uncatalogued = $menus->whereNull('catalog_id')->values();

        return view('menu', compact('categories', 'active', 'menus', 'groups', 'uncatalogued'));
    }

    /** One product: /menu/lemon-pie-tart */
    public function show(Menu $menu)
    {
        abort_unless($menu->is_available, 404);

        $menu->load(['category', 'catalog']);

        abort_if($menu->catalog && ! $menu->catalog->is_active, 404);

        $related = Menu::available()
            ->with(['category', 'catalog'])
            ->where('catalog_id', $menu->catalog_id)
            ->whereKeyNot($menu->getKey())
            ->orderByRaw('category_id = ? desc', [$menu->category_id ?? 0])
            ->ordered()
            ->take(4)
            ->get();

        return view('menu-show', compact('menu', 'related'));
    }
}
