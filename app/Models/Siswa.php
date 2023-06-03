<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jurusan_id',
        'angkatan_id',
        'kelas_id',
        'siswa_nik',
        'siswa_name',
        'siswa_slug',
        'siswa_status',
        'siswa_angkatan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function detailsiswa()
    {
        return $this->hasOne(Detailsiswa::class);
    }

    public function komenvideo()
    {
        return $this->hasMany(Komenvideo::class);
    }

    public function jawabtugas()
    {
        return $this->hasMany(Jawabtugas::class);
    }

    public function jawabanexam()
    {
        return $this->hasMany(Jawabanexam::class);
    }

    public function ranking()
    {
        return $this->hasMany(Ranking::class);
    }

    public function jawabanexamurai()
    {
        return $this->hasMany(Jawabanexamurai::class);
    }
}
