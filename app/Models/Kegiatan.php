<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    //fillable
    protected $fillable = [
        'nama_kegiatan',
        'keterangan',
        'icon',
        'warna',
    ];

    public function log_kegiatan()
    {
        return $this->hasMany(Log_kegiatan::class);
    }
}
