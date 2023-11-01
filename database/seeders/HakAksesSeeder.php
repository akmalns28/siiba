<?php

namespace Database\Seeders;

use App\Models\HakAkses;
use Illuminate\Database\Seeder;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hakakses = [
            [
                'level' => '1',
                'hak_akses' => 'Administrator',
            ],
            [
                'level' => '2',
                'hak_akses' => 'Kepala Sekolah',
            ],
            [
                'level' => '3',
                'hak_akses' => 'Operator',
            ],
        ];

        foreach ($hakakses as $key => $value) {
            HakAkses::create($value);
        }
    }
}

