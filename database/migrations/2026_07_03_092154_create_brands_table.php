<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->id(); // Первичный ключ
            $table->string('name')->unique(); // Название бренда (например, Apple)
            $table->string('slug')->unique(); // Слаг для красивых URL (apple)
            $table->text('description')->nullable(); // Описание бренда
            $table->boolean('is_active')->default(true); // Статус активности
            $table->timestamps(); // Поля created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
