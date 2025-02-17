<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        "nama",
        "harga",
        "deskripsi",
        "stok",
        "kategori",
        "foto"
    ];
}
