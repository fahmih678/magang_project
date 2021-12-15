<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';
    protected $guarded = [];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'barang_kategori', 'id_barang', 'id_kategori');
    }

    public function hasKategori($kategori)
    {
        if ($this->kategoris()->where('nama', $kategori)->first()) {
            return true;
        }
    }

    public function barangKategori()
    {
        return $this->hasMany(BarangKategori::class, 'id_barang', 'id');
    }
}
