<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docs extends Model
{
    use HasFactory;
    protected $fillable = [
        'mapelmaster_id',
        'materi_id',
        'docs_file',
        'docs_name',
        'docs_desc',
    ];

    public function materi()
    {
        return $this->belongsTo(Materi::class);
    }

    public function mapelmaster()
    {
        return $this->belongsTo(Mapelmaster::class);
    }
}
