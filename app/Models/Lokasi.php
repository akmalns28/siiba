<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function detail_barang(){
        return $this->belongsTo(DetailBarang::class);
    }

    public function ruangan(){
        return $this->belongsTo(Ruangan::class);
    }
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
