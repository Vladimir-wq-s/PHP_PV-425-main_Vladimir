<?php

use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CartController;
use App\Mail\OrderShippedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// Главная страница приложения
Route::get('/', [HomeController::class, 'index'])->name('home');

// Системный роут корзины
Route::get('/basket', [BasketController::class, 'index'])->name('basket');

// Маршруты для управления мягким удалением продуктов (Soft Deletes)
Route::get('products/trashed', [ProductController::class, 'trashed'])->name('products.trashed');
Route::post('products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');

// Стандартные ресурсные CRUD маршруты
Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('tags', TagController::class);

// Маршруты для страницы вывода корзины /cart и уменьшения количества товаров
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{id}/decrease', [CartController::class, 'decrease'])->name('cart.decrease');

// Защита маршрутов брендов через созданный Гейт (Доступ только для админа)
Route::resource('brands', BrandController::class)->middleware('can:view-admin-panel');

// Маршрут для тестирования отправки почты через систему очередей
Route::get('/send-test-mail', function () {
    Mail::to('test@example.com')->send(new OrderShippedMail());

    return 'Письмо успешно добавлено в очередь!';
});
