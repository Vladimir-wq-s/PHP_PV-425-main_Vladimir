<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateUserNamesPrefix extends Command
{
    /**
     * Консольное имя команды, которое мы будем вводить в терминале
     */
    protected $signature = 'users:add-prefix';

    /**
     * Описание команды для справки php artisan list
     */
    protected $description = 'Добавляет префикс ПВ425 к именам всех пользователей в базе данных';

    /**
     * Логика выполнения консольной команды
     */
    public function handle(): int
    {
        $prefix = 'ПВ425 ';

        // Используем метод chunk для безопасного перебора данных порциями
        User::query()->chunk(100, function ($users) use ($prefix) {
            foreach ($users as $user) {
                // Проверяем, чтобы префикс не добавился повторно, если команда запустится дважды
                if (!str_starts_with($user->name, trim($prefix))) {
                    // Используем прямое присвоение и метод save для обхода ограничений Fillable
                    $user->name = $prefix . $user->name;
                    $user->save();
                }
            }
        });

        $this->info('Префикс успешно добавлен ко всем именам пользователей!');

        return Command::SUCCESS;
    }
}
