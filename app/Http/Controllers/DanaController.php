<?php

namespace App\Http\Controllers;

use App\Models\Dana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DanaController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        // $data = dana::all();

        $kosong = '';

        if ($request->has('search')) {
            $data = Dana::where('dana', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = Dana::paginate(5);

            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        $tittle = 'Dana';
        $header = 'Data '. $tittle;
        return view('dana.dana', compact('data', 'tittle', 'header','kosong'));
    }

    public function tambahDana()
    {
        $tittle = 'Dana';
        $header = 'Tambah Data '.$tittle;
        return view('dana.tambah-dana', compact('tittle', 'header'));
    }

    public function insertDana(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'dana' => 'required|unique:danas',
            ],
            [
                'dana.required' => 'dana tidak boleh kosong',
                'dana.unique' =>'dana '. $request->dana.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        Dana::create($request->all());
        return redirect()->route('dana')->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilDana($id)
    {
        $data = Dana::find($id);
        // dd($id);
        $tittle = 'Dana';
        $header = 'Update Data '.$tittle;
        return view('dana.update-dana', compact('data', 'tittle', 'header'));
    }

    public function updateDana(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'dana' => 'required|unique:danas',
            ],
            [
                'dana.required' => 'dana tidak boleh kosong',
                'dana.unique' =>'dana '. $request->dana.' sudah digunakan',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = Dana::find($id);
        $data->update($request->all());
        return redirect()->route('dana')->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteDana($id)
    {
        $data = Dana::find($id);
        $data->delete();
        return redirect()->route('dana')->with('success', 'Data Telah Berhasil Di Hapus');
    }
}
