<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branchs = [
            ['name' => 'permission-list'],
            ['name' => 'permission-create'],
            ['name' => 'permission-update'],
            ['name' => 'permission-delete'],
            ['name' => 'permission-bulk-delete'],
            ['name' => 'permission-trash-list'],
            ['name' => 'permission-force-delete'],
            ['name' => 'permission-force-bulk-delete'],
            ['name' => 'permission-restore'],
            ['name' => 'permission-bulk-restore'],
            ['name' => 'branch-list'],
            ['name' => 'branch-create'],
            ['name' => 'branch-update'],
            ['name' => 'branch-delete'],
            ['name' => 'branch-bulk-delete'],
            ['name' => 'branch-trash-list'],
            ['name' => 'branch-force-delete'],
            ['name' => 'branch-force-bulk-delete'],
            ['name' => 'branch-restore'],
            ['name' => 'branch-bulk-restore'],
            ['name' => 'role-list'],
            ['name' => 'role-create'],
            ['name' => 'role-update'],
            ['name' => 'role-delete'],
            ['name' => 'role-bulk-delete'],
            ['name' => 'role-trash-list'],
            ['name' => 'role-force-delete'],
            ['name' => 'role-force-bulk-delete'],
            ['name' => 'role-restore'],
            ['name' => 'role-bulk-restore'],
            ['name' => 'user-list'],
            ['name' => 'user-create'],
            ['name' => 'user-update'],
            ['name' => 'user-delete'],
            ['name' => 'user-bulk-delete'],
            ['name' => 'user-trash-list'],
            ['name' => 'user-force-delete'],
            ['name' => 'user-force-bulk-delete'],
            ['name' => 'user-restore'],
            ['name' => 'user-bulk-restore'],
            ['name' => 'category-list'],
            ['name' => 'category-create'],
            ['name' => 'category-update'],
            ['name' => 'category-delete'],
            ['name' => 'category-bulk-delete'],
            ['name' => 'category-trash-list'],
            ['name' => 'category-force-delete'],
            ['name' => 'category-force-bulk-delete'],
            ['name' => 'category-restore'],
            ['name' => 'category-bulk-restore'],
            ['name' => 'subcategory-list'],
            ['name' => 'subcategory-create'],
            ['name' => 'subcategory-update'],
            ['name' => 'subcategory-delete'],
            ['name' => 'subcategory-bulk-delete'],
            ['name' => 'subcategory-trash-list'],
            ['name' => 'subcategory-force-delete'],
            ['name' => 'subcategory-force-bulk-delete'],
            ['name' => 'subcategory-restore'],
            ['name' => 'subcategory-bulk-restore'],
            ['name' => 'product-list'],
            ['name' => 'product-create'],
            ['name' => 'product-update'],
            ['name' => 'product-delete'],
            ['name' => 'product-bulk-delete'],
            ['name' => 'product-trash-list'],
            ['name' => 'product-force-delete'],
            ['name' => 'product-force-bulk-delete'],
            ['name' => 'product-restore'],
            ['name' => 'product-bulk-restore'],
        ];

        foreach($branchs as $branch) {
            Permission::create($branch);
        }
    }
}
