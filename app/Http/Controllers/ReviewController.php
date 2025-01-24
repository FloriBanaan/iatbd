<?php

namespace App\Http\Controllers;

use App\Models\Huisdier;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $schrijftReviewVoor = auth()->user()->schrijft_review_voor;

        return view('reviews.index', compact('schrijftReviewVoor'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'review' => 'required|string|max:1000',
        ]);

        $oppasId = auth()->user()->schrijft_review_voor;

        if (!$oppasId) {
            return redirect()->route('reviews.index')->with('error', 'Er is geen oppas geselecteerd voor een review.');
        }

        $oppas = User::findOrFail($oppasId);

        Review::create([
            'review' => $validated['review'],
            'eigenaar_id' => auth()->id(),
            'oppas_id' => $oppas->id, 
        ]);

        auth()->user()->schrijft_review_voor = null;
        auth()->user()->save();

        return redirect()->route('reviews.index')->with('success', 'Review succesvol toegevoegd.');
    }
}