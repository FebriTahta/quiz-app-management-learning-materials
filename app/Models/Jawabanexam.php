<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawabanexam extends Model
{
    use HasFactory;

    protected $fillable = [
        "siswa_id","mapel_id","kelas_id","exam_id","soalexam_id","optionexam_id","jawabanku"
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function soalexam()
    {
        return $this->belongsTo(Soalexam::class);
    }

    public function optionexam()
    {
        return $this->belongsTo(Optionexam::class);
    }
}
