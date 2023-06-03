<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optionexam extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'soalexam_id','optionexam_name','optionexam_true'
    ];

    public function soalexam()
    {
        return $this->belongsTo(Soalexam::class);
    }

    public function jawabanexam()
    {
        return $this->hasMany(Jawabanexam::class);
    }
}
