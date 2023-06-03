<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Optionmulti extends Model
{
    use HasFactory;

    protected $fillable = [
        'soalmulti_id',
        'option_name',
        'option_true'
    ];
}
