<?php

namespace Database\Seeders;

use App\Models\Ruangan;
use Illuminate\Database\Seeder;

class RuanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ruangan = [
            [
                'kd_ruangan' => 'R-01',
                'ruangan' => 'Ruangan 1',
            ],
            [
                'kd_ruangan' => 'R-02',
                'ruangan' => 'Ruangan 2',
            ],
            [
                'kd_ruangan' => 'LTAV 01',
                'ruangan' => 'Lab TAV 1',
            ],
            
        ];

        foreach ($ruangan as $key => $value) {
            Ruangan::create($value);
        }
    }
}
