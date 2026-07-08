<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Раскомментировали фабрику и указали генерацию 100 пользователей
        User::factory(100)->create();

        $this->call([
            CategorySeeder::class,
            AdminSeeder::class, // Запуск генерации администраторов
            BrandSeeder::class,  // Подключил запуск генерации 15 брендов
        ]);

        if (!User::query()->where('email','test@example.com')->exists()) {
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);
        }
    }
}
