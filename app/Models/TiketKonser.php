<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiketKonser extends Model
{
    use HasFactory;

    protected $table = 'tiket_konser';
    protected $primaryKey = 'id_jenis_tiket';

    protected $fillable = [
        'id_konser',
        'nama_jenis_tiket',
        'harga_tiket',
        'kuota_jenis_tiket',
    ];

    public function konser()
    {
        return $this->belongsTo(Konser::class, 'id_konser');
    }

    public function pemesanan()
    {
        return $this->hasMany(PemesananTiketKonser::class, 'id_jenis_tiket');
    }
}
