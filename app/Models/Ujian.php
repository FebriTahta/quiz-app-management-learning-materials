<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Ujian extends Model
{
    use HasFactory;

    protected $fillable = [
        'mapelmaster_id',
        'materi_id',
        'ujian_name',
        'ujian_slug',
        'ujian_jenis',
        'ujian_lamapengerjaan',
        'ujian_datetimestart',
        'ujian_datetimeend',
    ];


    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function mapelmaster()
    {
        return $this->belongsTo(Mapelmaster::class);
    }

    public function soal()
    {
        return $this->hasMany(Soalmulti::class);
    }

    public function jawabanmulti()
    {
        return $this->hasMany(Jawabanmulti::class);
    }
}
