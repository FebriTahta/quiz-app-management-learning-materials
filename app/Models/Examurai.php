<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examurai extends Model
{
    use HasFactory;
    protected $fillable = ['mapel_id','examurai_name','examurai_jenis','examurai_lamapengerjaan',
    'examurai_datetimestart','examurai_datetimeend','examurai_status'];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function soalexamurai()
    {
        return $this->hasMany(Soalexamurai::class);
    }

    public function jawabanexamurai()
    {
        return $this->hasMany(Jawabanexamurai::class);
    }

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class);
    }
}
