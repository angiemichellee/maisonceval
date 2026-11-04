<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Menu;

class CatalogController extends Controller
{
    // One catalog and its products, e.g. /catalog/christmas
    public function show($slug)
    {
        $catalog = Catalog::activeData()->firstWhere('slug', $slug);

        return view('catalog', [
            'title' => $catalog->name . ' · Maison Céval',
            'active' => 'catalog',
            'catalog' => $catalog,
            'menus' => Menu::visible()->where('catalog_id', $catalog->id),
            'catalogs' => Catalog::activeData(),
            'categories' => Category::all(),
            'contact' => Contact::current(),
        ]);
    }
}
