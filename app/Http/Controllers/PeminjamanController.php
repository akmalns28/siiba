<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Peminjam;
use App\Models\Departemen;
use App\Models\Peminjaman;
use App\Models\SubKategori;
use App\Models\DetailBarang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        // show data
        // $cBarang = Peminjaman::all()->count();
        // $cBarangTetap = Peminjaman::where('jenis_barang', 'Barang Tetap')->count();
        // $cBarangSekaliPakai = Peminjaman::where('jenis_barang', 'Barang Sekali Pakai')->count();
        // $sStok = Peminjaman::sum('stok');

        if ($request->has('search')) {
            $data = Peminjaman::where('no_peminjaman', 'LIKE', '%' . $request->search . '%')
                ->with('departemen', 'user', 'detail_barang')
                ->paginate(25);
        } else {
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
            $data = Peminjaman::groupBy('peminjam_id')
                ->whereNull('tgl_kembali')
                ->orderBy('tgl_peminjaman', 'desc')
                ->paginate(25);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        $kosong = '';
        $tittle = 'Peminjaman';
        $header = 'Data ' . $tittle;
        return view('peminjaman.peminjaman', compact('data', 'tittle', 'header', 'kosong'));
    }

    public function generateNoPeminjaman()
    {
        $lastProduct = Peminjaman::latest()->first();

        if (!$lastProduct) {
            $code = 'PJM-001'; // Jika tidak ada produk sebelumnya, mulai dengan kode awal
        } else {
            $lastCode = $lastProduct->no_peminjaman;
            $number = intval(substr($lastCode, -3)); // Mendapatkan angka dari kode terakhir
            $number++; // Menambahkan 1 ke angka sebelumnya
            $code = 'PJM-' . str_pad($number, 3, '0', STR_PAD_LEFT); // Membentuk kode baru dengan padding nol
        }

        return $code;
    }

    public function tambahPeminjaman()
    {
        $tittle = 'Peminjaman';
        $header = 'Tambah Data ' . $tittle;
        $departemen = Departemen::all();
        $detail_barang = DetailBarang::all();
        $barang = Barang::all();
        $sub_kategori = SubKategori::all();
        return view('peminjaman.tambah-peminjaman', compact('tittle', 'header', 'departemen', 'detail_barang', 'barang', 'sub_kategori'));
    }

    public function insertPeminjaman(Request $request)
    {
        // Simpan data peminjaman ke dalam database
        $peminjam = new Peminjam();
        $peminjam->nama = $request->nama;
        $peminjam->no_hp = $request->no_hp;
        $peminjam->jabatan = $request->jabatan;
        $peminjam->save();

        $selectDetBarang = $request->input('detail_barang_id');

        // Simpan data detail barang ke dalam database
        // Simpan data detail barang ke dalam database
        foreach ($selectDetBarang as $detailId) {
            $detailBarang = DetailBarang::find($detailId);

            if ($detailBarang) {
                $detailBarang->status = 'Dipinjam';
                $detailBarang->save();
            }

            // Simpan data peminjaman
            $peminjaman = new Peminjaman();
            $peminjaman->peminjam_id = $peminjam->id;
            $peminjaman->user_id = Auth::user()->id;
            $peminjaman->no_peminjaman = $this->generateNoPeminjaman();
            $peminjaman->detail_barang_id = $detailId;
            $peminjaman->save();
        }

        return redirect()
            ->route('peminjaman')
            ->with('success', 'Data telah berhasil ditambahkan');
    }

    public function updateStatus($peminjamId)
    {
        $peminjamans = Peminjaman::where('peminjam_id', $peminjamId)
            ->whereNull('tgl_kembali')
            ->get();

        foreach ($peminjamans as $peminjaman) {
            $peminjaman->tgl_kembali = Carbon::today();
            $peminjaman->save();
        
            $detailBarang = $peminjaman->detail_barang;

            if ($detailBarang) {
                $detailBarang->status = 'In Stock';
                $detailBarang->save();
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Peminjaman telah selesai, silahkan cek riwayat.');
    }

    public function tampilPeminjaman($id)
    {
        $data = Peminjaman::find($id);
        // dd($id);
        $tittle = 'Tampil';
        $header = 'Update Data ' . $tittle;
        return view('peminjaman.tampil-barang', compact('data', 'tittle', 'header'));
    }

    public function detailPeminjaman($peminjam_id)
    {
        // $data = DetailBarang::where('barang_id', $barang->kategori_id);
        $data = Peminjaman::where('peminjam_id', $peminjam_id)->first();
        $datas = Peminjaman::where('peminjam_id', $peminjam_id)->get();
        $tittle = 'Peminjaman';
        $header = 'Detail ' . $tittle;
        return view('peminjaman.detail-peminjaman', compact('data', 'datas', 'tittle', 'header'));
    }

    public function exportPDF()
    {
        // return 'GJ';
        $data = Peminjaman::all();
        view()->share('data', $data);
        $pdf = Pdf::loadView('pdf.data-peminjaman');
        return $pdf->download('peminjaman.pdf');
    }

    public function riwayatPeminjaman(Request $request)
    {
        if ($request->has('search')) {
            $data = Peminjaman::where('no_peminjaman', 'LIKE', '%' . $request->search . '%')
                ->with('departemen', 'user', 'detail_barang')
                ->paginate(25);
        } else {
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
            $data = Peminjaman::groupBy('peminjam_id')
                ->orderBy('tgl_peminjaman', 'desc')
                ->paginate(25);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        $kosong = '';
        $tittle = 'Peminjaman';
        $header = 'Riwayat ' . $tittle;
        return view('peminjaman.riwayat-peminjaman', compact('data', 'tittle', 'header', 'kosong'));
    }

    public function grafik()
    {
        $tittle = 'Peminjaman';
        $header = 'Grafik ' . $tittle;

        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $totalPeminjaman = Peminjaman::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->count('peminjam_id');
            $dataBulan[] = Carbon::create()
                ->month($i)
                ->format('F');
            $dataTotalPeminjaman[] = $totalPeminjaman;
        }
        $data['dataBulan'] = $dataBulan;
        $data['dataTotalPeminjaman'] = $dataTotalPeminjaman;
        return view('peminjaman.grafik-peminjaman', compact('data', 'tittle', 'header'));
    }
}
