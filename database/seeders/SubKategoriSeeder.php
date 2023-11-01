<?php

namespace Database\Seeders;

use App\Models\SubKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_kategori = [
            [
                'kategori_id' => 1,
                'kode_sub_kategori' => '01',
                'sub_kategori' => 'Komputer',
            ],
            [
                'kategori_id' => 1,
                'kode_sub_kategori' => '02',
                'sub_kategori' => 'Laptop',
            ],
            [
                'kategori_id' => 2,
                'kode_sub_kategori' => '03',
                'sub_kategori' => 'Bangku',
            ],
            [
                'kategori_id' => 2,
                'kode_sub_kategori' => '04',
                'sub_kategori' => 'Meja',
            ],
            [
                'kategori_id' => 3,
                'kode_sub_kategori' => '05',
                'sub_kategori' => 'Pulpen',
            ],
            [
                'kategori_id' => 3,
                'kode_sub_kategori' => '06',
                'sub_kategori' => 'Tip-X',
            ],
            

            
        ];

        foreach ($sub_kategori as $key => $value) {
            SubKategori::create($value);
        }
    }
}
