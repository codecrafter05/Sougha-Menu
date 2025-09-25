<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;

// Main routes
Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/menu/{slug}', [ProductController::class, 'category'])->name('menu.category');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');

// Keep API route for backward compatibility (if needed)
Route::get('/api/menu', [MenuController::class, 'menu']);

Route::get('/links', function () {
    return view('linkTree');
});