@extends('layouts.main')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Редактирование категории</h3>
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Ошибка!</strong> Пожалуйста, исправьте следующие ошибки:
                                <ul class="mb-0 mt-2">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Информация о связи -->
                        <div class="mb-4 p-3 bg-light rounded">
                            <h5 class="mb-2">Информация о категории</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <span class="text-muted">Тип:</span>
                                    <strong>
                                        @if($category->parent_id)
                                            <span class="badge bg-info">Подкатегория</span>
                                        @else
                                            <span class="badge bg-primary">Родительская категория</span>
                                        @endif
                                    </strong>
                                </div>
                                <div class="col-md-6">
                                    <span class="text-muted">Статус:</span>
                                    <strong>
                                        @if($category->is_active)
                                            <span class="badge bg-success">Активна</span>
                                        @else
                                            <span class="badge bg-danger">Неактивна</span>
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        </div>

                        <!-- Вывод родительской категории -->
                        @if($category->parent_id)
                            <div class="mb-3 p-3 border-start border-4 border-warning bg-warning bg-opacity-10 rounded">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-level-up-alt fa-rotate-90 me-2 text-warning"></i>
                                    <span class="text-muted">Родительская категория:</span>
                                    <strong class="ms-2">
                                        @if($category->parent)
                                            <a href="{{ route('categories.edit', $category->parent->id) }}" class="text-decoration-none">
                                                {{ $category->parent->name }}
                                                @if(!$category->parent->is_active)
                                                    <span class="badge bg-danger ms-1">Неактивна</span>
                                                @endif
                                            </a>
                                        @else
                                            <span class="text-danger">Родительская категория не найдена</span>
                                        @endif
                                    </strong>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('categories.update', $category->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Название категории <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name', $category->name) }}"
                                    required
                                >
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Поле для выбора родительской категории -->
                            <div class="mb-3">
                                <label for="parent_id" class="form-label">Родительская категория</label>
                                <select
                                    name="parent_id"
                                    id="parent_id"
                                    class="form-select @error('parent_id') is-invalid @enderror"
                                >
                                    <option value="">Нет родительской категории</option>
                                    @foreach($allCategories as $cat)
                                        @if($cat->id !== $category->id)
                                            <option
                                                value="{{ $cat->id }}"
                                                {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}
                                                @if(!$cat->is_active) class="text-muted" @endif
                                            >
                                                {{ $cat->name }}
                                                @if($cat->parent_id)
                                                    <span class="text-muted">(подкатегория)</span>
                                                @endif
                                                @if(!$cat->is_active)
                                                    <span class="badge bg-danger ms-1">Неактивна</span>
                                                @endif
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">
                                    <i class="fas fa-info-circle"></i>
                                    Выберите родительскую категорию, чтобы сделать эту категорию подкатегорией
                                </small>
                                @error('parent_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Статус</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_active"
                                            id="active"
                                            value="1"
                                            {{ old('is_active', $category->is_active) == 1 ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="active">Активная</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="is_active"
                                            id="inactive"
                                            value="0"
                                            {{ old('is_active', $category->is_active) == 0 ? 'checked' : '' }}
                                        >
                                        <label class="form-check-label" for="inactive">Неактивная</label>
                                    </div>
                                </div>
                                @error('is_active')
                                <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Отмена</a>
                                <div class="d-flex gap-2">
                                    <!-- Кнопка удаления с подтверждением через JS -->
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                          onsubmit="return confirm('Вы уверены, что хотите удалить категорию &quot;{{ $category->name }}&quot;? Это действие невозможно отменить.')"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Удалить
                                        </button>
                                    </form>
                                    <button type="submit" class="btn btn-primary">Обновить</button>
                                </div>
                            </div>
                        </form>

                        <!-- Вывод сабкатегорий -->
                        @if($category->children && $category->children->count() > 0)
                            <hr class="my-4">
                            <div class="mt-4">
                                <h5 class="mb-3">
                                    <i class="fas fa-sitemap me-2 text-primary"></i>
                                    Подкатегории ({{ $category->children->count() }})
                                </h5>
                                <div class="list-group">
                                    @foreach($category->children as $child)
                                        <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                            <div>
                                                <i class="fas fa-folder text-warning me-2"></i>
                                                <span>{{ $child->name }}</span>
                                                @if(!$child->is_active)
                                                    <span class="badge bg-danger ms-2">Неактивна</span>
                                                @endif
                                                @if($child->children && $child->children->count() > 0)
                                                    <span class="badge bg-info ms-1">
                                                        <i class="fas fa-sitemap"></i> {{ $child->children->count() }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('categories.edit', $child->id) }}" class="btn btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('categories.destroy', $child->id) }}" method="POST"
                                                      onsubmit="return confirm('Вы уверены, что хотите удалить подкатегорию &quot;{{ $child->name }}&quot;?')"
                                                      style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
