<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Satuan;
use App\Models\Kategori;
use App\Models\Departemen;
use Illuminate\Support\Str;
use App\Models\DetailBarang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\DetailBarangMasuk;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    private $tittle = '';
    private $header = '';
    protected $kosong = '';
    public function index(Request $request)
    {
        // single funct
        $cBarang = Barang::all()->count();
        // $cBarangTetap = Barang::where('jenis_barang', 'Barang Tetap')->count();
        // $cBarangSekaliPakai = Barang::where('jenis_barang', 'Barang Sekali Pakai')->count();
        $sStok = Barang::sum('stok');

        $kosong = '';

        if ($request->has('search')) {
            $data = Barang::where('barang', 'LIKE', '%' . $request->search . '%')->paginate(25);
        } else {
            $data = Barang::select('kategori_id', 'sub_kategori_id', 'satuan_id', 'aset', 'stok', 'user_id')
                ->distinct()
                ->paginate(25);

            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }

        $tittle = 'Barang';
        $header = 'Data ' . $tittle;
        return view('barang.barang', compact('data', 'tittle', 'header', 'kosong'));
    }

    public function tambahBarang()
    {
        $tittle = 'Barang';
        $header = 'Tambah Data Barang';
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $departemen = Departemen::all();
        return view('barang.tambah-barang', compact('tittle', 'header', 'kategori', 'satuan', 'departemen'));
    }

    public function insertBarang(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kategori_id' => 'required',
                'sub_kategori_id' => 'required',
                'aset' => 'required',
                'satuan_id' => 'required',
            ],
            [
                'kategori_id.required' => 'kategori_id tidak boleh kosong',
                'sub_kategori_id.required' => 'sub_kategor_idi tidak boleh kosong',
                'aset.required' => 'aset tidak boleh kosong',
                'satuan_id.required' => 'satuan tidak b_idoleh kosong',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $barang = new Barang();
        if ($request->hasFile('foto')) {
            $request->file('foto')->move('foto-barang/', $request->file('foto')->getClientOriginalName());
            $barang->foto = $request->file('foto')->getClientOriginalName();
            $barang->user_id = Auth::user()->id;
            $barang->kategori_id = $request->kategori_id;
            $barang->sub_kategori_id = $request->sub_kategori_id;
            $barang->aset = $request->aset;
            $barang->satuan_id = $request->satuan_id;
            $barang->stok = $request->input('stok', '0');
            $barang->save();
        }

        return redirect()
            ->route('barang')
            ->with('kategori', 'success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilBarang($id)
    {
        $data = Barang::find($id);
        $tittle = 'Barang';
        $header = 'Update Data ' . $tittle;
        $kategori = Kategori::all();
        $satuan = Satuan::all();
        $departemen = Departemen::all();
        return view('barang.update-barang', compact('data', 'tittle', 'header', 'kategori', 'satuan', 'departemen'));
    }

    public function updateBarang(Request $request, $id)
    {
        $data = Barang::find($id);
        $data->update($request->all());
        return redirect()
            ->route('barang')
            ->with('success', 'Data Telah Berhasil Di Ubah');

        return redirect()
            ->route('barang')
            ->with('success', 'Data barang berhasil diperbarui');
    }

    public function detailBarang($sub_kategori_id)
    {
        $data = DetailBarang::join('barangs', 'detail_barangs.barang_id', '=', 'barangs.id')
            ->where('barangs.sub_kategori_id', $sub_kategori_id)
            ->where('detail_barangs.status', 'In Stock') // Kondisi status = In Stock
            ->paginate(25);

        if ($data->isEmpty()) {
            $kosong = 'Data tidak tersedia';
        } else {
            $kosong = ''; // Jika ada data, kosongkan variabel $kosong
        }

        $tittle = 'Barang';
        $header = 'Update Data ' . $tittle;
        return view('detail-barang.detail-barang', compact('data', 'tittle', 'header', 'kosong'));
    }

    public function exportPDF()
    {
        // return 'GJ';
        $data = Barang::all();
        view()->share('data', $data);
        $pdf = Pdf::loadView('pdf.data-barang');
        return $pdf->download('barang.pdf');
    }

    public function grafik()
    {
        $total_barang = Barang::select(DB::raw('CAST(count(*) as int) as total_barang'))
            ->groupBy(DB::raw('Month(created_at'))
            ->pluck('total_barang');

        $bulan = Barang::select(DB::raw('CAST(count(*) as int) as bulan'))
            ->groupBy(DB::raw('Month(created_at'))
            ->pluck('bulan');

        return view('peminjaman.grafik-peminjaman', compact('total_barang', 'bulan'));
    }
}
