<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
 
class Materi extends Model
{
    use HasFactory;
    protected $fillable = [
        'mapelmaster_id',
        'guru_id',
        'kelas_id',
        'uploader_nip',
        'materi_name',
        'materi_slug'
    ];

    public function mapelmaster()
    {
        return $this->belongsTo(Mapelmaster::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function ujian()
    {
        return $this->hasMany(Ujian::class);
    }

    public function vids()
    {
        return $this->hasMany(Vids::class);
    }

    public function docs()
    {
        return $this->hasMany(Docs::class);
    }

}
