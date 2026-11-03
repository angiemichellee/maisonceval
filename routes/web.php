<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

// One catalog and its products, e.g. /catalog/christmas
Route::get('/catalog/{catalog}', [CatalogController::class, 'show'])->name('catalog.show');

Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');

// Old addresses, kept so existing links and bookmarks still work.
Route::redirect('/catalog', '/#catalogs', 301);
Route::redirect('/category', '/#catalogs', 301);
Route::redirect('/contact', '/#contact', 301);
Route::redirect('/christmas', '/catalog/christmas', 301);
