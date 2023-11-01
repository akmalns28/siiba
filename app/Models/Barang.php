<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $fillable= [
        'foto',
        'satuan_id',
        'kategori_id',
        'sub_kategori_id',
        'user_id',
        'aset',
        'stok',
    ];


    public function satuan(){
        return $this->belongsTo(Satuan::class);
    }

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
    
    public function sub_kategori(){
        return $this->belongsTo(SubKategori::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function detail_barang(){
        return $this->hasMany(Barang::class);
    }
    
    public function detail_barang_masuk(){
        return $this->hasMany(DetailBarangMasuk::class);
    }

}
