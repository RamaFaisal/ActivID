<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiSewaLapangan extends Model
{
    use HasFactory;

    public $fillable = [
        'lapangan_id',
        'tanggal_sesi',
        'jam_mulai_sesi',
        'jam_selesai_sesi',
        'harga_per_sesi',
        'is_available',
        'is_booked',
    ];

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'lapangan_id');
    }

    public function sewa()
    {
        return $this->hasOne(SewaLapangan::class, 'id_lapangan', 'lapangan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
