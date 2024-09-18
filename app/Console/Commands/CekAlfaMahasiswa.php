<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class CekAlfaMahasiswa extends Command
{
    protected $signature = 'cek:alfa-mahasiswa';
    protected $description = 'Cek mahasiswa yang tidak hadir pada jadwal mereka dan berikan status alfa';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Ambil hari ini
        Carbon::setLocale('id');
        $currentDay = Carbon::now()->translatedFormat('l');
        $currentDate = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        // Ambil semua mahasiswa yang punya jadwal pada hari ini
        $mahasiswaJadwal = DB::table('jadwal_mahasiswas as jm')
            ->join('users as u', 'jm.mahasiswa_id', '=', 'u.id')
            ->join('jadwal_mahasiswa_items as jmi', 'jm.id', '=', 'jmi.jadwal_mahasiswa_id')
            ->join('jadwal_mengajars as jmg', 'jmi.jadwal_mengajar_id', '=', 'jmg.id')
            ->where('jmg.hari', $currentDay)
            ->select('u.id as mahasiswa_id', 'jmg.id as jadwal_mengajar_id')
            ->get();

        foreach ($mahasiswaJadwal as $jadwal) {
            // Cek apakah mahasiswa sudah melakukan absensi

            $nama = DB::table('users')->where('id', $jadwal->mahasiswa_id)->first()->name;

            $absen = DB::table('absensi_mahasiswas')
                ->where('mahasiswa_id', $jadwal->mahasiswa_id)
                ->where('jadwal_mengajar_id', $jadwal->jadwal_mengajar_id)
                ->whereDate('created_at', $currentDate)
                ->first();

            // Jika belum absen, set status 0 (Alfa)
            if (!$absen) {
                DB::table('absensi_mahasiswas')->insert([
                    'mahasiswa_id' => $jadwal->mahasiswa_id,
                    'jadwal_mengajar_id' => $jadwal->jadwal_mengajar_id,
                    'jam_masuk' => null,
                    'jam_keluar' => null,
                    'status' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $this->info('Mahasiswa dengan Nama ' . $nama . ' diberikan status Alfa.');
            } else {
                $this->info('Mahasiswa dengan Nama ' . $nama . ' telah diperiksa.');
            }
        }

        $this->info('Selesai.');
    }
}
