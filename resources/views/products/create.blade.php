@extends('layouts.main')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <!-- Header -->
                <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3 mb-md-0">
                        <div class="bg-gradient-primary text-white rounded-3 p-3 shadow-sm">
                            <i class="bi bi-plus-circle fs-2"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold text-dark mb-0">Создание продукта</h2>
                            <p class="text-muted mb-0">Добавьте новый товар в каталог</p>
                        </div>
                    </div>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-3 px-4">
                        <i class="bi bi-arrow-left me-2"></i>
                        Назад к списку
                    </a>
                </div>

                <!-- Form Card -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-lg-5">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-exclamation-triangle-fill me-2 fs-4"></i>
                                    <div>
                                        <strong class="d-block">Ошибка валидации!</strong>
                                        Пожалуйста, исправьте следующие ошибки:
                                        <ul class="mb-0 mt-2">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                            @csrf

                            <div class="row g-4">
                                <!-- Левая колонка -->
                                <div class="col-lg-7">
                                    <!-- Категория -->
                                    <div class="mb-4">
                                        <label for="category_id" class="form-label fw-semibold">
                                            <i class="bi bi-folder text-primary me-1"></i>
                                            Категория <span class="text-danger">*</span>
                                        </label>
                                        <select
                                            name="category_id"
                                            id="category_id"
                                            class="form-select form-select-lg rounded-3 @error('category_id') is-invalid @enderror"
                                            required
                                        >
                                            <option value="">📂 Выберите категорию</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                    @if($category->children && $category->children->count() > 0)
                                                        <span class="text-muted">({{ $category->children->count() }} подкатегорий)</span>
                                                    @endif
                                                </option>
                                                @if($category->children && $category->children->count() > 0)
                                                    @foreach($category->children as $child)
                                                        <option value="{{ $child->id }}" {{ old('category_id') == $child->id ? 'selected' : '' }} style="padding-left: 30px;">
                                                            &nbsp;&nbsp;&nbsp;└─ {{ $child->name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Теги -->
                                    <div class="mb-4">
                                        <label for="tags" class="form-label fw-semibold">
                                            <i class="bi bi-tags text-primary me-1"></i>
                                            Теги <span class="text-danger">*</span>
                                        </label>
                                        <div class="selected-tags-container mb-3" id="selectedTagsContainer">
                                            <span class="text-muted">Выберите теги</span>
                                        </div>
                                        <select
                                            multiple
                                            name="tags[]"
                                            id="tags"
                                            class="form-select form-select-lg rounded-3 @error('tags') is-invalid @enderror"
                                            required
                                        >
                                            @foreach($tags as $tag)
                                                <option
                                                    value="{{ $tag->id }}"
                                                    data-color="{{ $tag->color ?? '#6c757d' }}"
                                                    @if(old('tags') && in_array($tag->id, old('tags'))) selected @endif
                                                >
                                                    {{ $tag->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">
                                            <i class="bi bi-info-circle"></i>
                                            Удерживайте Ctrl (Cmd на Mac) для выбора нескольких тегов
                                        </small>
                                    </div>

                                    <!-- Название -->
                                    <div class="mb-4">
                                        <label for="name" class="form-label fw-semibold">
                                            <i class="bi bi-box text-primary me-1"></i>
                                            Название продукта <span class="text-danger">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            name="name"
                                            id="name"
                                            class="form-control form-control-lg rounded-3 @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}"
                                            placeholder="Введите название продукта"
                                            required
                                        >
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Описание -->
                                    <div class="mb-4">
                                        <label for="description" class="form-label fw-semibold">
                                            <i class="bi bi-textarea text-primary me-1"></i>
                                            Описание
                                        </label>
                                        <textarea
                                            name="description"
                                            id="description"
                                            class="form-control rounded-3 @error('description') is-invalid @enderror"
                                            rows="5"
                                            placeholder="Введите описание продукта..."
                                        >{{ old('description') }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="d-flex justify-content-between mt-1">
                                            <small class="text-muted">
                                                <i class="bi bi-info-circle"></i> Максимум 1000 символов
                                            </small>
                                            <small class="text-muted" id="charCount">0 / 1000</small>
                                        </div>
                                    </div>

                                    <!-- Цена -->
                                    <div class="mb-4">
                                        <label for="price" class="form-label fw-semibold">
                                            <i class="bi bi-currency-dollar text-primary me-1"></i>
                                            Цена <span class="text-danger">*</span>
                                        </label>
                                        <div class="input-group input-group-lg">
                                        <span class="input-group-text border-end-0 bg-light rounded-start-3">
                                            <i class="bi bi-currency-dollar"></i>
                                        </span>
                                            <input
                                                type="number"
                                                name="price"
                                                id="price"
                                                class="form-control rounded-end-3 @error('price') is-invalid @enderror"
                                                value="{{ old('price') }}"
                                                placeholder="0.00"
                                                step="0.01"
                                                min="0"
                                                required
                                            >
                                        </div>
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Артикул (дополнительно) -->
                                    <div class="mb-4">
                                        <label for="sku" class="form-label fw-semibold">
                                            <i class="bi bi-upc-scan text-primary me-1"></i>
                                            Артикул
                                        </label>
                                        <input
                                            type="text"
                                            name="sku"
                                            id="sku"
                                            class="form-control form-control-lg rounded-3 @error('sku') is-invalid @enderror"
                                            value="{{ old('sku') }}"
                                            placeholder="Введите артикул (опционально)"
                                        >
                                        @error('sku')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Правая колонка -->
                                <div class="col-lg-5">
                                    <!-- Изображение -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-image text-primary me-1"></i>
                                            Изображение продукта
                                        </label>

                                        <div class="upload-wrapper">
                                            <div
                                                class="dropzone border-2 border-dashed rounded-4 p-4 text-center @error('image') border-danger @enderror"
                                                id="dropzone"
                                                style="background: #f8fafc; min-height: 350px; transition: all 0.3s ease;"
                                            >
                                                <!-- Предпросмотр -->
                                                <div id="previewContainer" style="display: none;">
                                                    <div class="position-relative">
                                                        <img
                                                            id="previewImage"
                                                            src="#"
                                                            alt="Preview"
                                                            class="img-fluid rounded-3"
                                                            style="max-height: 300px; width: 100%; object-fit: contain;"
                                                        >
                                                        <button
                                                            type="button"
                                                            class="btn btn-danger btn-sm position-absolute top-0 end-0 m-2 rounded-circle"
                                                            onclick="removeImage()"
                                                            style="width: 36px; height: 36px;"
                                                        >
                                                            <i class="bi bi-x-lg"></i>
                                                        </button>
                                                    </div>
                                                    <div class="mt-2">
                                                        <small class="text-muted d-block" id="fileName"></small>
                                                        <small class="text-muted d-block" id="fileSize"></small>
                                                    </div>
                                                </div>

                                                <!-- Загрузка -->
                                                <div id="uploadContainer">
                                                    <div class="upload-icon mb-3">
                                                        <i class="bi bi-cloud-upload fs-1 text-primary"></i>
                                                    </div>
                                                    <h5 class="mb-2">Перетащите изображение сюда</h5>
                                                    <p class="text-muted mb-3">или</p>
                                                    <button type="button" class="btn btn-primary rounded-3 px-4" onclick="document.getElementById('imageInput').click()">
                                                        <i class="bi bi-folder-open me-2"></i>
                                                        Выбрать файл
                                                    </button>
                                                    <div class="mt-3">
                                                        <small class="text-muted d-block">
                                                            <i class="bi bi-check-circle text-success me-1"></i>
                                                            Форматы: JPEG, PNG, JPG, GIF, WEBP
                                                        </small>
                                                        <small class="text-muted d-block">
                                                            <i class="bi bi-check-circle text-success me-1"></i>
                                                            Максимум: 2MB
                                                        </small>
                                                        <small class="text-muted d-block">
                                                            <i class="bi bi-check-circle text-success me-1"></i>
                                                            Рекомендуется: 800x800px
                                                        </small>
                                                    </div>
                                                </div>

                                                <input
                                                    type="file"
                                                    name="image"
                                                    id="imageInput"
                                                    class="d-none"
                                                    accept="image/*"
                                                    onchange="previewImage(this)"
                                                >
                                            </div>
                                            @error('image')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Статус -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-toggle-on text-primary me-1"></i>
                                            Статус
                                        </label>
                                        <div class="d-flex gap-3">
                                            <div class="form-check form-switch">
                                                <input
                                                    class="form-check-input"
                                                    type="checkbox"
                                                    name="is_active"
                                                    id="isActive"
                                                    value="1"
                                                    @if(old('is_active', true)) checked @endif
                                                    style="width: 3rem; height: 1.5rem;"
                                                >
                                                <label class="form-check-label fw-medium" for="isActive" id="statusLabel">
                                                    Активен
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Хит продаж -->
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">
                                            <i class="bi bi-star text-primary me-1"></i>
                                            Особенности
                                        </label>
                                        <div class="d-flex flex-wrap gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_featured" id="isFeatured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="isFeatured">
                                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                                    Рекомендуемый
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_new" id="isNew" value="1" {{ old('is_new') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="isNew">
                                                    <i class="bi bi-clock-fill text-info me-1"></i>
                                                    Новинка
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Кнопки -->
                            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3 mt-4 pt-4 border-top">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg rounded-3 px-5 order-sm-1">
                                    <i class="bi bi-x-circle me-2"></i>
                                    Отмена
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg rounded-3 px-5 order-sm-2">
                                    <i class="bi bi-check-circle me-2"></i>
                                    Создать продукт
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            .bg-gradient-primary {
                background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
            }

            .dropzone {
                border: 2px dashed #dee2e6;
                transition: all 0.3s ease;
                cursor: pointer;
                position: relative;
            }

            .dropzone:hover {
                border-color: #0d6efd;
                background: #f0f8ff !important;
            }

            .dropzone.dragover {
                border-color: #0d6efd;
                background: #e7f1ff !important;
                transform: scale(1.02);
                box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
            }

            .upload-icon {
                animation: float 3s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }

            .selected-tags-container {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
                min-height: 40px;
                padding: 0.5rem;
                background: #f8f9fa;
                border-radius: 0.5rem;
                border: 1px solid #e9ecef;
            }

            .selected-tag {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.25rem 0.75rem;
                border-radius: 50px;
                font-size: 0.875rem;
                font-weight: 500;
                color: white;
                animation: fadeIn 0.3s ease;
                box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            }

            .selected-tag .remove-tag {
                cursor: pointer;
                opacity: 0.7;
                transition: opacity 0.2s ease;
                background: none;
                border: none;
                color: white;
                padding: 0;
                line-height: 1;
            }

            .selected-tag .remove-tag:hover {
                opacity: 1;
                transform: scale(1.1);
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: scale(0.8); }
                to { opacity: 1; transform: scale(1); }
            }

            select[multiple] {
                min-height: 150px !important;
                padding: 0.5rem;
                border-radius: 0.75rem !important;
            }

            select[multiple] option {
                padding: 0.5rem 0.75rem;
                border-radius: 0.5rem;
                margin: 2px 0;
                transition: all 0.2s ease;
            }

            select[multiple] option:hover {
                background: #e7f1ff !important;
            }

            select[multiple] option:checked {
                background: linear-gradient(135deg, #0d6efd 15%, #6610f2 85%) !important;
                color: white !important;
            }

            .form-control-lg {
                font-size: 1rem;
                padding: 0.75rem 1rem;
            }

            .btn-lg {
                padding: 0.75rem 2rem;
                font-weight: 500;
            }

            @media (max-width: 768px) {
                .card-body {
                    padding: 1.5rem !important;
                }

                .dropzone {
                    min-height: 250px !important;
                }
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Preview Image
            function previewImage(input) {
                const previewContainer = document.getElementById('previewContainer');
                const uploadContainer = document.getElementById('uploadContainer');
                const previewImage = document.getElementById('previewImage');
                const fileName = document.getElementById('fileName');
                const fileSize = document.getElementById('fileSize');

                if (input.files && input.files[0]) {
                    const file = input.files[0];

                    // Validate file size (2MB max)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('Файл слишком большой. Максимальный размер: 2MB');
                        input.value = '';
                        return;
                    }

                    // Validate file type
                    const validTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/jpg'];
                    if (!validTypes.includes(file.type)) {
                        alert('Неподдерживаемый формат файла. Используйте JPEG, PNG, GIF, WEBP');
                        input.value = '';
                        return;
                    }

                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        previewContainer.style.display = 'block';
                        uploadContainer.style.display = 'none';

                        // Display file info
                        fileName.textContent = '📄 ' + file.name;
                        const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
                        fileSize.textContent = '📦 ' + sizeInMB + ' MB';
                    };

                    reader.readAsDataURL(file);
                }
            }

            // Remove Image
            function removeImage() {
                const input = document.getElementById('imageInput');
                const previewContainer = document.getElementById('previewContainer');
                const uploadContainer = document.getElementById('uploadContainer');

                input.value = '';
                previewContainer.style.display = 'none';
                uploadContainer.style.display = 'block';
            }

            // Drag and Drop
            const dropzone = document.getElementById('dropzone');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            dropzone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                const input = document.getElementById('imageInput');
                input.files = files;
                previewImage(input);
                this.classList.remove('dragover');
            });

            dropzone.addEventListener('dragover', function() {
                this.classList.add('dragover');
            });

            dropzone.addEventListener('dragleave', function() {
                this.classList.remove('dragover');
            });

            // Tags Selection Display
            document.addEventListener('DOMContentLoaded', function() {
                const select = document.getElementById('tags');
                const container = document.getElementById('selectedTagsContainer');

                function updateSelectedTags() {
                    const selected = select.selectedOptions;

                    if (selected.length === 0) {
                        container.innerHTML = '<span class="text-muted">Выберите теги</span>';
                        return;
                    }

                    container.innerHTML = '';

                    for (let option of selected) {
                        const color = option.dataset.color || '#6c757d';
                        const tag = document.createElement('span');
                        tag.className = 'selected-tag';
                        tag.style.background = color;
                        tag.innerHTML = `
                    <span>${option.text}</span>
                    <button type="button" class="remove-tag" onclick="removeTag('${option.value}')">
                        <i class="bi bi-x-lg"></i>
                    </button>
                `;
                        container.appendChild(tag);
                    }
                }

                // Initial update
                updateSelectedTags();

                // Update on change
                select.addEventListener('change', updateSelectedTags);
            });

            // Remove tag function
            function removeTag(value) {
                const select = document.getElementById('tags');
                const options = select.options;

                for (let option of options) {
                    if (option.value === value) {
                        option.selected = false;
                        break;
                    }
                }

                // Trigger change event
                const event = new Event('change');
                select.dispatchEvent(event);
            }

            // Character counter for description
            document.getElementById('description').addEventListener('input', function() {
                const maxLength = 1000;
                const currentLength = this.value.length;
                const counter = document.getElementById('charCount');

                counter.textContent = `${currentLength} / ${maxLength}`;

                if (currentLength > maxLength) {
                    this.value = this.value.substring(0, maxLength);
                    counter.textContent = `${maxLength} / ${maxLength}`;
                }

                if (currentLength > maxLength * 0.9) {
                    counter.style.color = '#dc3545';
                } else {
                    counter.style.color = '#6c757d';
                }
            });

            // Status toggle label
            document.getElementById('isActive').addEventListener('change', function() {
                const label = document.getElementById('statusLabel');
                if (this.checked) {
                    label.textContent = 'Активен';
                    label.style.color = '#198754';
                } else {
                    label.textContent = 'Неактивен';
                    label.style.color = '#dc3545';
                }
            });

            // Form validation
            document.getElementById('productForm').addEventListener('submit', function(e) {
                const name = document.getElementById('name');
                const price = document.getElementById('price');
                const category = document.getElementById('category_id');
                const tags = document.getElementById('tags');

                let isValid = true;

                // Reset validation
                [name, price, category, tags].forEach(el => {
                    el.classList.remove('is-invalid');
                });

                // Validate name
                if (!name.value.trim()) {
                    name.classList.add('is-invalid');
                    isValid = false;
                }

                // Validate price
                if (!price.value || parseFloat(price.value) <= 0) {
                    price.classList.add('is-invalid');
                    isValid = false;
                }

                // Validate category
                if (!category.value) {
                    category.classList.add('is-invalid');
                    isValid = false;
                }

                // Validate tags
                if (tags.selectedOptions.length === 0) {
                    tags.classList.add('is-invalid');
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = document.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                    }
                }
            });
        </script>
    @endpush
@endsection
