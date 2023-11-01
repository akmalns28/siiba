<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dana extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function barang_masuk(){
        return $this->hasMany(BarangMasuk::class);
    }
}
