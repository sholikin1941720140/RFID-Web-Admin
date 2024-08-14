<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiDosen extends Model
{
    use HasFactory;

    protected $table = 'absensi_dosens';

    protected $fillable = [
        'dosen_id',
        'jadwal_mengajar_id',
        'status',
        'jam_masuk',
        'jam_keluar'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'dosen_id', 'id');
    }

    public function jadwal_mengajar()
    {
        return $this->belongsTo(JadwalMengajar::class, 'jadwal_mengajar_id', 'id');
    }
}
