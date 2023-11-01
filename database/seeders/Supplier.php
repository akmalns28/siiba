<?php

namespace Database\Seeders;

use App\Models\Supplier as ModelsSupplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Supplier extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supplier = [
            [
                'nama_suplier' => 'PT. ATK Sejahtera',
                'no_hp' => '08123456789',
                'alamat' => 'Jln.Cimahi',
            ],
            [
                'nama_suplier' => 'PT. Abadi',
                'no_hp' => '08123456789',
                'alamat' => 'Jln.Cirebon',
            ],
            [
                'nama_suplier' => 'PT. ANS Teknologi',
                'no_hp' => '08123456789',
                'alamat' => 'Jln.Jatayu',
            ],
            
        ];

        foreach ($supplier as $key => $value) {
            ModelsSupplier::create($value);
        }
    }
}
