<?php

namespace App\Http\Controllers;

use App\Models\Bericht;
use App\Models\Huisdier;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class HuisdierController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request, $type = null)
    {
        if (auth()->user()->role_id !== 2) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        $huisdierenQuery = Huisdier::with('user');

        if ($type === 'datum') {
            $huisdierenQuery->orderBy('created_at', 'desc');
        } elseif ($type === 'soort') {
            $huisdierenQuery->orderBy('soort_dier', 'asc');
        } elseif ($type === 'tarief') {
            $huisdierenQuery->orderBy('uurtarief', 'asc');
        } else {
            $huisdierenQuery->latest();
        }

        $huisdieren = $huisdierenQuery->get();

        return view('huisdieren.index', compact('huisdieren'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->role_id !== 1) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        return view('huisdieren.create');
    }

    public function store(Request $request)
    {
        if (auth()->user()->role_id !== 1) {
            abort(403, 'Je hebt geen toegang tot deze actie.');
        }

        $validated = $request->validate([
            'naam_dier' => 'required|string|max:255',
            'soort_dier' => 'required|string|max:255',
            'begindatum_oppassen' => 'required|date',
            'einddatum_oppassen' => 'required|date|after_or_equal:begindatum_oppassen',
            'uurtarief' => 'required|numeric|min:0',
            'belangrijke_zaken' => 'nullable|string',
            'foto_huisdier' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['user_id'] = auth()->user()->id;

        if ($request->hasFile('foto_huisdier')) {
            $path = $request->file('foto_huisdier')->store('foto_huisdieren', 'public');
            $validated['foto_huisdier'] = str_replace('public/', '', $path);
        }

        Huisdier::create($validated);

        return back()->with('success', 'Oproep succesvol geplaatst!');
    }

    public function mijnHuisdieren()
    {
        $user = auth()->user();

        if ($user->role_id !== 1) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        $huisdieren = Huisdier::where('user_id', $user->id)->latest()->get();

        return view('huisdieren.mijn', compact('huisdieren'));
    }

    public function storeBericht(Request $request, Huisdier $huisdier)
    {
        $request->validate([
            'bericht' => 'required|string|max:1000',
        ]);

        Bericht::create([
            'huisdier_id' => $huisdier->id,
            'user_id' => auth()->id(),
            'bericht' => $request->bericht,
        ]);

        return back()->with('success', 'Je bericht is succesvol verzonden.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Huisdier $huisdier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Huisdier $huisdier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Huisdier $huisdier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Huisdier $huisdier)
    {
        //
    }
}
