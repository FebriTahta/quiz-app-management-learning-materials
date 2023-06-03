<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawabanmulti extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'mapelmaster_id',
        'materi_id',
        'ujian_id',
        'soalmulti_id',
        'optionmulti_id',
        'jawabanku',
    ];

    public function mapelmaster()
    {
        return $this->belongsTo(Mapelmaster::class);
    }

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
