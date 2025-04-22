<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_produk';

    protected $table = 'produk';

    protected $fillable = [
        'nama_produk',
        'harga',
    ];

    // Relasi: Produk punya banyak Transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_produk');
    }
}
