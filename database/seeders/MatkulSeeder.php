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
                'nama' => 'Pemrograman Web',
                'kode' => 'PW',
                'semester' => 4,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Pemrograman Mobile',
                'kode' => 'PM',
                'semester' => 4,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Pemrograman Desktop',
                'kode' => 'PD',
                'semester' => 4,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Pemrograman Jaringan',
                'kode' => 'PJ',
                'semester' => 4,
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ]
        ]);
    }
}
