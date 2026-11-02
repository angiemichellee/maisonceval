<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;

class CategoryController extends Controller
{
    /** Overview of both catalogs and all categories. */
    public function category()
    {
        $categories = Category::ordered()
            ->withCount(['menus' => fn ($q) => $q->general()->available()])
            ->with(['menus' => fn ($q) => $q->general()->available()->ordered()])
            ->get();

        $catalogs = [
            [
                'name' => 'Everyday Menu',
                'tagline' => 'Our signature cheesecakes, tarts and little treats, all year round.',
                'url' => route('menu'),
                'count' => Menu::general()->available()->count(),
                'image' => asset('images/products/iceberg-cheesecake.jpg'),
                'festive' => false,
            ],
            [
                'name' => 'Christmas Collection',
                'tagline' => 'Holiday editions with a Merry Christmas topper, greeting card and ribbon.',
                'url' => route('christmas'),
                'count' => Menu::christmas()->available()->count(),
                'image' => asset('images/products/xmas-matcha-cheesecake.jpg'),
                'festive' => true,
            ],
        ];

        return view('category', compact('categories', 'catalogs'));
    }
}
