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
                'uid' => null,
                'nomor' => null,
                'username' => 'admin',
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123')
            ],
            [
                'role' => 'dosen',
                'uid' => '73D41334',
                'nomor' => '123456789',
                'username' => 'dosen',
                'name' => 'Ahmadi Yuli Ananta, ST., M.M.',
                'email' => 'ahmadi@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'role' => 'dosen',
                'uid' => null,
                'nomor' => '123456788',
                'username' => 'dosen',
                'name' => 'Vivi Nur Wijayaningrum, S.Kom., M.Kom.',
                'email' => 'vivi@gmail.com',
                'password' => Hash::make('password')
            ],
            [
                'role' => 'mahasiswa',
                'uid' => '5F73572B',
                'nomor' => '1941720240',
                'username' => 'ngabdul',
                'name' => 'Ngabdul',
                'email' => 'ngabdul123@gmail.com',
                'password' => Hash::make('password')
            ]
        ]);
        
    }
}
