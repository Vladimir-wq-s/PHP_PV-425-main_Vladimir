<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// Главная страница приложения
Route::get('/', [HomeController::class, 'index'])->name('home');

// Корзина покупателя
Route::get('/basket', [BasketController::class, 'index'])->name('basket');

// Маршруты для управления мягким удалением продуктов (Soft Deletes)
Route::get('products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

// Стандартные ресурсные CRUD маршруты для продуктов, категорий и брендов
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('brands', BrandController::class);

// Ресурсные CRUD маршруты для управления тегами
Route::resource('tags', TagController::class);
