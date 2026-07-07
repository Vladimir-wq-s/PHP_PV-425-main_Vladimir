<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::query()->get();

        return view('category.index', compact('categories'));
    }

    public function create(): View
    {
        return view('category.create');
    }

    // Изменили этот метод: добавили транзакцию и генерацию слага
    public function store(CategoryStoreRequest $categoryStoreRequest): RedirectResponse
    {
        $validated = $categoryStoreRequest->validated();

        // Оборачиваем в транзакцию базы данных (выполнение ДЗ)
        DB::transaction(function () use ($validated) {
            $validated['slug'] = Str::slug($validated['name']);
            Category::create($validated);
        });

        return redirect()->route('categories.index')->with('success', 'Категория создана через транзакцию!');
    }

    public function edit(Category $category): View
    {
        $allCategories = Category::query()->get();

        return view('category.edit', compact('category', 'allCategories'));
    }

    public function update(
        CategoryUpdateRequest $categoryUpdateRequest,
        Category              $category
    )
    {
        $category->update($categoryUpdateRequest->validated());

        return redirect()->back()->with('success', 'Категория обновлена!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
