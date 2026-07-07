<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Разрешение доступа к валидации
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|unique:brands,name',
            'description' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название бренда обязательно к заполнению.',
            'name.unique' => 'Такой бренд уже существует.',
            'name.min' => 'Название бренда должно содержать минимум 2 символа.',
        ];
    }
}
