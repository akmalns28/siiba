<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Lokasi;
use App\Models\Ruangan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\DetailBarang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpParser\Node\Stmt\Foreach_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LokasiController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Lokasi::where('ruangan_id', 'LIKE', '%' . $request->search . '%')
                ->with('ruangan', 'detail_barang')
                ->paginate(5);
        } else {
            $data = Lokasi::select(DB::raw('MAX(id) as id, ruangan_id'))
                ->groupBy('ruangan_id')
                ->orderBy('ruangan_id')
                ->paginate(10);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }

        $kosong = '';
        $tittle = 'Lokasi';
        $header = 'Data ' . $tittle;
        $ruanganId = Lokasi::pluck('ruangan_id');
        $count = DB::table('lokasis')
            ->where('ruangan_id', '3')
            ->count();
        return view('lokasi.lokasi', compact('data', 'tittle', 'header', 'count', 'kosong'));
    }

    public function tambahLokasi()
    {
        $tittle = 'Lokasi';
        $header = 'Tambah Data ' . $tittle;
        $ruangan = Ruangan::all();
        $detail_barang = DetailBarang::all();
        $barang = Barang::all();
        $kategori = Kategori::all();
        $sub_kategori = SubKategori::all();

        return view('lokasi.tambah-lokasi', compact('tittle', 'header', 'ruangan', 'detail_barang', 'barang', 'kategori', 'sub_kategori'));
    }

    public function insertLokasi(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                // 'lokasi' => 'required|unique:lokasis',
            ],
            [
                'lokasi.required' => 'lokasi tidak boleh kosong',
                'lokasi.unique' => 'lokasi ' . $request->ruangan_id . ' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $selectDetBarang = $request->input('detail_barang_id');

        foreach ($selectDetBarang as $detBarang) {
            $lokasi = new Lokasi();
            $lokasi->user_id = Auth::user()->id;
            $lokasi->tgl_penempatan = '121';
            $lokasi->ruangan_id = $request->ruangan_id;
            $lokasi->detail_barang_id = $detBarang;
            $lokasi->save();
        }

        // Lokasi::create($request->all());
        return redirect()
            ->route('lokasi')
            ->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilLokasi($id)
    {
        $data = Lokasi::find($id);
        // dd($id);
        $tittle = 'Tampil';
        $header = 'lokasi';
        return view('lokasi.update-lokasi', compact('data', 'tittle', 'header'));
    }

    public function multiUpdate(Request $request)
    {
        $ids = $request->input('id');
        $ruangan = $request->input('ruangan_id');

        foreach ($ids as $id) {
            Lokasi::where('id', $id)->update(['ruangan_id' => $ruangan]);
        }

        // Lakukan tindakan lanjutan setelah pembaruan data selesai

        return redirect()
            ->back()
            ->with('success', 'Data mutations berhasil diperbarui.');
    }

    public function detailLokasi($ruangan_id)
    {
        // $data = DetailBarang::where('barang_id', $barang->kategori_id);
        $data = Lokasi::where('ruangan_id', $ruangan_id)->get();
        if ($data->isEmpty()) {
            $kosong = 'Data tidak tersedia';
        }
        $datas = Lokasi::where('ruangan_id', $ruangan_id)->first();

        $kosong = '';
        $ruang = Ruangan::all();
        $lokasi = Lokasi::all();
        $ruangan = $lokasi->find('ruangan_id', $ruangan_id);
        $tittle = 'Detail Lokasi';
        $header = 'Detail Data ' . $tittle;
        return view('lokasi.detail-lokasi', compact('data', 'datas', 'tittle', 'header', 'lokasi', 'ruangan', 'ruang', 'kosong'));
    }

    public function exportPDF()
    {
        // return 'GJ';
        $data = Lokasi::all();
        view()->share('data', $data);
        $pdf = Pdf::loadView('pdf.data-lokasi');
        return $pdf->download('lokasi.pdf');
    }

    public function grafik()
    {
        $tittle = 'Lokasi';
        $header = 'Grafik ' . $tittle;

        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 1; $i <= $bulan; $i++) {
            $totalLokasi = Lokasi::whereYear('created_at', $tahun)
                ->whereMonth('created_at', $i)
                ->count('detail_barang_id');
            $dataBulan[] = Carbon::create()
                ->month($i)
                ->format('F');
            $dataTotalLokasi[] = $totalLokasi;
        }
        $data['dataBulan'] = $dataBulan;
        $data['dataTotalLokasi'] = $dataTotalLokasi;
        return view('lokasi.grafik-lokasi', compact('data', 'tittle', 'header'));
    }
}
