<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        User::updateOrCreate(
            ['email' => 'kb.dacera@mlgcl.edu.ph'],
            [
                'name' => 'Bryan Dacera',
                'password' => Hash::make('king11BRYAN!'),
                'role' => 'admin',
            ]
        );


    }
}
