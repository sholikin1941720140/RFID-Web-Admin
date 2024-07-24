<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'role' => 'admin',
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123')
            ],
            [
                'role' => 'dosen',
                'username' => 'dosen',
                'name' => 'Ahmadi',
                'email' => 'ahmadi@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'role' => 'mahasiswa',
                'username' => 'reyhan',
                'name' => 'Reyhan',
                'email' => 'reyhan123@gmail.com',
                'password' => Hash::make('password')
            ]
        ]);
    }
}
