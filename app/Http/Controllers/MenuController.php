<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Menu;


class MenuController extends Controller {
    // SEMUA MENU
    public function index() {
        return view('menu', [
            'title' => 'Menu · Maison Céval',
            'active' => 'menu',
            'selected' => null,
            'menus' => Menu::visible(),
            'catalogs' => Catalog::activeData(),
            'categories' => Category::all(),
            'contact' => Contact::current(),
        ]);
    }




    // MENU PER KATEGORI /menu/category/tarts
    public function category($slug) {
        $selected = Category::all()->firstWhere('slug', $slug); //kategori yg dipilih

        return view('menu', [
            'title' => $selected->name . ' · Menu · Maison Céval',
            'active' => 'menu',
            'selected' => $selected,
            'menus' => Menu::visible()->where('category_id', $selected->id),
            'catalogs' => Catalog::activeData(),
            'categories' => Category::all(),
            'contact' => Contact::current(),
        ]);
    }




    // SATU MENU /menu/lemon-pie-tart
    public function show($slug) {
        $menu = Menu::visible()->firstWhere('slug', $slug); 

        return view('showmenu', [
            'title' => $menu->name . ' · Maison Céval',
            'active' => 'menu',
            'menu' => $menu,
            'catalog' => Catalog::all()->firstWhere('id', $menu->catalog_id),
            'category' => Category::all()->firstWhere('id', $menu->category_id),
            'related' => Menu::related($menu), // yg you may also like
            'catalogs' => Catalog::activeData(),
            'categories' => Category::all(),
            'contact' => Contact::current(),
        ]);
    }
}
