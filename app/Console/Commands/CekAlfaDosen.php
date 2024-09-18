<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;

class CekAlfaDosen extends Command
{
    protected $signature = 'cek:alfa-dosen';
    protected $description = 'Cek dosen yang tidak hadir pada jadwal mereka dan berikan status alfa';

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
        // dd($currentDay, $currentDate);

        // Ambil semua dosen yang punya jadwal pada hari ini
        $dosenJadwal = DB::table('jadwal_mengajars as jm')
            ->join('users as u', 'jm.dosen_id', '=', 'u.id')
            ->where('jm.hari', $currentDay)
            ->select('u.id as dosen_id', 'jm.id as jadwal_mengajar_id')
            ->get();
        // dd($dosenJadwal);

        foreach ($dosenJadwal as $jadwal) {
            // dd($jadwal);

            $nama = DB::table('users')->where('id', $jadwal->dosen_id)->first()->name;
            // $this->info('Mengecek dosen ' . $nama . '...');

            // Cek apakah dosen sudah melakukan absensi
            $absen = DB::table('absensi_dosens')
                ->where('dosen_id', $jadwal->dosen_id)
                ->where('jadwal_mengajar_id', $jadwal->jadwal_mengajar_id)
                ->whereDate('created_at', $currentDate)
                ->first();
            // dd($absen);

            // Jika belum absen, set status 0 (Alfa)
            if (!$absen) {
                DB::table('absensi_dosens')->insert([
                    'dosen_id' => $jadwal->dosen_id,
                    'jadwal_mengajar_id' => $jadwal->jadwal_mengajar_id,
                    'jam_masuk' => null,
                    'jam_keluar' => null,
                    'status' => 0,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);

                $this->info('Dosen dengan Nama ' . $nama . ' diberikan status Alfa.');
            } else {
                $this->info('Dosen dengan Nama ' . $nama . ' telah diperiksa.');
            }
        }

        $this->info('Selesai.');
    }
}
