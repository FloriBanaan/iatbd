<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Huisdier;
use Illuminate\Http\Request;

class ModeratieController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role_id !== 3) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        $sitters = User::where('role_id', 2)->with('profile')->get();
        $owners = User::where('role_id', 1)->with('profile')->get();
        $huisdieren = Huisdier::all();
        $oppassers = User::where('role_id', 2)
        ->with(['profile', 'ontvangenReviews.eigenaar'])
        ->get();

        return view('moderatie.index', compact('sitters', 'owners', 'huisdieren'));
    }
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if ($user->role_id === 3) {
            return redirect()->back()->with('error', 'Je kunt geen admin verwijderen.');
        }

        $user->delete();

        return redirect()->route('moderatie.index')->with('success', 'Gebruiker succesvol verwijderd.');
    }
    public function deleteHuisdier($id)
    {
        $huisdier = Huisdier::findOrFail($id);

        $huisdier->delete();

        return redirect()->route('moderatie.index')->with('success', 'Huisdier succesvol verwijderd.');
    }
}