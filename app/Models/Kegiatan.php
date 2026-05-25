<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    //fillable
    protected $fillable = [
        'nama',
        'deskripsi',
        'photo',
    ];

    public function log_kegiatans()
    {
        return $this->hasMany(Log_kegiatan::class);
    }
}
