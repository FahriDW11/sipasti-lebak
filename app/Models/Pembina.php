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

    //relasi ke tahanan
    public function tahanans()
    {
        return $this->hasMany(Tahanan::class);
    }

    public function logKegiatans()
    {
        // Pembina ingin mengakses LogKegiatan melalui Tahanan
        return $this->hasManyThrough(
            Log_kegiatan::class, 
            Tahanan::class, 
            'pembina_id',   // Foreign key di tabel tahanans
            'tahanan_id',   // Foreign key di tabel log_kegiatans
            'id',           // Local key di tabel pembinas
            'id'            // Local key di tabel tahanans
        );
    }
}
