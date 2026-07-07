@extends('layouts.main')

@section('title', 'Управление продуктами')

@section('content')
    <div class="container">
        <!-- Заголовок -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">
                <i class="fas fa-boxes me-2 text-primary"></i>
                <span style="font-weight: 700;">Управление продуктами</span>
                <span class="badge bg-secondary ms-2">{{ $products->total() }}</span>
            </h2>
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i> Добавить продукт
            </a>
        </div>

        <!-- Flash сообщения -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Форма фильтрации -->
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <form action="{{ route('products.index') }}" method="GET" id="filterForm">
                    <!-- Первая строка: поиск, категория, сортировка -->
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-search me-1 text-primary"></i> Поиск
                            </label>
                            <div class="input-group">
                                <input
                                    type="text"
                                    name="search"
                                    class="form-control"
                                    placeholder="Название товара..."
                                    value="{{ request('search') }}"
                                >
                                @if(request('search'))
                                    <a href="{{ route('products.index', array_merge(request()->except(['search', 'page']))) }}"
                                       class="btn btn-outline-secondary"
                                       title="Очистить поиск">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-tag me-1 text-primary"></i> Категория
                            </label>
                            <select name="category" class="form-select">
                                <option value="">Все категории</option>
                                @foreach($categories ?? [] as $category)
                                    <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-sort me-1 text-primary"></i> Сортировка
                            </label>
                            <select name="sort" class="form-select">
                                <option value="created_at_desc" {{ request('sort') == 'created_at_desc' ? 'selected' : '' }}>
                                    Сначала новые
                                </option>
                                <option value="created_at_asc" {{ request('sort') == 'created_at_asc' ? 'selected' : '' }}>
                                    Сначала старые
                                </option>
                                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                    По возрастанию цены
                                </option>
                                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                    По убыванию цены
                                </option>
                                <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>
                                    По названию (А-Я)
                                </option>
                                <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>
                                    По названию (Я-А)
                                </option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-filter me-1"></i> Применить
                            </button>
                        </div>
                    </div>

                    <!-- Вторая строка: фильтры по цене и дате -->
                    <div class="row g-3 mt-3 pt-3 border-top">
                        <!-- Фильтр по цене -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-dollar-sign me-1 text-success"></i> Цена от
                            </label>
                            <input
                                type="number"
                                name="price_from"
                                class="form-control"
                                placeholder="0"
                                min="0"
                                step="0.01"
                                value="{{ request('price_from') }}"
                            >
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="fas fa-dollar-sign me-1 text-danger"></i> Цена до
                            </label>
                            <input
                                type="number"
                                name="price_to"
                                class="form-control"
                                placeholder="∞"
                                min="0"
                                step="0.01"
                                value="{{ request('price_to') }}"
                            >
                        </div>

                        <!-- Фильтр по дате -->
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="far fa-calendar-alt me-1 text-warning"></i> Дата от
                            </label>
                            <input
                                type="date"
                                name="date_from"
                                class="form-control"
                                value="{{ request('date_from') }}"
                            >
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">
                                <i class="far fa-calendar-alt me-1 text-info"></i> Дата до
                            </label>
                            <input
                                type="date"
                                name="date_to"
                                class="form-control"
                                value="{{ request('date_to') }}"
                            >
                        </div>
                    </div>

                    <!-- Кнопка сброса -->
                    <div class="row mt-3">
                        <div class="col-12">
                            @if(request()->hasAny(['search', 'category', 'sort', 'price_from', 'price_to', 'date_from', 'date_to']))
                                <a href="{{ route('products.index') }}" class="btn btn-outline-danger">
                                    <i class="fas fa-undo me-1"></i> Сбросить все фильтры
                                </a>
                            @endif
                        </div>
                    </div>
                </form>

                <!-- Активные фильтры -->
                @if(request()->hasAny(['search', 'category', 'price_from', 'price_to', 'date_from', 'date_to', 'sort']))
                    <div class="mt-3 pt-3 border-top">
                        <span class="text-muted me-2">
                            <i class="fas fa-tags me-1"></i> Активные фильтры:
                        </span>

                        @if(request('search'))
                            <span class="badge bg-primary me-1 mb-1">
                                <i class="fas fa-search me-1"></i> "{{ request('search') }}"
                                <a href="{{ route('products.index', array_merge(request()->except(['search', 'page']))) }}"
                                   class="text-white ms-1" style="text-decoration:none;">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('category'))
                            <span class="badge bg-success me-1 mb-1">
                                <i class="fas fa-tag me-1"></i>
                                {{ $categories->firstWhere('id', request('category'))->name ?? 'Категория' }}
                                <a href="{{ route('products.index', array_merge(request()->except(['category', 'page']))) }}"
                                   class="text-white ms-1" style="text-decoration:none;">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('price_from') || request('price_to'))
                            <span class="badge bg-info me-1 mb-1">
                                <i class="fas fa-dollar-sign me-1"></i>
                                {{ request('price_from') ?? '0' }} ₸ — {{ request('price_to') ?? '∞' }} ₸
                                <a href="{{ route('products.index', array_merge(request()->except(['price_from', 'price_to', 'page']))) }}"
                                   class="text-white ms-1" style="text-decoration:none;">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('date_from') || request('date_to'))
                            <span class="badge bg-warning text-dark me-1 mb-1">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ request('date_from') ?? '...' }} — {{ request('date_to') ?? '...' }}
                                <a href="{{ route('products.index', array_merge(request()->except(['date_from', 'date_to', 'page']))) }}"
                                   class="text-dark ms-1" style="text-decoration:none;">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </span>
                        @endif

                        @if(request('sort'))
                            <span class="badge bg-secondary me-1 mb-1">
                                <i class="fas fa-sort me-1"></i>
                                {{ [
                                    'created_at_desc' => 'Сначала новые',
                                    'created_at_asc' => 'Сначала старые',
                                    'price_asc' => 'По возрастанию цены',
                                    'price_desc' => 'По убыванию цены',
                                    'name_asc' => 'По названию (А-Я)',
                                    'name_desc' => 'По названию (Я-А)'
                                ][request('sort')] ?? request('sort') }}
                                <a href="{{ route('products.index', array_merge(request()->except(['sort', 'page']))) }}"
                                   class="text-white ms-1" style="text-decoration:none;">
                                    <i class="fas fa-times-circle"></i>
                                </a>
                            </span>
                        @endif

                        <a href="{{ route('products.index') }}" class="btn btn-sm btn-outline-danger ms-1 mb-1">
                            <i class="fas fa-undo me-1"></i> Очистить всё
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Результаты поиска -->
        @if(request('search'))
            <div class="alert alert-info alert-dismissible fade show">
                <i class="fas fa-info-circle me-2"></i>
                Найдено <strong>{{ $products->total() }}</strong> товаров по запросу
                <strong>"{{ request('search') }}"</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Список продуктов -->
        @if($products->count() > 0)
            <div class="products-grid">
                @foreach($products as $product)
                    <div class="product-card">
                        <div class="product-image">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" loading="lazy">
                            @else
                                <div class="no-image">
                                    <i class="fas fa-image"></i>
                                    <span>Нет фото</span>
                                </div>
                            @endif

                            <div class="product-actions">
                                <a href="{{ route('products.show', $product) }}" class="action-btn" title="Просмотр">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $product) }}" class="action-btn" title="Редактировать">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Вы уверены, что хотите удалить продукт «{{ $product->name }}»?')"
                                      style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn" title="Удалить">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>

                            @if($product->created_at->diffInDays(now()) < 7)
                                <span class="product-badge-new">Новый</span>
                            @endif

                            @if($product->quantity !== null && $product->quantity <= 0)
                                <span class="product-badge-out">Нет в наличии</span>
                            @endif
                        </div>

                        <div class="product-body">
                            <h5 class="product-title" title="{{ $product->name }}">
                                {{ Str::limit($product->name, 30) }}
                            </h5>

                            <div class="product-meta">
                                <span class="category-badge">
                                    <i class="fas fa-tag me-1"></i>
                                    {{ $product->category->name ?? 'Без категории' }}
                                </span>
                                <span class="product-date">
                                    <i class="far fa-calendar-alt me-1"></i>
                                    {{ $product->created_at->format('d.m.Y') }}
                                </span>
                            </div>

                            <div class="product-footer">
                                <span class="product-price">{{ number_format($product->price, 2) }} ₸</span>

                                @if($product->quantity !== null)
                                    <span class="product-stock {{ $product->quantity > 0 ? 'in-stock' : 'out-of-stock' }}">
                                        <i class="fas fa-circle me-1"></i>
                                        {{ $product->quantity > 0 ? 'В наличии' : 'Нет в наличии' }}
                                        @if($product->quantity > 0)
                                            <span class="stock-count">({{ $product->quantity }} шт.)</span>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Пагинация -->
            <div class="d-flex justify-content-center mt-4">
                {{ $products->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Пустое состояние -->
            <div class="empty-state">
                @if(request()->hasAny(['search', 'category', 'price_from', 'price_to', 'date_from', 'date_to']))
                    <i class="fas fa-search"></i>
                    <h5>Ничего не найдено</h5>
                    <p class="text-muted">
                        По заданным параметрам фильтрации товаров не найдено.<br>
                        Попробуйте изменить условия поиска.
                    </p>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-primary mt-2">
                        <i class="fas fa-undo me-1"></i> Сбросить фильтры
                    </a>
                @else
                    <i class="fas fa-box-open"></i>
                    <h5>Нет продуктов</h5>
                    <p class="text-muted">Создайте первый продукт в магазине</p>
                    <a href="{{ route('products.create') }}" class="btn btn-primary mt-2">
                        <i class="fas fa-plus me-1"></i> Создать продукт
                    </a>
                @endif
            </div>
        @endif
    </div>
@endsection

@push('styles')
    <style>
        .container {
            max-width: 1200px;
            padding: 0 15px;
        }

        /* Стили для карточек */
        .products-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            margin: 0 -12px;
        }

        .product-card {
            flex: 0 0 calc(30% - 24px);
            max-width: calc(30% - 24px);
            margin: 0 12px 24px 12px;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border: 1px solid #eef2f6;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
            border-color: #d0d9e4;
        }

        /* Изображение */
        .product-image {
            position: relative;
            height: 230px;
            background: #f8f9fc;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.04);
        }

        .no-image {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f0f2f5 0%, #e2e8f0 100%);
            color: #a0aec0;
            gap: 8px;
        }

        .no-image i {
            font-size: 3rem;
            opacity: 0.5;
        }

        .no-image span {
            font-size: 13px;
            font-weight: 500;
        }

        /* Бейджи */
        .product-badge-new {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #48bb78;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 1;
        }

        .product-badge-out {
            position: absolute;
            top: 12px;
            left: 12px;
            background: #fc8181;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 3px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            z-index: 1;
        }

        /* Кнопки действий */
        .product-actions {
            position: absolute;
            top: 12px;
            right: 12px;
            display: flex;
            flex-direction: column;
            gap: 6px;
            opacity: 0;
            transform: translateX(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 2;
        }

        .product-card:hover .product-actions {
            opacity: 1;
            transform: translateX(0);
        }

        .action-btn {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: none;
            background: rgba(255, 255, 255, 0.95);
            color: #2d3748;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.2s ease;
            cursor: pointer;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(4px);
        }

        .action-btn:hover {
            transform: scale(1.1);
            background: #ffffff;
            text-decoration: none;
        }

        .action-btn.delete-btn {
            color: #e53e3e;
        }

        .action-btn.delete-btn:hover {
            background: #fee2e2;
        }

        /* Тело карточки */
        .product-body {
            padding: 16px 18px 18px;
        }

        .product-title {
            font-size: 15px;
            font-weight: 600;
            color: #1a202c;
            margin-bottom: 10px;
            line-height: 1.4;
            min-height: 42px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .product-meta {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
            margin-bottom: 12px;
        }

        .category-badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 12px;
            background: #ebf8ff;
            color: #2b6cb0;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 500;
            white-space: nowrap;
        }

        .category-badge i {
            font-size: 10px;
        }

        .product-date {
            font-size: 12px;
            color: #a0aec0;
            white-space: nowrap;
        }

        .product-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 12px;
            border-top: 1px solid #edf2f7;
            gap: 10px;
            flex-wrap: wrap;
        }

        .product-price {
            font-size: 19px;
            font-weight: 700;
            color: #2b6cb0;
        }

        .product-stock {
            font-size: 12px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .product-stock.in-stock {
            color: #48bb78;
        }

        .product-stock.out-of-stock {
            color: #fc8181;
        }

        .product-stock i {
            font-size: 8px;
        }

        .stock-count {
            font-size: 11px;
            color: #a0aec0;
            margin-left: 4px;
        }

        /* Пустое состояние */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            background: #fff;
            border-radius: 16px;
            border: 2px dashed #e2e8f0;
        }

        .empty-state i {
            font-size: 4rem;
            color: #cbd5e0;
            margin-bottom: 16px;
            display: block;
        }

        .empty-state h5 {
            font-size: 20px;
            color: #2d3748;
            margin-bottom: 8px;
            font-weight: 600;
        }

        /* Пагинация */
        .pagination {
            gap: 4px;
        }

        .pagination .page-link {
            border-radius: 8px;
            border: none;
            padding: 8px 16px;
            color: #2d3748;
            font-weight: 500;
            background: transparent;
        }

        .pagination .page-link:hover {
            background: #edf2f7;
        }

        .pagination .active .page-link {
            background: #2b6cb0;
            color: #fff;
        }

        .pagination .disabled .page-link {
            color: #a0aec0;
        }

        /* Стили для формы */
        .card {
            border: none;
            border-radius: 12px;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2b6cb0;
            box-shadow: 0 0 0 0.2rem rgba(43, 108, 176, 0.1);
        }

        .badge a:hover {
            opacity: 0.8;
        }

        /* Анимации */
        .alert {
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Адаптивность */
        @media (max-width: 1200px) {
            .product-card {
                flex: 0 0 calc(33.333% - 24px);
                max-width: calc(33.333% - 24px);
            }
        }

        @media (max-width: 992px) {
            .product-card {
                flex: 0 0 calc(50% - 24px);
                max-width: calc(50% - 24px);
            }
        }

        @media (max-width: 768px) {
            .product-actions {
                opacity: 1;
                transform: translateX(0);
                flex-direction: row;
                gap: 4px;
            }

            .product-card:hover .product-actions {
                opacity: 1;
                transform: translateX(0);
            }

            .action-btn {
                width: 32px;
                height: 32px;
                font-size: 12px;
            }
        }

        @media (max-width: 576px) {
            .product-card {
                flex: 0 0 calc(100% - 24px);
                max-width: calc(100% - 24px);
            }

            .product-image {
                height: 200px;
            }

            .product-title {
                font-size: 14px;
                min-height: auto;
            }

            .product-price {
                font-size: 17px;
            }

            .product-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }

            .product-footer {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // Валидация цены: "от" не может быть больше "до"
            $('input[name="price_from"], input[name="price_to"]').on('change', function() {
                const from = parseFloat($('input[name="price_from"]').val()) || 0;
                const to = parseFloat($('input[name="price_to"]').val()) || 0;

                if (from > to && to > 0) {
                    alert('Цена "от" не может быть больше цены "до"');
                    $(this).val('');
                }
            });

            // Валидация даты: "от" не может быть позже "до"
            $('input[name="date_from"], input[name="date_to"]').on('change', function() {
                const from = $('input[name="date_from"]').val();
                const to = $('input[name="date_to"]').val();

                if (from && to && from > to) {
                    alert('Дата "от" не может быть позже даты "до"');
                    $(this).val('');
                }
            });

            // Автоматическое применение фильтров при изменении select (опционально)
            // Раскомментируйте, если нужно автоматическое применение
            /*
            $('select[name="category"], select[name="sort"]').on('change', function() {
                $('#filterForm').submit();
            });
            */

            // Debounce для автоматического поиска (опционально)
            // Раскомментируйте, если нужно автоматическое применение
            /*
            let searchTimeout;
            $('input[name="search"]').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    $('#filterForm').submit();
                }, 500);
            });
            */
        });
    </script>
@endpush
