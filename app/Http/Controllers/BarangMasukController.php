<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Dana;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Supplier;
use App\Models\Departemen;
use App\Models\BarangMasuk;
use App\Models\DetailBarang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailBarangMasuk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BarangMasukController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        $kosong = '';

        if ($request->has('search')) {
            $data = BarangMasuk::where('kode_barang_masuk', 'LIKE', '%' . $request->search . '%')
                ->with('dana', 'barang', 'supplier')
                ->paginate(5);
        } else {
            $data = BarangMasuk::paginate(50);

            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        $barang = Barang::all();
        $dana = Dana::all();
        $supplier = Supplier::all();
        $tittle = 'Barang Masuk';
        $header = 'Data ' . $tittle;
        // return view('barang-masuk.barang-masuk', compact('data', 'tittle', 'header'));
        return view('barang-masuk.barang-masuk', compact('data', 'tittle', 'header', 'barang', 'dana', 'supplier', 'kosong'));
    }

    public function tambahBarangMasuk()
    {
        $tittle = 'Barang Masuk';
        $header = 'Tambah Data ' . $tittle;
        $barang = Barang::all();
        $dana = Dana::all();
        $supplier = Supplier::all();
        $kategori = Kategori::all();
        $departemen = Departemen::all();
        return view('barang-masuk.tambah-barang-masuk', compact('tittle', 'header', 'barang', 'dana', 'supplier', 'kategori', 'departemen'));
    }

    public function generateCodeBrgMsk()
    {
        $lastProduct = BarangMasuk::latest()->first();

        if (!$lastProduct) {
            $code = 'PAS2-001'; // Jika tidak ada produk sebelumnya, mulai dengan kode awal
        } else {
            $lastCode = $lastProduct->kode_barang_masuk;
            $number = intval(substr($lastCode, -3)); // Mendapatkan angka dari kode terakhir
            $number++; // Menambahkan 1 ke angka sebelumnya
            $code = 'PAS2-' . str_pad($number, 3, '0', STR_PAD_LEFT); // Membentuk kode baru dengan padding nol
        }

        return $code;
    }

    public function insertBarangMasuk(Request $request)
    {
        try {
            $data = $request->input('data');
            $dana = $data['danaId'];
            $supplier = $data['supplierId'];
            $tgl_barang_masuk = $data['tgl_barang_masuk'];

            // Simpan data barang masuk
            $barangMasuk = new BarangMasuk();
            // Set kolom-kolom yang diperlukan sesuai dengan inputan
            $barangMasuk->supplier_id = $supplier;
            $barangMasuk->dana_id = $dana;
            $barangMasuk->kode_barang_masuk = $this->generateCodeBrgMsk();
            $barangMasuk->tgl_masuk_barang = $tgl_barang_masuk;
            // Lanjutkan untuk set kolom-kolom lainnya
            $barangMasuk->save();

            $barang_masuk_id = $barangMasuk->id;
            $dataDetailBarang = $data['dataDetail'];

            foreach ($dataDetailBarang as $value) {
                $barangId = $value['barangId'];
                $pemilikId = $value['pemilikId'];
                $barangMasukId = $barang_masuk_id;
                $userId = Auth::user()->id;
                $namaBarang = $value['namaProduk'];
                $jumlah = $value['jumlah'];
                $totalHarga = $value['harga'];

                // Buat instance baru dari model DetailBarangMasuk
                $detailBarangMasuk = new DetailBarangMasuk();
                $detailBarangMasuk->barang_id = $barangId;
                $detailBarangMasuk->barang_masuk_id = $barangMasukId;
                $detailBarangMasuk->user_id = $userId;
                $detailBarangMasuk->pemilik_id = $pemilikId;
                $detailBarangMasuk->nama_barang = $namaBarang;
                $detailBarangMasuk->jumlah = $jumlah;
                $detailBarangMasuk->harga = $totalHarga;
                // Lanjutkan untuk set kolom-kolom lainnya jika ada
                $detailBarangMasuk->save();

                for ($i = 0; $i < $jumlah; $i++) {
                    $barang = Barang::find($barangId);

                    if ($barang) {
                        $kategori = $barang->kategori->kode_kategori; // Mengambil kode kategori dari relasi
                        $subkategori = $barang->sub_kategori->kode_sub_kategori; // Mengambil kode subkategori dari relasi

                        $detailBarangMasuk = DetailBarangMasuk::where('barang_id', $barangId)
                            ->latest()
                            ->first();

                        if ($detailBarangMasuk) {
                            $pemilik = $detailBarangMasuk->pemilik_id;

                            $lastProduct = DetailBarang::where('barang_id', $barangId)
                                ->latest()
                                ->first();

                            $no_regis = 1; // Nomor registrasi awal
                            if ($lastProduct) {
                                $lastCode = $lastProduct->no_registrasi;
                                $no_regis = intval($lastCode) + 1; // Mendapatkan angka dari kode terakhir dan menambahkannya dengan 1
                            }

                            $no_registrasi = str_pad($no_regis, 3, '0', STR_PAD_LEFT);

                            for ($i = 0; $i < $jumlah; $i++) {
                                $kode_barang = $kategori . '.' . $subkategori . '.' . $no_registrasi;
                                $no_inventarisasi = $pemilik . '.' . $kategori . '.' . $subkategori . '.' . $no_registrasi;

                                $detail_barang = new DetailBarang();
                                $detail_barang->barang_id = $detailBarangMasuk->barang_id;
                                $detail_barang->detail_barang_masuk_id = $detailBarangMasuk->id;
                                $detail_barang->user_id = Auth::user()->id;
                                $detail_barang->kondisi = $request->input('kondisi', 'Baik');
                                $detail_barang->kode_barang = $kode_barang;
                                $detail_barang->status = 'In Stock';
                                $detail_barang->no_registrasi = $no_registrasi;
                                $detail_barang->no_inventarisasi = $no_inventarisasi;
                                $detail_barang->keterangan = $request->keterangan;
                                $detail_barang->save();

                                // Increment nomor registrasi untuk baris selanjutnya
                                $no_regis++;
                                $no_registrasi = str_pad($no_regis, 3, '0', STR_PAD_LEFT);
                            }
                        }
                    }
                }
            }

            $result = [
                'status' => true,
            ];
            return response()->json($result);
        } catch (\Exception $e) {
            // Tangkap exception yang terjadi
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function detailBarangMasuk($barang_masuk_id)
    {
        $distinctData = DB::table('detail_barang_masuks')
            ->select('nama_barang')
            ->distinct()
            ->get();

        $data = DetailBarangMasuk::where('barang_masuk_id', $barang_masuk_id)->get();
        $tittle = 'Barang Masuk';
        $header = 'Detail Data ' . $tittle;
        return view('barang-masuk.detail-barang-masuk', compact('data', 'tittle', 'header'));
    }

    public function tampilBarangMasuk($id)
    {
        $data = BarangMasuk::find($id);
        // dd($id);
        $tittle = 'Tampil';
        $header = '';
        return view('barang-masuk.update-barang-masuk', compact('data', 'tittle', 'header'));
    }

    public function updateBarangMasuk(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'barang-masuk' => 'required|unique:barang-masuks',
            ],
            [
                'barang-masuk.required' => 'barang-masuk tidak boleh kosong',
                'barang-masuk.unique' => 'barang-masuk ' . $request->barangmasuk . ' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = BarangMasuk::find($id);
        $data->update($request->all());
        return redirect()
            ->route('barang-masuk')
            ->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function exportPDF()
    {
        // return 'GJ';
        $data = BarangMasuk::all();
        view()->share('data', $data);
        $pdf = Pdf::loadView('pdf.data-barang-masuk');
        return $pdf->download('barang-masuk.pdf');
    }

    public function grafik(Request $request)
    {
        $tittle = 'Barang Masuk';
        $header = 'Grafik ' . $tittle;

        $startYear = 2020; // Tahun mulai
        $endYear = date('Y'); // Tahun akhir (tahun saat ini)
        $selectedYear = $request->input('year', $endYear); // Mengambil tahun dari input form, defaultnya tahun saat ini

        $dataBulan = []; // Array untuk menyimpan bulan
        $dataTotalBarangMasuk = []; // Array untuk menyimpan total barang masuk

        for ($month = 1; $month <= 12; $month++) {
            $totalBarangMasuk = DetailBarangMasuk::whereYear('created_at', $selectedYear)
                ->whereMonth('created_at', $month)
                ->sum('harga');
            $dataBulan[] = Carbon::create()
                ->year($selectedYear)
                ->month($month)
                ->format('F');
            $dataTotalBarangMasuk[] = $totalBarangMasuk;
        }

        $data['dataBulan'] = $dataBulan;
        $data['dataTotalBarangMasuk'] = $dataTotalBarangMasuk;
        $data['selectedYear'] = $selectedYear;

        return view('barang-masuk.grafik-barang-masuk', compact('data', 'tittle', 'header','startYear','endYear','selectedYear'));
    }
}
