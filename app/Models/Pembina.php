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
    public function tahanan()
    {
        return $this->hasMany(Tahanan::class);
    }
}
