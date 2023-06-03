<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'mapel_id','exam_name','exam_jenis','exam_lamapengerjaan','exam_datetimestart','exam_datetimeend','exam_status'
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }

    public function soalexam()
    {
        return $this->hasMany(Soalexam::class);
    }

    public function jawabanexam()
    {
        return $this->hasMany(Jawabanexam::class);
    }
}
