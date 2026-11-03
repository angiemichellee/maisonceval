<?php

namespace App\Http\Controllers;

class CategoryController extends Controller
{
    /**
     * The old /category page was replaced by /catalog.
     * Old links and bookmarks are sent there.
     */
    public function category()
    {
        return redirect()->route('catalog.index', status: 301);
    }
}
