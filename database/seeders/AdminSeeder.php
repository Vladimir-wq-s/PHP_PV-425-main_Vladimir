<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Вызов фабрики и создание ровно 100 админов
        Admin::factory()->count(100)->create();
    }
}
