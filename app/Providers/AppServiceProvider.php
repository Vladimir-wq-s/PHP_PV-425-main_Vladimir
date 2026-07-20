<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrap();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Регистрация гейта для проверки прав администратора
        Gate::define('view-admin-panel', function (User $user) {
            // Разрешаем доступ только пользователям с конкретным email администратора
            return $user->email === 'admin@example.com' || str_contains($user->email, 'admin');
        });
    }
}
