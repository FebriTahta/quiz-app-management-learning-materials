<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawabtugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'mapelmaster_id','tugas_id','guru_id','siswa_id','jawabtugas_file','jawabtugas_name'
    ];

    public function mapelmaster()
    {
        return $this->brongsTo(Mapelmaster::class);
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    
}
