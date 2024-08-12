<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliahs';

    protected $fillable = [
        'nama',
        'kode',
        'tahun',
    ];

    public function jadwal_mengajar()
    {
        return $this->hasMany(JadwalMengajar::class);
    }
}
