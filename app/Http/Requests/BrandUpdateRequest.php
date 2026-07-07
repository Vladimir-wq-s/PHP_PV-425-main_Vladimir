<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BrandUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $brandId = $this->route('brand');
        $id = is_object($brandId) ? $brandId->id : $brandId;

        return [
            'name' => [
                'required',
                'string',
                'min:2',
                Rule::unique('brands', 'name')->ignore($id),
            ],
            'description' => 'nullable|string|max:1000',
            'is_active' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название бренда обязательно к заполнению.',
            'name.unique' => 'Такой бренд уже существует.',
            'is_active.required' => 'Необходимо указать статус активности.',
        ];
    }
}
