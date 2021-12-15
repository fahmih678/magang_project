<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrInsert(
            [
                'email' => 'superadmin@gmail.com',
            ],
            [
                'name' => 'super admin',
                'password' => Hash::make('password')
            ]
        );
    }
}
