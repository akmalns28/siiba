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
        $kategori = [
            [
                'kode_kategori' => '01',
                'kategori' => 'Elektronik',
            ],
            [
                'kode_kategori' => '02',
                'kategori' => 'Mebel',
            ],
            [
                'kode_kategori' => '03',
                'kategori' => 'Alat Tulis Kantor',
            ],

            
        ];

        foreach ($kategori as $key => $value) {
            Kategori::create($value);
        }
    }
}
