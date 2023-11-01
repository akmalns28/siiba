<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBarangMasuk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function barang(){
        return $this->belongsTo(Barang::class);
    }

    public function detail_barang(){
        return $this->hasMany(DetailBarang::class);
    }

    public function barang_masuk(){
        return $this->belongsTo(BarangMasuk::class);
    }
    
    public function departemen(){
        return $this->belongsTo(Departemen::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


}



