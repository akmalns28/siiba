<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function peminjam(){
        return $this->belongsTo(Peminjam::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function detail_barang(){
        return $this->belongsTo(DetailBarang::class);
    }

    
}
