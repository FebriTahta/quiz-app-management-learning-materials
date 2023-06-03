<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
    use HasFactory;

    protected $fillable = [
        'tingkat_name',
    ];

    public function angkatan()
    {
        return $this->hasMany(Angkatan::class);
    }
}
