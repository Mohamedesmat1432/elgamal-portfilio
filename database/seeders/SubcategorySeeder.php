<?php

namespace Database\Seeders;

use App\Models\Subcategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {        
        $subcategories = [
            ['name' => 'subcat 1', 'slug' => 'subcat-1', 'category_id' => 2],
            ['name' => 'subcat 2', 'slug' => 'subcat-2', 'category_id' => 3],
            ['name' => 'subcat 3', 'slug' => 'subcat-3', 'category_id' => 2],
            ['name' => 'subcat 4', 'slug' => 'subcat-4', 'category_id' => 1],
            ['name' => 'subcat 5', 'slug' => 'subcat-5', 'category_id' => 4],
            ['name' => 'subcat 6', 'slug' => 'subcat-6', 'category_id' => 5],
            ['name' => 'subcat 7', 'slug' => 'subcat-7', 'category_id' => 5],
            ['name' => 'subcat 8', 'slug' => 'subcat-8', 'category_id' => 4],
            ['name' => 'subcat 9', 'slug' => 'subcat-9', 'category_id' => 3],
            ['name' => 'subcat 10', 'slug' => 'subcat-10', 'category_id' => 2],
            ['name' => 'subcat 11', 'slug' => 'subcat-11', 'category_id' => 2],
            ['name' => 'subcat 12', 'slug' => 'subcat-12', 'category_id' => 1],
        ];

        foreach ($subcategories as $subcategory) {
            Subcategory::create($subcategory);
        }
    }
}
