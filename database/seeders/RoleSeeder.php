<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['admin', 'manager', 'casher'];

        foreach($roles as $role){
            Role::create(['name' => $role]);
        }

        $role = Role::create(['name' => 'super admin']);

        $role->syncPermissions(Permission::pluck('name')->toArray());
    }
}
