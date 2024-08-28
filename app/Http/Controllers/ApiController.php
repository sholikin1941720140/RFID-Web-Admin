<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getApiData()
    {
        $client = new Client();
        $url = 'https://api.polinema.ac.id/siakad/presensi/jadwal/format/json?nim=2241720066&thnsem=20221';
        $user = 'ktm';
        $password = 'ktMp0LiNema#';

        try {
            // Mengirimkan request dengan autentikasi basic
            $response = $client->request('GET', $url, [
                'auth' => [$user, $password],
                'verify' => false, // Mengabaikan verifikasi SSL
            ]);

            // Mengambil isi body dari response dalam bentuk array
            $data = json_decode($response->getBody()->getContents(), true);

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

                return response()->json(['message' => 'Data berhasil dimasukkan ke database']);
            } else {
                return response()->json(['error' => 'Data not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
