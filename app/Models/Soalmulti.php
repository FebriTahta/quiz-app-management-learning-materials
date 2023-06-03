<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soalmulti extends Model
{
    use HasFactory;

    protected $fillable = [
        'ujian_id',
        'soal_kode',
        'soal_name'
    ];

    public function OptionMulti()
    {
        return $this->hasMany(Optionmulti::class);
    }
}
