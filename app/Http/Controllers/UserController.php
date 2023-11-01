<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\HakAkses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $data = User::where('name', 'LIKE', '%' . $request->search . '%')
                ->with('hak_akses')
                ->paginate(5);
        } else {
            $data = User::paginate(5);
            if ($data->isEmpty()) {
                $kosong = 'Data tidak tersedia';
            }
        }
        $kosong = '';
        $tittle = 'User';
        $header = 'Data User';
        return view('user.user', compact('data', 'tittle', 'header', 'kosong'));
    }

    public function showUser(Request $request)
    {
        $user = User::all();
        if ($request->keyword != '') {
            $user = User::where('name', 'LIKE', '%' . $request->keyword . '%')
                ->with('hak_akses')
                ->paginate(5);
        }
        return response()->json([
            'user' => $user,
        ]);
    }

    public function tambahUser()
    {
        $tittle = 'User';
        $header = 'Tambah Data User';
        $hak_akses = HakAkses::all();
        return view('user.tambah-user', compact('tittle', 'header', 'hak_akses'));
    }

    public function insertUser(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|',
                'username' => 'required|unique:users',
                'password' => 'required|min:8|',
                'hak_akses_id' => 'required',
            ],
            [
                'name.required' => 'nama tidak boleh kosong',
                'username.required' => 'username tidak boleh kosong',
                'password.required' => 'password tidak boleh kosong',
                'hak_akses_id.required' => 'hak akses tidak boleh kosong',
                'username.unique' => 'username ' . $request->username . ' sudah digunakan',
                'password.min' => 'password harus lebih dari 8 karakter',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'hak_akses_id' => $request->hak_akses_id,
        ]);

        return redirect()
            ->route('user')
            ->with('success', 'Data Telah Berhasil Di Tambahkan');
    }

    public function tampilUser($id)
    {
        $hak_akses = HakAkses::all();
        $data = User::find($id);
        // dd($id);
        $tittle = 'user';
        $header = 'Update Data user';
        return view('user.update-user', compact('data', 'tittle', 'header', 'hak_akses'));
    }

    public function updateUser(Request $request, $id)
    {
        $data = User::find($id);
        $data->update($request->all());
        return redirect()
            ->route('user')
            ->with('success', 'Data Telah Berhasil Di Ubah');
    }

    public function deleteUser($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()
            ->route('user')
            ->with('success', 'Data Telah Berhasil Di Hapus');
    }
}
