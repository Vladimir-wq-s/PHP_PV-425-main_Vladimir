<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BrandController extends Controller
{
    // 1. Вывести все бренды (с пагинацией по 10 штук)
    public function index(): View
    {
        $brands = Brand::query()->paginate(10);
        return view('brands.index', compact('brands'));
    }

    // Показать форму для создания нового бренда
    public function create(): View
    {
        return view('brands.create');
    }

    // 2. Добавить новый бренд в базу данных
    public function store(BrandStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        // Автоматически генерируем слаг ЧПУ из названия бренда
        $validated['slug'] = Str::slug($validated['name']);

        Brand::create($validated);

        return redirect()->route('brands.index')->with('success', 'Бренд успешно создан!');
    }

    // 3. Вывести один конкретный бренд
    public function show(Brand $brand): View
    {
        return view('brands.show', compact('brand'));
    }

    // Показать форму для редактирования бренда
    public function edit(Brand $brand): View
    {
        return view('brands.edit', compact('brand'));
    }

    // 4. Обновить данные бренда в базе
    public function update(BrandUpdateRequest $request, Brand $brand): RedirectResponse
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['name']);

        $brand->update($validated);

        return redirect()->route('brands.index')->with('success', 'Бренд успешно обновлен!');
    }

    // 5. Удалить бренд из базы данных
    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();
        return redirect()->route('brands.index')->with('success', 'Бренд успешно удален!');
    }
}
