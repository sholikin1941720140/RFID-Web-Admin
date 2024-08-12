<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class MatkulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mata_kuliahs')->insert([
            [
                'nama' => 'Dasar Pemrograman',
                'kode' => 'RTI221006',
                'tahun' => 2024,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Matematika 1',
                'kode' => 'RTI221004',
                'tahun' => 2024,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Bahasa Inggris 1',
                'kode' => 'RTI221005',
                'tahun' => 2024,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Praktikum Dasar Pemrograman',
                'kode' => 'RTI221007',
                'tahun' => 2024,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Keselamatan dan Kesehatan Kerja',
                'kode' => 'RTI221008',
                'tahun' => 2024,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Pancasila',
                'kode' => 'RTI221001',
                'tahun' => 2024,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Critical Thinking dan Problem Solving',
                'kode' => 'RTI221003',
                'tahun' => 2024,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Konsep Teknologi Informasi',
                'kode' => 'RTI221002',
                'tahun' => 2024,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
