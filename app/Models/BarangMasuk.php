<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function det_barang_masuk(){
        return $this->hasMany(DetailBarangMasuk::class);
    }

    public function dana(){
        return $this->belongsTo(Dana::class);
    }

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    
    public function departemen(){
        return $this->belongsTo(Departemen::class);
    }
}
