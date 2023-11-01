<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Lokasi;
use App\Models\Peminjaman;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use App\Models\DetailBarangMasuk;
use Illuminate\Support\Facades\Response;

class LaporanController extends Controller
{
    private $tittle = '';
    public function index(Request $request)
    {
        $tittle = 'Laporan';
        $header = 'Grafik ' . $tittle;

        $startYear = 2020; // Tahun mulai
        $endYear = date('Y'); // Tahun akhir (tahun saat ini)
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $selectedYear = $request->query('year', ''); // Mengambil tahun dari input form, defaultnya tahun saat ini
        $selectedMonth = $request->query('selectedMonth',);
        $selectedTransaksi = $request->query('transaksi', ''); // Mengambil jenis transaksi dari input form, defaultnya barang masuk

        $dataBulan = []; // Array untuk menyimpan bulan
        $dataTotalTransaksi = []; // Array untuk menyimpan total transaksi
        $dataDBM = []; // Array untuk menyimpan data transaksi barang masuk
        $dataLokasi = []; // Array untuk menyimpan data transaksi lokasi
        $dataPeminjaman = []; // Array untuk menyimpan data transaksi peminjaman

        for ($month = 1; $month <= 12; $month++) {
            $totalTransaksi = 0;
            if ($selectedTransaksi === 'barang_masuk') {
                $totalTransaksi = DetailBarangMasuk::whereYear('created_at', $selectedYear)
                    ->whereMonth('created_at', $month)
                    ->sum('harga');
                $dataDBM = DetailBarangMasuk::whereYear('created_at', $selectedYear)
                    ->whereMonth('created_at', $selectedMonth)
                    ->with('barang_masuk','barang','departemen',)
                    ->get();
            } elseif ($selectedTransaksi === 'lokasi') {
                $totalTransaksi = Lokasi::whereYear('created_at', $selectedYear)
                    ->whereMonth('created_at', $month)
                    ->count('detail_barang_id');
                $dataLokasi = Lokasi::whereYear('created_at', $selectedYear)
                    ->whereMonth('created_at', $selectedMonth)
                    ->with('ruangan','detail_barang')
                    ->get();
            } elseif ($selectedTransaksi === 'peminjaman') {
                $totalTransaksi = Peminjaman::select('peminjam_id')
                    ->whereYear('created_at', $selectedYear)
                    ->whereMonth('created_at', $month)
                    ->distinct('peminjam_id')
                    ->count();
                $dataPeminjaman = Peminjaman::whereYear('created_at', $selectedYear)
                    ->whereMonth('created_at', $selectedMonth)
                    ->with('peminjam','detail_barang')
                    ->get();
            }

            $dataBulan[] = Carbon::create()
                ->year($selectedYear)
                ->month($month)
                ->format('F');
            $dataTotalTransaksi[] = $totalTransaksi;
        }

        $data['dataBulan'] = $dataBulan;
        $data['dataTotalTransaksi'] = $dataTotalTransaksi;
        $data['selectedYear'] = $selectedYear;
        $data['selectedTransaksi'] = $selectedTransaksi;
        // Gabungkan data dari tiga tabel dan kirimkan sebagai JSON
        $mergedData = [
            'dataDBM' => $dataDBM,
            'dataLokasi' => $dataLokasi,
            'dataPeminjaman' => $dataPeminjaman,
        ];

        // Check if it's an AJAX request
        if ($request->ajax()) {
            // Return JSON data for the AJAX request
            return Response::json($mergedData);
        }
        
        return view('laporan.laporan', compact('data', 'tittle', 'header', 'startYear', 'endYear', 'selectedYear', 'selectedTransaksi', 'totalTransaksi', 'selectedMonth', 'dataDBM', 'dataLokasi', 'dataPeminjaman','mergedData'));
    }

    
}
