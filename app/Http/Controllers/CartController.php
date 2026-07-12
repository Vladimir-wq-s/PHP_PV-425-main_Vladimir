<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    // Просмотр содержимого корзины по адресу /cart
    public function index(Request $request): View
    {
        // Извлекаем массив корзины из сессии
        $cart = $request->session()->get('cart', []);

        $cartItems = [];
        $totalPrice = 0;

        if (!empty($cart)) {
            // Выбираем из базы данных только те продукты, ID которых есть в корзине
            $products = Product::query()->whereIn('id', array_keys($cart))->get();

            foreach ($products as $product) {
                $quantity = $cart[$product->id];
                $subtotal = $product->price * $quantity;
                $totalPrice += $subtotal;

                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    // Уменьшение количества товара в корзине на 1 единицу
    public function decrease(Request $request, string $id): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);

        // Если товар присутствует в сессии корзины
        if (isset($cart[$id])) {
            $cart[$id]--;

            // Если количество упало до нуля или ниже, полностью удаляем товар из корзины
            if ($cart[$id] <= 0) {
                unset($cart[$id]);
            }

            // Перезаписываем обновленный массив корзины обратно в сессию
            $request->session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Количество товара успешно уменьшено.');
    }
}
