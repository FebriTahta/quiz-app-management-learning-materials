<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $fillable = [
        'jurusan_id',
        'angkatan_id',
        'kelas_name',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    // public function tingkat()
    // {
    //     return $this->belongsTo(Tingkat::class);
    // }

    public function angkatan()
    {
        return $this->belongsTo(Angkatan::class);
    }

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class);
    }

    public function guru()
    {
        return $this->belongsToMany(Guru::class);
    }

    public function mapelmaster(){
        return $this->hasMany(Mapelmaster::class);
    }

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function exam()
    {
        return $this->belongsToMany(Exam::class);
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

    public function examurai()
    {
        return $this->belongsToMany(Examurai::class);
    }
}
