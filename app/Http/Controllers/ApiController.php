<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getApiData()
    {
        $client = new Client();

        try {
            // Mengirimkan request dengan autentikasi basic
            $response = $client->request('GET', $url, [
                'auth' => [$user, $password],
                'verify' => false, // Mengabaikan verifikasi SSL
            ]);

            // Mengambil isi body dari response dalam bentuk array
            $data = json_decode($response->getBody()->getContents(), true);

            $checkdulu = DB::table('check_apis')->get();
            // return response()->json($checkdulu);
            if($checkdulu->isEmpty()){
                if (isset($data['data'])) {
                    // Ambil nim, nama, dan dosen
                    $nim = $data['data'][0]['nim'];
                    $nama = $data['data'][0]['nama'];
                    $dosenList = collect($data['data'])->pluck('dosen')->unique()->take(2)->values()->all();
    
                    // Memasukkan mahasiswa ke database users
                    $userMahasiswa = User::create([
                        'role' => 'mahasiswa',
                        'uid' => '5F73572B',
                        'nomor' => $nim,
                        'username' => 'ngabdul', // Pastikan 'username' dimasukkan
                        'name' => $nama,
                        'email' => 'ngabdul123@gmail.com',
                        'password' => Hash::make('password'),
                    ]);
    
                    // Memasukkan dosen ke database users
                    foreach ($dosenList as $index => $dosen) {
                        $namaDepan = explode(' ', $dosen)[0];
                        $userDosen = User::create([
                            'role' => 'dosen',
                            'uid' => '73D4133' . ($index + 4), // UID yang berbeda untuk setiap dosen
                            'nomor' => null,
                            'username' => 'dosen' . ($index + 1), // Pastikan 'username' dimasukkan
                            'name' => $dosen,
                            'email' => strtolower($namaDepan) . '@gmail.com',
                            'password' => Hash::make('password'),
                        ]);
                    }

                    $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
                    DB::table('check_apis')->insert([
                        'is_success' => true,
                        'created_at' => $created_at,
                        'updated_at' => $created_at,
                    ]);
    
                    return redirect('/user')->with('success', 'Data user API berhasil ditambahkan!');
                } else {
                    return redirect('/user')->with('error', 'Data user API gagal ditambahkan!');
                }
            } else {
                return redirect('/user')->with('error', 'Data user API sudah anda tambahkan!');
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getJadwal()
    {
        $checkApi = DB::table('check_apis')->first();
        $checkJadwal = DB::table('check_jadwals')->first();
    
        if ($checkApi && $checkApi->is_success == 1) {
            if (!$checkJadwal || $checkJadwal->is_success == 0) {
                // Ambil semua dosen dengan role 'dosen'
                $dosens = DB::table('users')->where('role', 'dosen')->pluck('id');
    
                // Data sesuai dengan contoh SQL yang diberikan
                $jadwalMengajarsData = [
                    ['mata_kuliah_id' => 1, 'hari' => 'Senin'],
                    ['mata_kuliah_id' => 2, 'hari' => 'Selasa'],
                    ['mata_kuliah_id' => 3, 'hari' => 'Rabu'],
                    ['mata_kuliah_id' => 8, 'hari' => 'Rabu'],
                    ['mata_kuliah_id' => 5, 'hari' => 'Kamis'],
                    ['mata_kuliah_id' => 6, 'hari' => 'Kamis'],
                    ['mata_kuliah_id' => 2, 'hari' => 'Jumat'],
                    ['mata_kuliah_id' => 7, 'hari' => 'Jumat'],
                ];
    
                $jadwalMengajarItemsData = [
                    [9, 10, 11, 12],  // Jam untuk mata kuliah 1 pada Senin
                    [7, 8, 9, 10, 11, 12],  // Jam untuk mata kuliah 2 pada Selasa
                    [8, 9, 10, 11],  // Jam untuk mata kuliah 3 pada Rabu
                    [2, 3, 4, 5],  // Jam untuk mata kuliah 8 pada Rabu
                    [1, 2, 3, 4],  // Jam untuk mata kuliah 5 pada Kamis
                    [7, 8],  // Jam untuk mata kuliah 6 pada Kamis
                    [1, 2, 3, 4, 5, 6],  // Jam untuk mata kuliah 2 pada Jumat
                    [9, 10, 11, 12],  // Jam untuk mata kuliah 7 pada Jumat
                ];
    
                $created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
                // Array untuk menyimpan ID dari jadwal_mengajars
                $jadwalMengajarIds = [];
    
                // Looping untuk setiap jadwal mengajar yang sudah ditentukan
                foreach ($jadwalMengajarsData as $index => $jadwalData) {
                    // Pilih dosen secara acak
                    $dosenId = $dosens->random();
    
                    // Insert ke dalam jadwal_mengajars dan dapatkan ID yang baru saja dimasukkan
                    $jadwalMengajarId = DB::table('jadwal_mengajars')->insertGetId([
                        'dosen_id' => $dosenId,
                        'mata_kuliah_id' => $jadwalData['mata_kuliah_id'],
                        'hari' => $jadwalData['hari'],
                        'created_at' => $created_at,
                        'updated_at' => $created_at,
                    ]);
    
                    // Simpan ID ke dalam array untuk referensi nanti
                    $jadwalMengajarIds[] = $jadwalMengajarId;
    
                    // Insert ke dalam jadwal_mengajar_items sesuai dengan jam_id
                    foreach ($jadwalMengajarItemsData[$index] as $jamId) {
                        DB::table('jadwal_mengajar_items')->insert([
                            'jadwal_mengajar_id' => $jadwalMengajarId,
                            'jam_id' => $jamId,
                            'created_at' => $created_at,
                            'updated_at' => $created_at,
                        ]);
                    }
                }
    
                // Ambil semua mahasiswa
                $mahasiswa = DB::table('users')->where('role', 'mahasiswa')->get();
    
                // Loop untuk setiap mahasiswa untuk membuat jadwal_mahasiswa
                foreach ($mahasiswa as $mhs) {
                    // Insert jadwal_mahasiswa
                    $jadwalMahasiswaId = DB::table('jadwal_mahasiswas')->insertGetId([
                        'mahasiswa_id' => $mhs->id,
                        'created_at' => $created_at,
                        'updated_at' => $created_at,
                    ]);
    
                    // Insert jadwal_mahasiswa_items berdasarkan jadwal_mengajar yang sudah dimasukkan
                    foreach ($jadwalMengajarIds as $jadwalId) {
                        DB::table('jadwal_mahasiswa_items')->insert([
                            'jadwal_mahasiswa_id' => $jadwalMahasiswaId,
                            'jadwal_mengajar_id' => $jadwalId,
                            'created_at' => $created_at,
                            'updated_at' => $created_at,
                        ]);
                    }
                }
    
                // Tandai bahwa jadwal telah ditambahkan
                DB::table('check_jadwals')->insert([
                    'is_success' => true,
                    'created_at' => $created_at,
                    'updated_at' => $created_at,
                ]);
    
                return redirect('/jadwal/jadwal-mengajar')->with('success', 'Data jadwal berhasil ditambahkan!');
            } else {
                return redirect('/jadwal/jadwal-mengajar')->with('error', 'Jadwal sudah anda tambahkan sebelumnya!');
            }
        } else {
            return redirect('/jadwal/jadwal-mengajar')->with('error', 'Data jadwal gagal ditambahkan, Silahkan Get API User!');
        }
    }     
}
