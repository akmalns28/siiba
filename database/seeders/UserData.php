<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'name' =>'Akmal',
                'username' =>'admin',
                'password' =>bcrypt('12345678'),
                'hak_akses_id' => 1,

            ],
            [
                'name' =>'Ahmad',
                'username' =>'operator',
                'password' =>bcrypt('12345678'),
                'hak_akses_id' => 2,

            ],
            [
                'name' =>'Bambang',
                'username' =>'kepsek',
                'password' =>bcrypt('12345678'),
                'hak_akses_id' => 3,
            ],
            [
                'name' =>'ANS',
                'username' =>'akmalns28',
                'password' =>bcrypt('akmalns_'),
                'hak_akses_id' => 1,
            ],
            ];

            foreach ($user as $key => $value){
                User::create($value);
            }
    }
}
