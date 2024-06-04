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
        ];

        foreach($permissions as $permission){
            Permission::create(['name' => $permission]);
        }
    }
}
