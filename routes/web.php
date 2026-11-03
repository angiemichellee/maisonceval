<?php

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/catalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/catalog/{catalog}', [CatalogController::class, 'show'])->name('catalog.show');

Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');

// Old addresses, kept so existing links still work.
Route::get('/category', [CategoryController::class, 'category'])->name('category');
Route::redirect('/christmas', '/catalog/christmas', 301)->name('christmas');
