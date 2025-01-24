<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EigenaarController extends Controller
{
    public function index()
    {
        return view('eigenaar.dashboard');
    }
}
