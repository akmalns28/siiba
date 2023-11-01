<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RuanganController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = Ruangan::where('ruangan', 'LIKE', '%' . $request->search . '%')
            ->orWhere('kode_ruangan', 'LIKE', '%' . $request->search . '%')
            ->paginate(5);
        } else {
            $data = Ruangan::paginate(5);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }

        $kosong = '';
        $tittle = 'Ruangan';
        $header = 'Data '.$tittle;
        return view('ruangan.ruangan', compact('data', 'tittle', 'header','kosong'));
    }

    public function tambahRuangan()
    {
        $tittle = 'Ruangan';
        $header = 'Tambah Data '.$tittle;
        return view('ruangan.tambah-ruangan', compact('tittle', 'header'));
    }

    public function insertRuangan(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'kd_ruangan' => 'required|unique:ruangans',
                'ruangan' => 'required|unique:ruangans',
            ],
            [
                'kd_ruangan.required' => 'kode ruangan tidak boleh kosong',
                'kd_ruangan.unique' =>'kode ruangan '. $request->kd_ruangan.' sudah digunakan',
                'ruangan.required' => 'ruangan tidak boleh kosong',
                'ruangan.unique' =>'ruangan '. $request->ruangan.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }


        Ruangan::create($request->all());
        return redirect()->route('ruangan')->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilRuangan($id)
    {
        $data = Ruangan::find($id);
        // dd($id);
        $tittle = 'Ruangan';
        $header = 'Update Data '.$tittle;
        return view('ruangan.tampil-ruangan', compact('data', 'tittle', 'header'));
    }

    public function updateRuangan(Request $request, $id)
    {
        $data = Ruangan::find($id);
        $data->update($request->all());
        return redirect()->route('ruangan')->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteRuangan($id)
    {
        $data = Ruangan::find($id);
        $data->delete();
        return redirect()->route('ruangan')->with('success', 'Data Telah Berhasil Di Hapus');
    }
}
