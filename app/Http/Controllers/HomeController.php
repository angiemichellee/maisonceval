<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;

class HomeController extends Controller
{
    public function home()
    {
        // Every active catalog (Everyday, Christmas, and any added later).
        $catalogs = Catalog::active()->ordered()
            ->withCount(['menus' => fn ($q) => $q->available()])
            ->get();

        // "Find your favourite": categories that have products to show.
        $categories = Category::ordered()
            ->withCount(['menus' => fn ($q) => $q->available()->inActiveCatalog()])
            ->with(['menus' => fn ($q) => $q->available()->inActiveCatalog()->ordered()])
            ->get()
            ->filter(fn ($category) => $category->menus_count > 0)
            ->values();

        return view('home', compact('catalogs', 'categories'));
    }
}
