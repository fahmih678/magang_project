<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kategori::updateOrInsert(
            ['id' => 1],
            ['nama' => 'Pakaian']
        );
        Kategori::updateOrInsert(
            ['id' => 2],
            ['nama' => 'Perkakas']
        );
        Kategori::updateOrInsert(
            ['id' => 3],
            ['nama' => 'Tool']
        );
    }
}
