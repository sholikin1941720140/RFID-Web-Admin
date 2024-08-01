<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'jadwal_mahasiswas';

    protected $fillable = [
        'mahasiswa_id',
        'jadwal_mengajar_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id', 'id');
    }

    public function jadwal_mengajar()
    {
        return $this->belongsTo(JadwalMengajar::class, 'jadwal_mengajar_id', 'id');
    }
}
