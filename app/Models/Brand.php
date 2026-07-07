<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    // Разрешаем массовое заполнение полей
    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];
}
