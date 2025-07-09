<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketIndividu extends Model
{
    use HasFactory;

    protected $table = 'tiket_individu';
    protected $primaryKey = 'id_tiket_individu';

    protected $fillable = [
        'id_pemesanan_tiket',
        'qr_code',
        'is_verified',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(PemesananTiketKonser::class, 'id_pemesanan_tiket');
    }
}
