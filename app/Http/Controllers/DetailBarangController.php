<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Departemen;
use App\Models\DetailBarang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailBarangController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request,$kategori_id)
    {
        // $data = barang::all();
        $kosong = '';
        if ($request->has('search')) {
            $data = DetailBarang::where('barang_id', 'LIKE', '%' . $request->search . '%')
                ->with('barang', 'user','lokasi','ruangan')
                ->paginate(25);
        } else {
            $data = DetailBarang::paginate(25);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        $tittle = 'Barang';
        $header = 'Data Barang';
        return view('detail-barang.detail-barang', compact('data', 'tittle', 'header','kosong'));
    }

    public function tampilDetBarang($id)
    {
        $data = DetailBarang::find($id);
        $barang = Barang::all();
        $user = User::all();
        $departemen = Departemen::all();
        $tittle = 'Tampil';
        $header = 'Update Data Barang';
        return view('detail-barang.view-detail', compact('data', 'tittle', 'header','barang','user','departemen'));
    }

    public function updateDepartemen(Request $request, $id)
    {
        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'departemen' => 'required|unique:departemens',
        //         'deskripsi' => 'required|unique:departemens',
        //     ],
        //     [
        //         'departemen.required' => 'departemen tidak boleh kosong',
        //         'departemen.unique' =>'departemen '. $request->departemen.' sudah digunakan',
        //         'deskripsi.required' => 'deskripsi tidak boleh kosong',
        //         'deskripsi.unique' =>'deskripsi '. $request->deskripsi.' sudah digunakan',
        //     ],
        // );

        // if ($validator->fails()) {
        //     return redirect()
        //         ->back()
        //         ->withErrors($validator)
        //         ->withInput();
        // }

        $data = DetailBarang::find($id);
        $data->update($request->all());
        return redirect()->route('departemen')->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteDetailBarang($id)
    {
        $data = DetailBarang::find($id);
        $data->delete();
        return redirect()->route('detail-barang')->with('success', 'Data Telah Berhasil Di Hapus');
    }


}
