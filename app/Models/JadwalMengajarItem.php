<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalMengajarItem extends Model
{
    use HasFactory;

    protected $table = 'jadwal_mengajar_items';

    protected $fillable = [
        'jadwal_mengajar_id',
        'jam_id'
    ];

    public function jadwal_mengajar()
    {
        return $this->belongsTo(JadwalMengajar::class, 'jadwal_mengajar_id', 'id');
    }

    public function jam()
    {
        return $this->belongsTo(Jam::class, 'jam_id', 'id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'jadwal_mengajar_item_id', 'id');
    }
}
