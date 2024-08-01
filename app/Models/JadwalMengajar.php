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
        'ruangan_id',
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

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id');
    }

    public function jadwal_mengajar_item()
    {
        return $this->hasMany(JadwalMengajarItem::class, 'jadwal_mengajar_id', 'id');
    }
}
