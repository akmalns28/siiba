<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detail_barang(){
        return $this->hasMany(DetailBarang::class);
    }
    
    public function barang_masuk(){
        return $this->hasMany(BarangMasuk::class);
    }
    
    public function detail_barang_masuk(){
        return $this->hasMany(DetailBarangMasuk::class);
    }
    
}
