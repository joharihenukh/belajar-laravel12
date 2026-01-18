<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'gambar',
        'kode_barang',
        'nama_barang',
        'stok',
        'harga_beli',
        'harga_jual'
    ];
}
