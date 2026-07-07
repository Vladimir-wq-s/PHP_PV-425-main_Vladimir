<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $categoryId = $this->route()->parameter('category')->id;

        return [
            'name' => 'required|min:5|unique:categories,name,' . $categoryId,
            'is_active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Название категории должно быть уникальным.',
            'name.required' => 'Название категории к заполнению обязательна.',
        ];
    }
}
