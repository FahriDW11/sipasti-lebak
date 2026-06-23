<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log_kegiatan extends Model
{
    //fillable
    protected $fillable = [
        'napi_id',
        'kegiatan_id',
        'tanggal',
        'catatan',
    ];

    //translate tanggal
    public function getTanggalFormatAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['tanggal'])
            ->translatedFormat('d F Y');
    }

    //relasi dengan napi
    public function napi()
    {
        return $this->belongsTo(Napi::class);
    }
    
    //relasi dengan kegiatan
    public function kegiatan()
    {        
        return $this->belongsTo(Kegiatan::class);
    }
}
