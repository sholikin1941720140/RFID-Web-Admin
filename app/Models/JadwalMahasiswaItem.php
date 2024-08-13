<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMahasiswaItem extends Model
{
    use HasFactory;

    protected $table = 'jadwal_mahasiswa_items';

    protected $fillable = [
        'jadwal_mahasiswa_id',
        'jadwal_mengajar_id'
    ];

    public function jadwal_mahasiswa()
    {
        return $this->belongsTo(JadwalMahasiswa::class, 'jadwal_mahasiswa_id', 'id');
    }

    public function jadwal_mengajar()
    {
        return $this->belongsTo(JadwalMengajar::class, 'jadwal_mengajar_id', 'id');
    }
}
