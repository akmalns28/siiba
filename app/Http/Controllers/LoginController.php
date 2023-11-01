<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    private $tittle = '';
    public function index()
    {
        $tittle = 'Login SIIBA';
        if ($user = Auth::user()) {
            if ($user->hak_akses_id == '1') {
                return redirect()->intended('home');
            } elseif ($user->hak_akses_id == '2') {
                return redirect()->intended('home');
            }elseif ($user->hak_akses_id == '3') {
                return redirect()->intended('home');
            }
        }

        return view('layout.login',compact('tittle'));
        
    }

    public function proses(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'password' => 'required|',
                
            ],
            [
                'username.required' => 'username tidak boleh kosong',
                'password.required' => 'password tidak boleh kosong',
                'password.min' => 'password harus lebih dari 8 karakter',
            ],
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kredensial = $request->only('username', 'password');

        if (Auth::attempt($kredensial)) {

            $request->session()->regenerate();
            $user = Auth::user();
            if ($user = Auth::user()) {
                if ($user->hak_akses_id == '1') {
                    return redirect()->intended('home');
                } elseif ($user->hak_akses_id == '2') {
                    return redirect()->intended('home');
                } elseif ($user->hak_akses_id == '3') {
                    return redirect()->intended('home');
                }
            }

            return redirect()->intended('/login');
        }

        return back()->witherrors([
            'username' => 'Maaf username/password anda salah'
        ])->onlyInput('username');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
