<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaLapangan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sewa';

    protected $fillable = [
        'id_user',
        'id_lapangan',
        'nama_penyewa',
        'catatan',
        'metode_booking',
        'tanggal_sewa',
        'jam_mulai_sewa',
        'jam_selesai_sewa',
        'durasi_sewa',
        'total_harga_sewa',
        'fee_platform',
        'jumlah_diterima',
        'status_pembayaran_sewa',
        'status_verifikasi_admin',
        'status_checkin',
        'checkin_at',
        'metode_pembayaran',
        'qr_code_verifikasi_sewa',
        'tanggal_pemesanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function lapangan()
    {
        return $this->belongsTo(Lapangan::class, 'id_lapangan');
    }
}
