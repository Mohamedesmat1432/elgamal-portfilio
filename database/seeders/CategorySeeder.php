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
        $categories = [
            ['name' => 'cat 1', 'slug' => 'cat-1'],
            ['name' => 'cat 2', 'slug' => 'cat-2'],
            ['name' => 'cat 3', 'slug' => 'cat-3'],
            ['name' => 'cat 4', 'slug' => 'cat-4'],
            ['name' => 'cat 5', 'slug' => 'cat-5'],
            ['name' => 'cat 6', 'slug' => 'cat-6']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
