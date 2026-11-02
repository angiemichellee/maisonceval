<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;

class HomeController extends Controller
{
    public function home()
    {
        $featured = Menu::general()->available()->featured()->ordered()->take(4)->get();

        $christmas = Menu::christmas()->available()->featured()->ordered()->take(4)->get();

        $categories = Category::ordered()
            ->withCount(['menus' => fn ($q) => $q->general()->available()])
            ->with(['menus' => fn ($q) => $q->general()->available()->ordered()])
            ->get();

        return view('home', compact('featured', 'christmas', 'categories'));
    }
}
