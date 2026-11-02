<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
Route::get('/menu/{menu}', [MenuController::class, 'show'])->name('menu.show');
Route::get('/christmas', [MenuController::class, 'christmas'])->name('christmas');

Route::get('/category', [CategoryController::class, 'category'])->name('category');

Route::get('/contact', [ContactController::class, 'contact'])->name('contact');
