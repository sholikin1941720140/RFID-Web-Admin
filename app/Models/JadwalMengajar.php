<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMengajar extends Model
{
    use HasFactory;

    protected $table = 'jadwal_mengajars';

    protected $fillable = [
        'dosen_id',
        'mata_kuliah_id',
        'hari',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'dosen_id', 'id');
    }

    public function mata_kuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id', 'id');
    }

    public function jadwal_mengajar_item()
    {
        return $this->hasMany(JadwalMengajarItem::class, 'jadwal_mengajar_id', 'id');
    }

    public function jadwal_mahasiswa_item()
    {
        return $this->hasMany(JadwalMahasiswaItem::class, 'jadwal_mengajar_id', 'id');
    }
}
