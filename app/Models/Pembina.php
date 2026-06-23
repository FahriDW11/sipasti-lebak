<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembina extends Model
{
    //fillable
    protected $fillable = [
        'user_id',
        'nama',
        'jenis_kelamin',
        'no_telp',
        'email',
        'photo',
    ];

    //relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //relasi ke napi
    public function napis()
    {
        return $this->hasMany(Napi::class);
    }

    public function logKegiatans()
    {
        // Pembina ingin mengakses LogKegiatan melalui Napi
        return $this->hasManyThrough(
            Log_kegiatan::class, 
            Napi::class, 
            'pembina_id',   // Foreign key di tabel napis
            'napi_id',   // Foreign key di tabel log_kegiatans
            'id',           // Local key di tabel pembinas
            'id'            // Local key di tabel napis
        );
    }
}
