<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanLapangan extends Model
{
    protected $fillable = [
        'nama',
        'email',
        'nomor_telepon',
        'domisili',
        'jenis_pengajuan',
    ];
}
