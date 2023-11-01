<?php

namespace App\Http\Controllers;

use App\Models\HakAkses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HakAksesController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        // $data = HakAkses::all();
        $kosong = '';

        if ($request->has('search')) {
            $data = HakAkses::where('hak_akses', 'LIKE', '%' . $request->search . '%')->paginate(5);
        } else {
            $data = HakAkses::paginate(5);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        
        $tittle = 'Hak Akses';
        $header = 'Data '.$tittle;
        return view('hak-akses.hak-akses', compact('data', 'tittle', 'header','kosong'));
    }

    public function tambahHakAkses()
    {
        $tittle = 'Hak Akses';
        $header = 'Tambah Data '.$tittle;
        return view('hak-akses.tambah-hak-akses', compact('tittle', 'header'));
    }

    public function insertHakAkses(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'level' => 'required|numeric|unique:hak_akses',
                'hak_akses' => 'required|',
            ],
            [
                'level.required' => 'level tidak boleh kosong',
                'level.numeric' => 'level mulai dari 1',
                'level.unique' => 'level '.$request->level.' sudah digunakan',
                'hak_akses.required' => 'hak akses tidak boleh kosong',
            ],
        );

        $validator->sometimes('level', 'min:1', function ($input) {
            return $input->level !== null && $input->level < 1;
        });

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        HakAkses::create($request->all());
        return redirect()
            ->route('hak-akses')
            ->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilHakAkses($id)
    {
        $data = HakAkses::find($id);
        // dd($id);
        $tittle = 'Hak Akses';
        $header = 'Update '.$tittle;
        return view('hak-akses.update-hak-akses', compact('data', 'tittle', 'header'));
    }

    public function updateHakAkses(Request $request, $id)
    {
        $data = HakAkses::find($id);
        $data->update($request->all());
        return redirect()
            ->route('hak-akses')
            ->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteHakAkses($id)
    {
        $data = HakAkses::find($id);
        $data->delete();
        return redirect()
            ->route('hak-akses')
            ->with('success', 'Data Telah Berhasil Di Hapus');
    }
}
