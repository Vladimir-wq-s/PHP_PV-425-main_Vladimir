@extends('layouts.main')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">Список категорий</h3>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Добавить категорию
                        </a>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if($categories->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Статус</th>
                                        <th>Дата создания</th>
                                        <th class="text-center">Действия</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                @if($category->is_active)
                                                    <span class="badge bg-success">Активная</span>
                                                @else
                                                    <span class="badge bg-secondary">Неактивная</span>
                                                @endif
                                            </td>
                                            <td>{{ $category->created_at->format('d.m.Y H:i') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Редактировать
                                                </a>
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                      method="POST"
                                                      style="display: inline-block;"
                                                      onsubmit="return confirm('Вы уверены, что хотите удалить категорию \"{{ $category->name }}\"? Это действие невозможно отменить.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Удалить
                                                </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Пагинация -->
                            @if(method_exists($categories, 'links'))
                                <div class="d-flex justify-content-center mt-3">
                                    {{ $categories->links() }}
                                </div>
                            @endif

                        @else
                            <div class="text-center py-5">
                                <p class="text-muted mb-3">Категории не найдены</p>
                                <a href="{{ route('categories.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Добавить первую категорию
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
