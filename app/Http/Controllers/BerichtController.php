<?php

namespace App\Http\Controllers;

use App\Models\Bericht;
use App\Models\Huisdier;
use App\Models\AcceptedHuisdier;
use Illuminate\Http\Request;

class BerichtController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'huisdier_id' => 'required|exists:huisdieren,id',
            'bericht' => 'required|string',
        ]);

        $bericht = new Bericht();
        $bericht->huisdier_id = $validated['huisdier_id'];
        $bericht->user_id = auth()->id(); 
        $bericht->bericht = $validated['bericht'];
        $bericht->save();

        return redirect()->back()->with('success', 'Bericht succesvol opgeslagen!');
    }

    public function accept(Request $request)
    {
        $huisdier = Huisdier::findOrFail($request->huisdier_id);

        if (auth()->id() !== $huisdier->user_id) {
            abort(403, 'Je hebt geen toestemming om dit te doen.');
        }

        $bericht = $huisdier->berichten()->where('id', $request->bericht_id)->first();

        if ($bericht) {
            $huisdier->user->schrijft_review_voor = $bericht->user_id;

            $huisdier->user->save();

            $huisdier->delete();

            $bericht->delete();

            return redirect()->back()->with('success', 'Huisdier en berichten verwijderd. Oppas is succesvol gekoppeld.');
        }

        return redirect()->back()->with('error', 'Bericht niet gevonden.');
    }

    public function reject(Request $request)
    {
        $validated = $request->validate([
            'bericht_id' => 'required|exists:berichten,id', 
        ]);

        $bericht = Bericht::find($validated['bericht_id']);

        if ($bericht) {
            $bericht->delete();
            return redirect()->back()->with('success', 'Bericht verwijderd.');
        }

        return redirect()->back()->with('error', 'Bericht niet gevonden.');
    }
    
}