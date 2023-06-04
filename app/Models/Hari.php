<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hari extends Model
{
    use HasFactory;

    protected $fillable = [
        'hari_ind',
        'hari_eng'
    ];
    
    public function jadwal()
    {
        return $this->belongsToMany(Jadwal::class);
    }

    public function mapelmaster()
    {
        return $this->belongsToMany(Mapelmaster::class);
    }
}
