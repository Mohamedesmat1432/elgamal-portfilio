<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'mohamed esmat',
            'email' => 'mohamedesmat1432@gmail.com',
            'password' => Hash::make('P@ssw0rd'),
            'branch_id' => 1,
        ]);

        // Adding permissions via a role
        $user->syncRoles(['super admin']);
    }
}
