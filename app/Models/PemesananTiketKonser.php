<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemesananTiketKonser extends Model
{
    use HasFactory;

    protected $table = 'pemesanan_tiket_konser';
    protected $primaryKey = 'id_pemesanan_tiket';

    protected $fillable = [
        'id_user',
        'id_jenis_tiket',
        'jumlah_tiket_dibeli',
        'total_harga_pemesanan',
        'tanggal_pemesanan_tiket',
        'status_pembayaran_tiket',
        'qr_code_verifikasi_tiket',
        'is_verified',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jenisTiket()
    {
        return $this->belongsTo(TiketKonser::class, 'id_jenis_tiket');
    }

    public function tiketIndividu()
    {
        return $this->hasMany(TiketIndividu::class, 'id_pemesanan_tiket');
    }
}
