<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanKonser extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengaju',
        'email_pengaju',
        'nomor_pengaju',
        'domisili',
        'foto_ktp',
        'status_pengajuan',
    ];
}
