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
            'permission-list',
            'permission-create',
            'permission-update',
            'permission-delete',
            'permission-bulk-delete',
            'role-list',
            'role-create',
            'role-update',
            'role-delete',
            'role-bulk-delete',
            'user-list',
            'user-create',
            'user-update',
            'user-delete',
            'user-bulk-delete',
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
