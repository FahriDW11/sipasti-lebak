<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahanan extends Model
{
    //
    protected $fillable = [
        'pembina_id',
        'nama',
        'nama_ayah',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'photo',
    ];
    
    public function pembina()
    {
        return $this->belongsTo(Pembina::class);
    }

    public function log_kegiatan()
    {
        return $this->hasMany(Log_kegiatan::class);
    }
}
