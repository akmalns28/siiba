<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\DetailBarangMasuk;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index()
    {

        $cPeminjaman = Peminjaman::all()->count();
        $cBarangMasuk = DetailBarangMasuk::all()->sum('jumlah');
        $cUser = User::all()->count();
        $sStok = Barang::sum('stok');
        $tittle = 'Dashboard';
        $header = 'Dashboard';
        return view('dashboard', compact('tittle', 'header','cPeminjaman','cBarangMasuk','cUser','sStok'));
    }
}
