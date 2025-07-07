<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Lapangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lapangan',
        'jenis_lapangan',
        'deskripsi_lapangan',
        'alamat',
        'is_active',
        'jam_operasional_mulai',
        'jam_operasional_selesai',
        'user_id',
        'gambar',
    ];

    protected static function booted()
    {
        static::creating(function ($lapangan) {
            $lapangan->slug = Str::slug($lapangan->nama_lapangan);
        });

        static::updating(function ($lapangan) {
            $lapangan->slug = Str::slug($lapangan->nama_lapangan);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sesiSewa()
    {
        return $this->hasMany(SesiSewaLapangan::class, 'lapangan_id');
    }
}
