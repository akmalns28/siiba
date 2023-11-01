<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SatuanController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        // $data = satuan::all();
        if ($request->has('search')) {
            $data = Satuan::where('satuan', 'LIKE', '%' . $request->search . '%')->paginate(5);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak ditemukan';
            }
        } else {
            $data = Satuan::paginate(5);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }

        $kosong = '';
        $tittle = 'Satuan';
        $header = 'Data '.$tittle;
        return view('satuan.satuan', compact('data', 'tittle', 'header','kosong'));
    }

    public function tambahSatuan()
    {
        $tittle = 'Satuan';
        $header = 'Tambah Data '.$tittle;
        return view('satuan.tambah-satuan', compact('tittle', 'header'));
    }

    public function insertSatuan(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'satuan' => 'required|unique:satuans',
            ],
            [
                'satuan.required' => 'satuan tidak boleh kosong',
                'satuan.unique' =>'satuan '. $request->satuan.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        Satuan::create($request->all());
        return redirect()->route('satuan')->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilSatuan($id)
    {
        $data = Satuan::find($id);
        // dd($id);
        $tittle = 'Satuan';
        $header = 'Update Data '.$tittle;
        return view('satuan.tampil-satuan', compact('data', 'tittle', 'header'));
    }

    public function updateSatuan(Request $request, $id)
    {
        $data = Satuan::find($id);
        $data->update($request->all());
        return redirect()->route('satuan')->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteSatuan($id)
    {
        $data = Satuan::find($id);
        $data->delete();
        return redirect()->route('satuan')->with('success', 'Data Telah Berhasil Di Hapus');
    }
}
