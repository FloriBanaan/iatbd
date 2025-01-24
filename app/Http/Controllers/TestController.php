<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Toon het test dashboard voor eigenaren.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role_id !== 1) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        return view('test.dashboard');
    }
}