<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    protected $fillable = [
        // 'jadwal_mahasiswa_id',
        'user_id',
        'jam_masuk',
        'jam_keluar',
        'status',
    ];

    
    // public function jadwal_mahasiswa()
    // {
    //     return $this->belongsTo(JadwalMahasiswa::class, 'jadwal_mahasiswa_id', 'id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
