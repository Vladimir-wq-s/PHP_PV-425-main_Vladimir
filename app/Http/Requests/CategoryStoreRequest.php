<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Разрешение выполнение валидации
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|unique:categories,name',
            'is_active' => 'nullable|boolean',
        ];
    }
}
