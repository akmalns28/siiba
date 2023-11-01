<?php

namespace Database\Seeders;

use App\Models\Satuan;
use Illuminate\Database\Seeder;

class SatuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satuan = [
            [
                'satuan' => 'Pcs',
            ],
            [
                'satuan' => 'Packet',
            ],
        ];

        foreach ($satuan as $key => $value) {
            Satuan::create($value);
        }
    }
}
