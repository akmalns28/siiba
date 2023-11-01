<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarang extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function departemen(){
        return $this->belongsTo(Departemen::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detail_barang_masuk(){
        return $this->belongsTo(DetailBarangMasuk::class);
    }

    public function barang(){
        return $this->belongsTo(Barang::class);
    }

    public function lokasi(){
        return $this->hasMany(Lokasi::class);
    }

    public function peminjaman(){
        return $this->hasMany(Peminjaman::class);
    }

}
