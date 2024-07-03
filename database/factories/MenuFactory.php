<?php

namespace Database\Factories;

use App\Models\CategoryMenu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(2, true),
            'price' => fake()->randomNumber(5, true),
            'desc' => fake()->text(),
            'category_menu_id' => CategoryMenu::inRandomOrder()->first(),
        ];
    }
}
