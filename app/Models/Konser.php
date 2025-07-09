<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Konser extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_konser';

    protected $fillable = [
        'id_user',
        'nama_konser',
        'artis_konser',
        'tanggal_konser',
        'jam_konser',
        'lokasi_konser',
        'deskripsi_konser',
        'status_konser',
        'file_proposal',
        'banner_konser',

    ];

    protected static function booted()
    {
        static::creating(function ($konser) {
            $konser->slug = Str::slug($konser->nama_konser);
        });

        static::updating(function ($konser) {
            $konser->slug = Str::slug($konser->nama_konser);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tiketJenis()
    {
        return $this->hasMany(TiketKonser::class, 'id_konser');
    }

    public function tiketKonser()
    {
        return $this->hasMany(\App\Models\TiketKonser::class, 'id_konser');
    }
}