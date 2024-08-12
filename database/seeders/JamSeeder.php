<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class JamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jams')->insert([
            [
                'nama' => 'Jam ke-1',
                'jam_mulai' => '07:00:00',
                'jam_selesai' => '07:50:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-2',
                'jam_mulai' => '07:50:00',
                'jam_selesai' => '08:40:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-3',
                'jam_mulai' => '08:40:00',
                'jam_selesai' => '09:30:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-4',
                'jam_mulai' => '09:40:00',
                'jam_selesai' => '10:30:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-5',
                'jam_mulai' => '10:30:00',
                'jam_selesai' => '11:20:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-6',
                'jam_mulai' => '11:20:00',
                'jam_selesai' => '12:10:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-7',
                'jam_mulai' => '12:50:00',
                'jam_selesai' => '13:40:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-8',
                'jam_mulai' => '13:40:00',
                'jam_selesai' => '14:30:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-9',
                'jam_mulai' => '14:30:00',
                'jam_selesai' => '15:20:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-10',
                'jam_mulai' => '15:30:00',
                'jam_selesai' => '16:20:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-11',
                'jam_mulai' => '16:20:00',
                'jam_selesai' => '17:10:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'nama' => 'Jam ke-12',
                'jam_mulai' => '17:10:00',
                'jam_selesai' => '18:00:00',
                'created_at' => Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
        ]);
    }
}
