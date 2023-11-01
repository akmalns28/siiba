<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    public function index()
    {
        $data = User::all();
        return view('partials.navbar', compact('data'));
        $data = User::paginate(5);
    }
}
