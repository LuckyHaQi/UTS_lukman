<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transaksi';

    protected $table = 'transaksi';

    protected $fillable = [
        'id_pelanggan',
        'id_produk',
        'tanggal',
        'jumlah',
    ];

    // Relasi: Transaksi milik satu Pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }

    // Relasi: Transaksi milik satu Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
