@extends('layouts.main')

@section('content')
    <div class="category-page-wrapper">
        <div class="category-container">
            <!-- Header -->
            <div class="category-header">
                <div class="category-header-left">
                    <div class="category-icon-wrapper">
                        <svg class="category-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="category-title">Создание категории</h1>
                        <p class="category-subtitle">Добавьте новую категорию электроники</p>
                    </div>
                </div>
                <a href="{{ route('categories.index') }}" class="category-back-btn">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Назад к списку
                </a>

            </div>

            <!-- Form -->
            <div class="category-form-wrapper">

                <form action="{{ route('categories.store') }}" method="POST" class="category-form">
                    @csrf

                    <div class="category-form-body">
                        <!-- Название категории -->
                        <div class="category-form-group">
                            <label for="name" class="category-label">
                                <span class="category-label-text">Название категории</span>
                                <span class="category-label-required">*</span>
                            </label>
                            <div class="category-input-wrapper">
                                <span class="category-input-icon">📂</span>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="category-input @error('name') category-input-error @enderror"
                                    placeholder="Введите название категории..."
                                    value="{{ old('name') }}"
                                    autofocus
                                >
                            </div>
                            @error('name')
                            <p class="category-error">{{ $message }}</p>
                            @enderror
                            <p class="category-hint">Например: Смартфоны, Ноутбуки, Планшеты</p>
                        </div>

                        <!-- Slug (автогенерация) -->
                        <div class="category-form-group">
                            <label for="slug" class="category-label">
                                <span class="category-label-text">URL-адрес (Slug)</span>
                                <span class="category-label-optional">необязательно</span>
                            </label>
                            <div class="category-input-wrapper">
                                <span class="category-input-icon">🔗</span>
                                <input
                                    type="text"
                                    name="slug"
                                    id="slug"
                                    class="category-input @error('slug') category-input-error @enderror"
                                    placeholder="avtomaticheski-generiruetsya"
                                    value="{{ old('slug') }}"
                                >
                            </div>
                            @error('slug')
                            <p class="category-error">{{ $message }}</p>
                            @enderror
                            <p class="category-hint">Оставьте пустым для автоматической генерации</p>
                        </div>

                        <!-- Статус активности -->
                        <div class="category-form-group">
                            <label class="category-label">
                                <span class="category-label-text">Статус</span>
                            </label>
                            <div class="category-toggle-wrapper">
                                <div class="category-toggle-group">
                                    <label class="category-toggle-label category-toggle-active">
                                        <input
                                            type="radio"
                                            name="is_active"
                                            value="1"
                                            class="category-toggle-input"
                                            {{ old('is_active', 1) == 1 ? 'checked' : '' }}
                                        >
                                        <span class="category-toggle-custom category-toggle-custom-active">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                        Активная
                                    </span>
                                    </label>
                                    <label class="category-toggle-label category-toggle-inactive">
                                        <input
                                            type="radio"
                                            name="is_active"
                                            value="0"
                                            class="category-toggle-input"
                                            {{ old('is_active') == 0 ? 'checked' : '' }}
                                        >
                                        <span class="category-toggle-custom category-toggle-custom-inactive">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Неактивная
                                    </span>
                                    </label>
                                </div>
                                @error('is_active')
                                <p class="category-error">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Описание (дополнительно) -->
                        <div class="category-form-group">
                            <label for="description" class="category-label">
                                <span class="category-label-text">Описание</span>
                                <span class="category-label-optional">необязательно</span>
                            </label>
                            <div class="category-textarea-wrapper">
                            <textarea
                                name="description"
                                id="description"
                                class="category-textarea @error('description') category-input-error @enderror"
                                placeholder="Введите описание категории..."
                                rows="4"
                            >{{ old('description') }}</textarea>
                            </div>
                            @error('description')
                            <p class="category-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Родительская категория (опционально) -->
                        <div class="category-form-group">
                            <label for="parent_id" class="category-label">
                                <span class="category-label-text">Родительская категория</span>
                                <span class="category-label-optional">необязательно</span>
                            </label>
                            <div class="category-input-wrapper">
                                <span class="category-input-icon">📁</span>
                                <select name="parent_id" id="parent_id" class="category-select @error('parent_id') category-input-error @enderror">
                                    <option value="">Без родителя</option>
                                    @foreach($categories ?? [] as $category)
                                        <option value="{{ $category->id }}" {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('parent_id')
                            <p class="category-error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Footer формы -->
                    <div class="category-form-footer">
                        <div class="category-form-footer-left">
                        <span class="category-form-footer-text">
                            <span class="category-form-footer-star">*</span> — обязательные поля
                        </span>
                        </div>
                        <div class="category-form-footer-right">
                            <a href="{{ route('categories.index') }}" class="category-btn category-btn-cancel">
                                Отмена
                            </a>
                            <button type="submit" class="category-btn category-btn-submit">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                                Создать категорию
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Подсказки -->
            <div class="category-tips">
                <div class="category-tips-icon">💡</div>
                <div class="category-tips-content">
                    <h4 class="category-tips-title">Советы по созданию категорий</h4>
                    <ul class="category-tips-list">
                        <li>Используйте понятные и краткие названия (2-3 слова)</li>
                        <li>Активные категории отображаются на сайте, неактивные — скрыты</li>
                        <li>Для вложенных категорий выберите родительскую категорию</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* ========================================
           КОНТЕЙНЕРЫ
        ======================================== */
        .category-page-wrapper {
            padding: 2rem 1rem;
            max-width: 100%;
        }

        .category-container {
            max-width: 800px;
            margin: 0 auto;
        }

        /* ========================================
           ХЕДЕР
        ======================================== */
        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .category-header-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .category-icon-wrapper {
            width: 56px;
            height: 56px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.25);
        }

        .category-icon {
            width: 28px;
            height: 28px;
            color: white;
        }

        .category-title {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 4px 0;
            letter-spacing: -0.5px;
        }

        .category-subtitle {
            font-size: 16px;
            color: #6b7280;
            margin: 0;
        }

        .category-back-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            color: #374151;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
            white-space: nowrap;
        }

        .category-back-btn:hover {
            background: #f9fafb;
            border-color: #d1d5db;
            transform: translateX(-2px);
        }

        /* ========================================
           ФОРМА
        ======================================== */
        .category-form-wrapper {
            background: white;
            border-radius: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06), 0 8px 24px rgba(0, 0, 0, 0.04);
            border: 1px solid #f3f4f6;
            overflow: hidden;
        }

        .category-form {
            display: flex;
            flex-direction: column;
        }

        .category-form-body {
            padding: 2rem 2.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.75rem;
        }

        /* ========================================
           ГРУППЫ ПОЛЕЙ
        ======================================== */
        .category-form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .category-label {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
        }

        .category-label-text {
            color: #374151;
        }

        .category-label-required {
            color: #ef4444;
            font-size: 16px;
            font-weight: 700;
        }

        .category-label-optional {
            color: #9ca3af;
            font-size: 12px;
            font-weight: 400;
            background: #f3f4f6;
            padding: 2px 10px;
            border-radius: 20px;
        }

        /* ========================================
           ПОЛЯ ВВОДА
        ======================================== */
        .category-input-wrapper {
            position: relative;
            display: flex;
            align-items: center;
        }

        .category-input-icon {
            position: absolute;
            left: 14px;
            font-size: 18px;
            line-height: 1;
            pointer-events: none;
        }

        .category-input {
            width: 100%;
            padding: 12px 16px 12px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 400;
            color: #111827;
            background: white;
            transition: all 0.2s;
            outline: none;
            font-family: inherit;
        }

        .category-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .category-input::placeholder {
            color: #9ca3af;
        }

        .category-input-error {
            border-color: #ef4444;
        }

        .category-input-error:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        /* ========================================
           SELECT
        ======================================== */
        .category-select {
            width: 100%;
            padding: 12px 16px 12px 48px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            color: #111827;
            background: white;
            transition: all 0.2s;
            outline: none;
            appearance: none;
            cursor: pointer;
            font-family: inherit;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%236b7280' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
        }

        .category-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .category-select option {
            padding: 8px;
        }

        /* ========================================
           TEXTAREA
        ======================================== */
        .category-textarea-wrapper {
            position: relative;
        }

        .category-textarea {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 16px;
            color: #111827;
            background: white;
            transition: all 0.2s;
            outline: none;
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .category-textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }

        .category-textarea::placeholder {
            color: #9ca3af;
        }

        /* ========================================
           TOGGLE (Радио-кнопки)
        ======================================== */
        .category-toggle-wrapper {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .category-toggle-group {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .category-toggle-label {
            cursor: pointer;
            flex: 1;
            min-width: 140px;
        }

        .category-toggle-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
            pointer-events: none;
        }

        .category-toggle-custom {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-weight: 500;
            font-size: 14px;
            transition: all 0.2s;
            background: white;
            color: #6b7280;
            width: 100%;
        }

        .category-toggle-custom svg {
            width: 18px;
            height: 18px;
        }

        .category-toggle-input:checked + .category-toggle-custom-active {
            border-color: #22c55e;
            background: #f0fdf4;
            color: #16a34a;
            box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
        }

        .category-toggle-input:checked + .category-toggle-custom-inactive {
            border-color: #ef4444;
            background: #fef2f2;
            color: #dc2626;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1);
        }

        .category-toggle-label:hover .category-toggle-custom {
            border-color: #9ca3af;
        }

        /* ========================================
           ОШИБКИ И ПОДСКАЗКИ
        ======================================== */
        .category-error {
            color: #ef4444;
            font-size: 13px;
            margin: 4px 0 0 0;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .category-error::before {
            content: '⚠';
            font-size: 14px;
        }

        .category-hint {
            color: #9ca3af;
            font-size: 13px;
            margin: 4px 0 0 0;
        }

        /* ========================================
           ФУТЕР ФОРМЫ
        ======================================== */
        .category-form-footer {
            padding: 1.25rem 2.5rem;
            background: #f9fafb;
            border-top: 1px solid #f3f4f6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .category-form-footer-left {
            display: flex;
            align-items: center;
        }

        .category-form-footer-text {
            font-size: 13px;
            color: #6b7280;
        }

        .category-form-footer-star {
            color: #ef4444;
            font-weight: 700;
        }

        .category-form-footer-right {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        /* ========================================
           КНОПКИ
        ======================================== */
        .category-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            text-decoration: none;
            font-family: inherit;
        }

        .category-btn-cancel {
            background: white;
            color: #6b7280;
            border: 1px solid #e5e7eb;
        }

        .category-btn-cancel:hover {
            background: #f9fafb;
            border-color: #d1d5db;
        }

        .category-btn-submit {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }

        .category-btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35);
        }

        .category-btn-submit:active {
            transform: translateY(0);
        }

        /* ========================================
           ПОДСКАЗКИ (Tips)
        ======================================== */
        .category-tips {
            margin-top: 2rem;
            padding: 1.5rem 2rem;
            background: #f0fdf4;
            border: 1px solid #dcfce7;
            border-radius: 16px;
            display: flex;
            gap: 1rem;
            align-items: flex-start;
        }

        .category-tips-icon {
            font-size: 24px;
            flex-shrink: 0;
            line-height: 1;
        }

        .category-tips-content {
            flex: 1;
        }

        .category-tips-title {
            font-size: 14px;
            font-weight: 600;
            color: #16a34a;
            margin: 0 0 8px 0;
        }

        .category-tips-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .category-tips-list li {
            font-size: 13px;
            color: #15803d;
            padding-left: 20px;
            position: relative;
        }

        .category-tips-list li::before {
            content: '•';
            position: absolute;
            left: 4px;
            color: #22c55e;
            font-weight: 700;
        }

        /* ========================================
           АДАПТИВНОСТЬ
        ======================================== */
        @media (max-width: 768px) {
            .category-header {
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
            }

            .category-header-left {
                flex-wrap: wrap;
            }

            .category-back-btn {
                justify-content: center;
                width: 100%;
            }

            .category-title {
                font-size: 22px;
            }

            .category-form-body {
                padding: 1.5rem;
            }

            .category-form-footer {
                padding: 1rem 1.5rem;
                flex-direction: column;
                align-items: stretch;
            }

            .category-form-footer-left {
                justify-content: center;
            }

            .category-form-footer-right {
                justify-content: center;
            }

            .category-btn {
                flex: 1;
                justify-content: center;
                min-width: 120px;
            }

            .category-toggle-group {
                flex-direction: column;
            }

            .category-toggle-label {
                min-width: auto;
            }

            .category-tips {
                flex-direction: column;
                align-items: stretch;
                padding: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .category-page-wrapper {
                padding: 1rem 0.75rem;
            }

            .category-form-body {
                padding: 1rem;
                gap: 1.25rem;
            }

            .category-icon-wrapper {
                width: 44px;
                height: 44px;
            }

            .category-icon {
                width: 22px;
                height: 22px;
            }

            .category-title {
                font-size: 20px;
            }

            .category-input {
                padding: 10px 14px 10px 44px;
                font-size: 15px;
            }

            .category-select {
                padding: 10px 14px 10px 44px;
                font-size: 15px;
            }

            .category-form-footer-right {
                flex-direction: column;
                width: 100%;
            }

            .category-btn {
                width: 100%;
            }
        }
    </style>

    <script>
        // Автогенерация slug из названия
        document.addEventListener('DOMContentLoaded', function() {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            nameInput.addEventListener('input', function() {
                if (!slugInput.value || slugInput.dataset.generated === 'true') {
                    const slug = this.value
                        .toLowerCase()
                        .replace(/[^a-zа-яё0-9\s]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .replace(/^-|-$/g, '');
                    slugInput.value = slug;
                    slugInput.dataset.generated = 'true';
                }
            });

            slugInput.addEventListener('input', function() {
                this.dataset.generated = 'false';
            });
        });
    </script>

@endsection
