<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $tittle = '';
    private $header = '';
    public function index()
    {
        $tittle = 'Home';
        $header = 'Home';
        return view('home', compact('tittle', 'header'));
    }
}
