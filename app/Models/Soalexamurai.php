<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soalexamurai extends Model
{
    use HasFactory;
    protected $fillable = ['examurai_id','soalexam_name'];

    public function examurai()
    {
        return $this->belongsTo(Examurai::class);
    }

    public function jawabanexamurai()
    {
        return $this->hasMany(Jawabanexamurai::class);
    }
}
