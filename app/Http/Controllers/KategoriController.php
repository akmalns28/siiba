<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        // $data = Kategori::all();
        $kosong = '';

        if ($request->has('search')) {
            $data = Kategori::where('kategori', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = Kategori::paginate(5);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }

        $tittle = 'Kategori';
        $header = 'Data '.$tittle;
        return view('kategori.kategori', compact('data', 'tittle', 'header','kosong'));
    }

    public function getSubCategories($category_id)
    {
        $subCategories = SubKategori::where('kategori_id', $category_id)->get();

        return response()->json($subCategories);
    }

    public function generateCodeKategori()
    {
        $lastCategory = Kategori::latest()->first();

        if (!$lastCategory) {
            $code = '01'; // Jika tidak ada kategori sebelumnya, mulai dengan kode awal
        } else {
            $lastCode = $lastCategory->kode_kategori;
            $number = intval($lastCode); // Mendapatkan angka dari kode terakhir
            $number++; // Menambahkan 1 ke angka sebelumnya
            $code = str_pad($number, 2, '0', STR_PAD_LEFT); // Membentuk kode baru dengan padding nol
        }

        return $code;
    }

    public function tambahKategori()
    {
        $tittle = 'Kategori';
        $header = 'Tambah '.$tittle;
        return view('kategori.tambah-kategori', compact('tittle', 'header'));
    }

    public function insertKategori(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kategori' => 'required|unique:kategoris',
            ],
            [
                'kategori.required' => 'kategori tidak boleh kosong',
                'kategori.unique' => 'kategori ' . $request->kategori . ' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kategori = new Kategori();
        $kategori->kode_kategori = $this->generateCodeKategori();
        $kategori->kategori = $request->kategori;
        $kategori->save();
        return redirect()
            ->route('kategori')
            ->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilKategori($id)
    {
        $data = Kategori::find($id);
        // dd($id);
        $tittle = 'Tampil';
        $header = 'Update Data '.$tittle;
        return view('kategori.update-kategori', compact('data', 'tittle', 'header'));
    }

    public function updateKategori(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kategori' => 'required|unique:kategoris',
            ],
            [
                'kategori.required' => 'kategori tidak boleh kosong',
                'kategori.unique' => 'kategori ' . $request->kategori . ' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = Kategori::find($id);
        $data->update($request->all());
        return redirect()
            ->route('kategori')
            ->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteKategori($id)
    {
        $data = Kategori::find($id);
        $data->delete();
        return redirect()
            ->route('kategori')
            ->with('success', 'Data Telah Berhasil Di Hapus');
    }
}
