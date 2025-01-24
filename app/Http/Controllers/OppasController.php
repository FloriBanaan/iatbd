<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OppasController extends Controller
{
    public function index()
    {
        return view('oppas.dashboard');
    }
}
