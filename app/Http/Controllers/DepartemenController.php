<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartemenController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        // $data = departemen::all();
        $kosong = '';

        if ($request->has('search')) {
            $data = Departemen::where('departemen', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = Departemen::paginate(5);

            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        $tittle = 'Departemen';
        $header = 'Data '.$tittle;
        return view('departemen.departemen', compact('data', 'tittle', 'header','kosong'));
    }

    public function tambahDepartemen()
    {
        $tittle = 'Departemen';
        $header = 'Tambah Data '.$tittle;
        return view('departemen.tambah-departemen', compact('tittle', 'header'));
    }

    public function insertDepartemen(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'departemen' => 'required|unique:departemens',
                'deskripsi' => 'required|unique:departemens',
            ],
            [
                'departemen.required' => 'departemen tidak boleh kosong',
                'departemen.unique' =>'departemen '. $request->departemen.' sudah digunakan',
                'deskripsi.required' => 'deskripsi tidak boleh kosong',
                'deskripsi.unique' =>'deskripsi '. $request->deskripsi.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Departemen::create($request->all());
        return redirect()->route('departemen')->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilDepartemen($id)
    {
        $data = Departemen::find($id);
        // dd($id);
        $tittle = 'Departemen';
        $header = 'Update Data '.$tittle;
        return view('departemen.update-departemen', compact('data', 'tittle', 'header'));
    }

    public function updateDepartemen(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'departemen' => 'required|unique:departemens',
                'deskripsi' => 'required|unique:departemens',
            ],
            [
                'departemen.required' => 'departemen tidak boleh kosong',
                'departemen.unique' =>'departemen '. $request->departemen.' sudah digunakan',
                'deskripsi.required' => 'deskripsi tidak boleh kosong',
                'deskripsi.unique' =>'deskripsi '. $request->deskripsi.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = Departemen::find($id);
        $data->update($request->all());
        return redirect()->route('departemen')->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteDepartemen($id)
    {
        $data = Departemen::find($id);
        $data->delete();
        return redirect()->route('departemen')->with('success', 'Data Telah Berhasil Di Hapus');
    }
}
