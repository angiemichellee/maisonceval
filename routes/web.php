<?php

use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Http\Controllers\CategoryController;
use App\Models\Contact;
use App\Http\Controllers\ContactController;
use App\Models\Home;
use App\Http\Controllers\HomeController;
use App\Models\Menu;
use App\Http\Controllers\MenuController;

Route::get('/category', 
    [CategoryController::class,'category']
);
Route::get('/contact', 
    [ContactController::class,'contact']
);
Route::get('/', 
    [HomeController::class,'home']
);
Route::get('/menu', 
    [MenuController::class,'menu']
);