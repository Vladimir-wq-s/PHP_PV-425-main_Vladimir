<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagRequest;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TagController extends Controller
{
    // 1. Вывод всех тегов
    public function index(): View
    {
        $tags = Tag::query()->paginate(15);
        return view('tags.index', compact('tags'));
    }

    // Форма создания тега
    public function create(): View
    {
        $products = Product::query()->get(); // Выбираем продукты для привязки в форме
        return view('tags.create', compact('products'));
    }

    // 2. Добавление тега + Перехват IP в Pivot
    public function store(TagRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Создание самого тега
        $tag = Tag::create($validated);

        // Если выбраны продукты, привязываем их и записываем IP пользователя в pivot-таблицу
        if (!empty($validated['products'])) {
            $pivotData = [];
            foreach ($validated['products'] as $productId) {
                // $request->ip() автоматически определяет IP-адрес того, кто отправляет форму
                $pivotData[$productId] = ['ip' => $request->ip()];
            }
            $tag->products()->attach($pivotData);
        }

        return redirect()->route('tags.index')->with('success', 'Тег успешно создан с записью IP в pivot!');
    }

    // 3. Вывод одного тега
    public function show(Tag $tag): View
    {
        return view('tags.show', compact('tag'));
    }

    // Форма редактирования тега
    public function edit(Tag $tag): View
    {
        $products = Product::query()->get();
        return view('tags.edit', compact('tag', 'products'));
    }

    // 4. Обновление тега + Обновление IP в Pivot
    public function update(TagRequest $request, Tag $tag): RedirectResponse
    {
        $validated = $request->validated();

        $tag->update($validated);

        // Синхронизация связи - Продукты-теги с подстановкой актуального IP
        if (isset($validated['products'])) {
            $pivotData = [];
            foreach ($validated['products'] as $productId) {
                $pivotData[$productId] = ['ip' => $request->ip()];
            }
            $tag->products()->sync($pivotData);
        } else {
            $tag->products()->detach();
        }

        return redirect()->route('tags.index')->with('success', 'Тег успешно обновлен!');
    }

    // 5. Удаление тега
    public function destroy(Tag $tag): RedirectResponse
    {
        $tag->products()->detach(); // Очищение связи перед удалением
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Тег успешно удален!');
    }
}
