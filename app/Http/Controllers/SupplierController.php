<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        // $data = satuan::all();
        if ($request->has('search')) {
            $data = Supplier::where('supplier', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = Supplier::paginate(5);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        $kosong = '';
        $tittle = 'Supplier';
        $header = 'Data '.$tittle;
        return view('supplier.supplier', compact('data', 'tittle', 'header','kosong'));
    }

    public function tambahSupplier()
    {
        $tittle = 'Supplier';
        $header = 'Tambah Data '.$tittle;
        return view('supplier.tambah-supplier', compact('tittle', 'header'));
    }

    public function insertSupplier(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make(
            $request->all(),
            [
                'nama_suplier' => 'required|unique:suppliers',
                'no_hp' => 'required|unique:suppliers',
                'alamat' => 'required|unique:suppliers',
            ],
            [
                'nama_suplier.required' => 'nama supplier tidak boleh kosong',
                'no_hp.required' => 'no hp tidak boleh kosong',
                'alamat.required' => 'alamat tidak boleh kosong',
                'nama_suplier.unique' =>'nama '. $request->nama.' sudah digunakan',
                'no_hp.unique' =>'no_hp '. $request->no_hp.' sudah digunakan',
                'alamat.unique' =>'alamat '. $request->alamat.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Supplier::create($request->all());
        return redirect()->route('supplier')->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilSupplier($id)
    {
        $data = Supplier::find($id);
        // dd($id);
        $tittle = 'Supplier';
        $header = 'Update Data '.$tittle;
        return view('supplier.update-supplier', compact('data', 'tittle', 'header'));
    }

    public function updateSupplier(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'nama_suplier' => 'required|unique:suppliers',
                'no_hp' => 'required|unique:suppliers',
                'alamat' => 'required|unique:suppliers',
            ],
            [
                'nama_suplier.required' => 'nama supplier tidak boleh kosong',
                'no_hp.required' => 'no hp tidak boleh kosong',
                'alamat.required' => 'alamat tidak boleh kosong',
                'nama_suplier.unique' =>'nama '. $request->nama.' sudah digunakan',
                'no_hp.unique' =>'no_hp '. $request->no_hp.' sudah digunakan',
                'alamat.unique' =>'alamat '. $request->alamat.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = Supplier::find($id);
        $data->update($request->all());
        return redirect()->route('supplier')->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteSupplier($id)
    {
        $data = Supplier::find($id);
        $data->delete();
        return redirect()->route('supplier')->with('success', 'Data Telah Berhasil Di Hapus');
    }
}
