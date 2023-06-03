<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soalexam extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'soalexam_kode',
        'soalexam_name'
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function optionexam()
    {
        return $this->hasMany(Optionexam::class);
    }

    public function jawabanexam()
    {
        return $this->hasMany(Jawabanexam::class);
    }
}
