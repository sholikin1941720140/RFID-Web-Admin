<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;

    protected $table = 'jams';

    protected $fillable = [
        'nama',
        'jam_mulai',
        'jam_selesai',
    ];

    public function jadwal_mengajar_item()
    {
        return $this->hasMany(JadwalMengajarItem::class, 'jam_id', 'id');
    }
}
