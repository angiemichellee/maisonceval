<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Menu;

class HomeController extends Controller
{
    // Home page: hero, catalogs, find your favourite, how to order
    public function index() {
        return view('home', [ // ke page home.blade
            'title' => 'Maison Céval · Pure Taste. Pure Class.', // variable title bawa data 
            'active' => 'home',
            'catalogs' => Catalog::activeData(), // variable catalog mengambil dan menampilkan data dari model
            'categories' => Category::all(),
            'menus' => Menu::visible(),
            'contact' => Contact::current(),
        ]);
    }
}
