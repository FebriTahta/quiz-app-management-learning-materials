<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docstugas extends Model
{
    use HasFactory;

    protected $fillable =[
        'mapelmaster_id','tugas_id','docs_file','docs_name'
    ];

    public function mapelmaster()
    {
        return $this->belongsTo(Mapelmaster::class);
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
