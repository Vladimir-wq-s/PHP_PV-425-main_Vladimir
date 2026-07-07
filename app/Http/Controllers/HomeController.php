<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->get();
        $products = Product::query()->paginate(10);

        return view('home', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
