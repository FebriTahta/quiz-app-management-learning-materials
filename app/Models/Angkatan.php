<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angkatan extends Model
{
    use HasFactory;

    protected $fillable=[
        'angkatan_name',
        'angkatan_status',
        'tingkat_id'
    ];

    public function tingkat()
    {
        return $this->belongsTo(Tingkat::class);
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
