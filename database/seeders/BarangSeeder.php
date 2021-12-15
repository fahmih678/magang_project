<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Barang::updateOrInsert(
            ['id' => 1],
            ['nama' => 'Kursi', 'deskripsi' => 'Bekas', 'path_file' => 'coba']
        );
        Barang::updateOrInsert(
            ['id' => 2],
            ['nama' => 'Meja', 'deskripsi' => 'Bekas', 'path_file' => 'coba']
        );
        Barang::updateOrInsert(
            ['id' => 3],
            ['nama' => 'Lemari', 'deskripsi' => 'Bekas', 'path_file' => 'coba']
        );
    }
}
