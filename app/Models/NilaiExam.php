<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiExam extends Model
{
    use HasFactory;

    protected $fillable = [
        'siswa_id',
        'exam_id',
        'kelas_id',
        'mapel_id',
        'nilai'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
