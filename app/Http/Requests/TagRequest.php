<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Разрешаем доступ к валидации
    }

    public function rules(): array
    {
        $tag = $this->route('tag');
        $id = is_object($tag) ? $tag->id : $tag;

        return [
            // Имя обязательно, уникально (игнорируя текущий ID при обновлении)
            'name' => [
                'required',
                'string',
                'min:2',
                'max:50',
                Rule::unique('tags', 'name')->ignore($id)
            ],
            'active' => 'nullable|boolean',
            // Передаем массив ID продуктов для привязки к тегу
            'products' => 'nullable|array',
            'products.*' => 'exists:products,id',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Приводим чекбокс активности к булевому типу
        $this->merge([
            'active' => $this->has('active'),
        ]);
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название тега обязательно для заполнения.',
            'name.unique' => 'Тег с таким названием уже существует.',
            'name.min' => 'Название тега должно быть не короче 2 символов.',
        ];
    }
}
