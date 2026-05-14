<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_kegiatan extends Model
{
    //fillable
    protected $fillable = [
        'tahanan_id',
        'kegiatan_id',
        'tanggal',
        'catatan',
    ];

    //relasi dengan tahanan
    public function tahanan()
    {
        return $this->belongsTo(Tahanan::class);
    }
    
    //relasi dengan kegiatan
    public function kegiatan()
    {        
        return $this->belongsTo(Kegiatan::class);
    }
}
