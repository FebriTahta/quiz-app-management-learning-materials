<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapelmaster extends Model
{
    use HasFactory;
    protected $fillable=[
        'guru_id','kelas_id','mapel_id'
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function docs()
    {
        return $this->hasMany(Docs::class);
    }

    public function vids()
    {
        return $this->hasMany(Vids::class);
    }

    public function ujian()
    {
        return $this->hasMany(Ujian::class);
    }

    public function tugas()
    {
        return $this->hasMany(Tugas::class);
    }

    public function docstugas()
    {
        return $this->hasMany(Docstugas::class);
    }

    public function jawabtugas()
    {
        return $this->hasMany(Jawabtugas::class);
    }

    public function komenvideo()
    {
        return $this->hasMany(Komenvideo::class);
    }

    public function jawabanmulti()
    {
        return $this->hasMany(Jawabanmulti::class);
    }
}
