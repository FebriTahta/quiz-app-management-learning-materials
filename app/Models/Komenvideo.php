<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komenvideo extends Model
{
    use HasFactory;
    
    protected $fillable = ['mapelmaster_id','siswa_id','vids_id','materi_id','komen'];

    public function mapelmaster()
    {
        return $this->belongsTo(Mapelmaster::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function vids()
    {
        return $this->belongsTo(Vids::class);
    }
}
