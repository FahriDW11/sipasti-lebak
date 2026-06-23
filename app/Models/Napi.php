<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Napi extends Model
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

    //translate tanggal
    public function getTglLahirFormatAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['tgl_lahir'])
            ->translatedFormat('d F Y');
    }
    public function getJenisKelaminFormatAttribute()
    {
        return $this->attributes['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan';  
    }
}
