<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ruangans')->insert([
            [
                'nama' => 'Ruang 1',
                'kode' => 'R1',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Ruang 2',
                'kode' => 'R2',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Ruang 3',
                'kode' => 'R3',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Ruang 4',
                'kode' => 'R4',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Ruang 5',
                'kode' => 'R5',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Ruang 6',
                'kode' => 'R6',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Ruang 7',
                'kode' => 'R7',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Ruang 8',
                'kode' => 'R8',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Ruang 9',
                'kode' => 'R9',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
            [
                'nama' => 'Ruang 10',
                'kode' => 'R10',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
