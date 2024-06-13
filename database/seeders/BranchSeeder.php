<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $branches = [
            ['name' => 'emad eldeen', 'address' => '40 ramses street'],
            ['name' => 'eldoki', 'address' => '44 elgiza street']
        ];

        foreach ($branches as $branch) {
            Branch::create($branch);
        }
    }
}
