<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangKategori extends Model
{
    use HasFactory;

    protected $table = 'barang_kategori';
    protected $guarded  = [];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }
}
