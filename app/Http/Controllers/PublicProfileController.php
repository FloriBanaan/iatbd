<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PublicProfileController extends Controller
{
    /**
     * Toon het openbare profiel van een specifieke oppas.
     */
    public function show($id)
    {
        $user = User::where('id', $id)->where('role_id', 2)->with('profile', 'ontvangenReviews.eigenaar')->first();

        if (!$user) {
            abort(404, 'Oppas niet gevonden.');
        }

        return view('public_profiles.show', compact('user'));
    }
    /**
     * Toon een lijst van alle oppassers.
     */
    public function index()
    {
        $user = auth()->user();

        if ($user->role_id !== 1) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        $sitters = User::where('role_id', 2)->get();

        return view('public_profiles.index', compact('sitters'));
    }

    /**
     * Toon het profiel van de ingelogde oppas.
     */
    public function myProfile()
    {
        $user = auth()->user();

        if ($user->role_id !== 2) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        return view('public_profiles.my_profile', compact('user'));
    }
    public function updateMyProfile(Request $request)
    {
        $user = auth()->user();

        if ($user->role_id !== 2) {
            abort(403, 'Je hebt geen toegang tot deze pagina.');
        }

        $validated = $request->validate([
            'description' => 'nullable|string',
            'media.*' => 'nullable|file|mimes:jpg,png,mp4|max:2048',
        ]);

        $profile = $user->profile;

        if (!$profile) {
            $profile = $user->profile()->create();
        }

        $profile->update([
            'description' => $validated['description'],
        ]);

        if ($request->hasFile('media')) {
            $mediaPaths = [];
            foreach ($request->file('media') as $file) {
                $mediaPaths[] = $file->store('media', 'public');
            }
            $profile->media = json_encode($mediaPaths);
        }

        $profile->save();

        return redirect()->route('sitters.myProfile')->with('success', 'Profiel bijgewerkt.');
    }
}