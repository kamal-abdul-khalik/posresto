<?php

namespace Database\Seeders;

use App\Models\CategoryMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            'Coffee',
            'non-Coffee',
            'Desert',
            'EsCreams',
            'Topping',
        ]);

        $categories->each(function ($category) {
            CategoryMenu::create([
                'name' => $category,
                'slug' => str()->slug($category),
            ]);
        });
    }
}
