<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailsiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'img_siswa',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
