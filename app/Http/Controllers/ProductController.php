<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    private const PER_PAGE = 12;

    public function index(Request $request)
    {
        $sort = $request->get('sort', 'price');
        $arrayOrderBy = explode('_', $sort);
        $direction = last($arrayOrderBy) == 'asc' ? 'desc' : 'asc';
        if (count($arrayOrderBy) > 1) {
            unset($arrayOrderBy[count($arrayOrderBy) - 1]);
        }
        $columnName = implode('_', $arrayOrderBy);

        $products = Product::Filter($request)
            ->orderBy($columnName, $direction)
            ->paginate(self::PER_PAGE);

        $categories = Category::OnlySubCategories()->get();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->whereNotNull('parent_id')->get();
        $tags = Tag::Active()->get();

        return view('products.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $image->store('products', 'public');
            $validated['image'] = 'storage/' . $imageName;
        }

        DB::beginTransaction();
        try {
            $product = Product::create($validated);
            $product->tags()->attach($request->tags);

            DB::commit();
            return redirect()->route('products.index')
                ->with('success', 'Продукт успешно создан!');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::critical($exception->getMessage());

            if (isset($validated['image']) && File::exists($validated['image'])) {
                File::delete($validated['image']);
            }
            return redirect()->back();
        }
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        $tags = Tag::Active()->get();
        return view('products.edit',
            compact('product', 'categories', 'tags'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0|max:999999.99',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $image = $request->file('image');
            $imageName = Str::slug($request->name) . '-' . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imageName);
            $validated['image'] = 'storage/products/' . $imageName;
        }

        DB::beginTransaction();
        try {
            $product->update($validated);
            $product->tags()->sync($request->tags);
            DB::commit();
        } catch (\Exception $exception) {
            Log::critical($exception->getMessage());
            DB::rollBack();
            return redirect()->back();
        }

        return redirect()->back()
            ->with('success', 'Продукт успешно обновлен!');
    }

    // Мягкое удаление (Мягко скрывает продукт из базы данных)
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete(); // Благодаря SoftDeletes заполнит только поле deleted_at

        return redirect()->route('products.index')
            ->with('success', 'Продукт успешно перемещен в корзину удаленных!');
    }

    // Новое ДЗ: Вывести список всех мягко удаленных продуктов
    public function trashed(): View
    {
        // Метод onlyTrashed() выбирает из базы только записи с заполненным deleted_at
        $products = Product::onlyTrashed()->paginate(self::PER_PAGE);

        return view('products.trashed', compact('products'));
    }

    // Новое ДЗ: Восстановление мягко удаленного продукта
    public function restore(string $id): RedirectResponse
    {
        // Находим продукт среди удаленных по его ID
        $product = Product::onlyTrashed()->findOrFail($id);

        // Метод restore() очищает поле deleted_at, возвращая товар в каталог
        $product->restore();

        return redirect()->route('products.index')
            ->with('success', 'Продукт успешно восстановлен!');
    }
}
