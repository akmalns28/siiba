<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\SubKategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubKategoriController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        // $data = Kategori::all();
        if ($request->has('search')) {
            $data = SubKategori::where('sub_kategori', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = SubKategori::paginate(5);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        $kosong = '';
        $tittle = 'Sub Kategori';
        $header = 'Data '.$tittle;
        return view('subkategori.subkategori', compact('data', 'tittle', 'header','kosong'));
    }

    public function generateCodeSubKategori()
    {
        $lastCategory = SubKategori::latest()->first();

        if (!$lastCategory) {
            $code = '01'; // Jika tidak ada kategori sebelumnya, mulai dengan kode awal
        } else {
            $lastCode = $lastCategory->kode_sub_kategori;
            $number = intval($lastCode); // Mendapatkan angka dari kode terakhir
            $number++; // Menambahkan 1 ke angka sebelumnya
            $code = str_pad($number, 2, '0', STR_PAD_LEFT); // Membentuk kode baru dengan padding nol
        }

        return $code;
    }

    public function tambahSubKategori()
    {
        $tittle = 'Sub Kategori';
        $header = 'Tambah '.$tittle;
        $kategori = Kategori::all();
        return view('subkategori.tambah-subkategori', compact('tittle', 'header','kategori'));
    }

    public function insertSubKategori(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sub_kategori' => 'required|unique:sub_kategoris',
            ],
            [
                'sub_kategori.required' => 'sub kategori tidak boleh kosong',
                'sub_kategori.unique' =>'sub kategori '. $request->subkategori.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $subKategori = new SubKategori();
        $subKategori->kategori_id = $request->kategori_id;
        $subKategori->kode_sub_kategori = $this->generateCodeSubKategori();
        $subKategori->sub_kategori = $request->sub_kategori;
        $subKategori->save();
        return redirect()
            ->route('sub-kategori')
            ->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilSubKategori($id)
    {
        $data = SubKategori::find($id);
        // dd($id);
        $tittle = 'Sub Kategori';
        $header = 'Update '.$tittle;
        return view('subkategori.update-subkategori', compact('data', 'tittle', 'header'));
    }

    public function updateSubKategori(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'sub_kategori' => 'required|unique:subkategoris',
            ],
            [
                'sub_kategori.required' => 'sub kategori tidak boleh kosong',
                'sub_kategori.unique' =>'sub kategori '. $request->subkategori.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = SubKategori::find($id);
        $data->update($request->all());
        return redirect()->route('subkategori')->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteSubKategori($id)
    {
        $data = SubKategori::find($id);
        $data->delete();
        return redirect()->route('kategori')->with('success', 'Data Telah Berhasil Di Hapus');
    }
}
