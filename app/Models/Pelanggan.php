<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';  // karena tidak pakai id biasa


    protected $fillable = [
        'nama',
        'email',
        'no_hp',
    ];

    // Relasi: Pelanggan punya banyak Transaksi
    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'id_pelanggan');
    }
}
