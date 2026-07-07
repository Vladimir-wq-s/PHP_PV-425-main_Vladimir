<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $name = $this->faker->unique()->company();

        return [
            'name' => $name,
            // Хелпер Str::slug превратит "Apple Inc" в красивый URL "apple-inc"
            'slug' => Str::slug($name),
            'description' => $this->faker->paragraph(2),
            'is_active' => true,
        ];
    }
}
