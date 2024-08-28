<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kelas_id',
        'role',
        'uid',
        'nomor',
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function jadwal_mengajar()
    {
        return $this->hasMany(JadwalMengajar::class, 'dosen_id', 'id');
    }

    public function jadwal_mahasiswa()
    {
        return $this->hasMany(JadwalMahasiswa::class, 'mahasiswa_id', 'id');
    }

    public function absensi_dosen()
    {
        return $this->hasMany(AbsensiDosen::class, 'dosen_id', 'id');
    }

    public function absensi_mahasiswa()
    {
        return $this->hasMany(AbsensiMahasiswa::class, 'mahasiswa_id', 'id');
    }
}
