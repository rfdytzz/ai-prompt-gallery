<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'category' => 'Image Generation'
        ]);

        Category::create([
            'category' => 'Ai Text'
        ]);

        Category::create([
            'category' => 'Ai Video'
        ]);

        Category::create([
            'category' => 'Programming'
        ]);

        Category::create([
            'category' => 'Fun/Entertaiment'
        ]);

        Category::create([
            'category' => 'Other'
        ]);
    }
}
