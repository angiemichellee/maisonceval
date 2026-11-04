<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Menu;

class CatalogController extends Controller
{
    // /catalog/christmas

    public function show($slug) {
        $catalog = Catalog::activeData()->firstWhere('slug', $slug); // dari active catalog simpan data pertama yg slugny sama

        return view('catalog', [
            'title' => $catalog->name . ' · Maison Céval', 
            'active' => 'catalog', // navbar activenya di catalog
            'catalog' => $catalog, // semua detail catalog yg sedang dibuka di kirim ke view
            'menus' => Menu::visible()->where('catalog_id', $catalog->id), // kl misal id katalog yg lg dibuka sama kyk id masing-masing menu
            'catalogs' => Catalog::activeData(), 
            'categories' => Category::all(),
            'contact' => Contact::current(),
        ]);
    }
}
