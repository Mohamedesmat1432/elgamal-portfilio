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
        $permissions = [
            ['name' => 'permission-list'],
            ['name' => 'permission-create'],
            ['name' => 'permission-update'],
            ['name' => 'permission-delete'],
            ['name' => 'permission-bulk-delete'],
            ['name' => 'role-list'],
            ['name' => 'role-create'],
            ['name' => 'role-update'],
            ['name' => 'role-delete'],
            ['name' => 'role-bulk-delete'],
            ['name' => 'user-list'],
            ['name' => 'user-create'],
            ['name' => 'user-update'],
            ['name' => 'user-delete'],
            ['name' => 'user-bulk-delete'],
        ];

        foreach($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
