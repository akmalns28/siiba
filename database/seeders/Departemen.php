<?php

namespace Database\Seeders;

use App\Models\Departemen as ModelsDepartemen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Departemen extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departemen = [
            [
                'departemen' => 'TKJ',
                'deskripsi' => 'Teknik Jaringan Komputer',
            ],
            [
                'departemen' => 'TAV',
                'deskripsi' => 'Teknik Audio Video',
            ],
            [
                'departemen' => 'TKR',
                'deskripsi' => 'Teknik Kendaraan Ringan',
            ],
            [
                'departemen' => 'TPM',
                'deskripsi' => 'Teknik Mesin',
            ],
        ];

        foreach ($departemen as $key => $value) {
            ModelsDepartemen::create($value);
        }
    }
}
