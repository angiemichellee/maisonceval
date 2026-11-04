<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

// Home page
// kalo alamat "/" ke homecontroller dan panggil function index
Route::get('/', [HomeController::class, 'index']);

// One catalog and products
// alamat "/catalog/{kayak id tapi dalam huruf}" ke catalog controller panggil function show
Route::get('/catalog/{slug}', [CatalogController::class, 'show']);

// Menu: all products, products of one category, and one product
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu/category/{slug}', [MenuController::class, 'category']); // nampilin perkategori tart, cake
Route::get('/menu/{slug}', [MenuController::class, 'show']); // per produk

// Old addresses, so links people saved still work
// langsung mengarahkan ke tujuan, tanpa pindah page dan membawa data
// Route::redirect('/catalog', '/#catalogs');
// Route::redirect('/category', '/#catalogs');
// Route::redirect('/contact', '/#contact');
// Route::redirect('/christmas', '/catalog/christmas');
