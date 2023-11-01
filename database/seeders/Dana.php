<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dana as ModelsDana;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Dana extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dana = [
            [
                'dana' => 'BOS',
            ],
            [
                'dana' => 'Hibah',
            ],
            
        ];

        foreach ($dana as $key => $value) {
            ModelsDana::create($value);
        }
    }
}
