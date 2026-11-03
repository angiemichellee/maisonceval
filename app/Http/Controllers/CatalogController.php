<?php

namespace App\Http\Controllers;

use App\Models\Catalog;

class CatalogController extends Controller
{
    /** All catalogs: /catalog */
    public function index()
    {
        $catalogs = Catalog::active()->ordered()
            ->withCount(['menus' => fn ($q) => $q->available()])
            ->get();

        return view('catalogs', compact('catalogs'));
    }

    /** One catalog and its products: /catalog/christmas */
    public function show(Catalog $catalog)
    {
        abort_unless($catalog->is_active, 404);

        $menus = $catalog->menus()->available()
            ->with(['category', 'catalog'])
            ->ordered()
            ->get();

        // Group the products by category, in category order.
        $groups = $menus
            ->groupBy(fn ($menu) => $menu->category_id ?? 0)
            ->sortBy(fn ($items) => [$items->first()->category?->sort_order ?? PHP_INT_MAX, $items->first()->category?->name])
            ->map(fn ($items) => ['category' => $items->first()->category, 'menus' => $items->values()])
            ->values();

        $otherCatalogs = Catalog::active()->ordered()
            ->whereKeyNot($catalog->getKey())
            ->withCount(['menus' => fn ($q) => $q->available()])
            ->get();

        return view('catalog', compact('catalog', 'menus', 'groups', 'otherCatalogs'));
    }
}
