<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vids extends Model
{
    use HasFactory;
    protected $fillable = [
        'mapelmaster_id',
        'materi_id',
        'vids_name',
        'vids_desc',
        'vids_link'
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }
}
