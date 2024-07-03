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
        CategoryMenu::factory()->count(10)->create();
    }
}
