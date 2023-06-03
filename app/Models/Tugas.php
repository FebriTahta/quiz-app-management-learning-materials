<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $fillable = [
        'mapelmaster_id',
        'guru_id',
        'kelas_id',
        'uploader_nip',
        'tugas_name',
        'tugas_desc'
    ];

    public function docstugas()
    {
        return $this->hasMany(Docstugas::class);
    }

    public function jawabantugas()
    {
        return $this->hasMany(Jawabtugas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapelmaster()
    {
        return $this->belongsTo(Mapelmaster::class);
    }

    public function jawabtugas()
    {
        return $this->hasMany(Jawabtugas::class);
    }
}
