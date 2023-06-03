<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawabanexamurai extends Model
{
    use HasFactory;
    protected $fillable = ['siswa_id','kelas_id','examurai_id','soalexamurai_id','guru_id','jawabanku','nilaiku'];

    public function siswa(){
        return $this->belongsTo(Siswa::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function examurai()
    {
        return $this->belongsTo(Examurai::class);
    }

    public function soalexamurai()
    {
        return $this->belongsTo(Soalexamurai::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
