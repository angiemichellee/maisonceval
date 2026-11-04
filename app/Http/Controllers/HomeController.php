<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Menu;

class HomeController extends Controller
{
    // Home page: hero, catalogs, find your favourite, how to order
    public function index()
    {
        return view('home', [
            'title' => 'Maison Céval · Pure Taste. Pure Class.',
            'active' => 'home',
            'catalogs' => Catalog::activeData(),
            'categories' => Category::all(),
            'menus' => Menu::visible(),
            'contact' => Contact::current(),
        ]);
    }
}
