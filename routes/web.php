<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', [HomeController::class, 'index']);

// One catalog and its products, e.g. /catalog/christmas
Route::get('/catalog/{slug}', [CatalogController::class, 'show']);

// Menu: all products, products of one category, and one product
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/category/{slug}', [MenuController::class, 'category']);
Route::get('/menu/{slug}', [MenuController::class, 'show']);

// Old addresses, so links people saved still work
Route::redirect('/catalog', '/#catalogs');
Route::redirect('/category', '/#catalogs');
Route::redirect('/contact', '/#contact');
Route::redirect('/christmas', '/catalog/christmas');
