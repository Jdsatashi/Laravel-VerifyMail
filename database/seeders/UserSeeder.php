<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'firstname' => 'Administrator',
            'lastname' =>'Superuser',
            'dob' => 'When',
            'address' => 'Where',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'is_active' => true,
            'role' => 'admin'
        ]);
    }
}
