@extends('layouts.app')

@section('content')
    <h1>Profiel van {{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <p>Beschrijving: {{ $user->profile->description ?? 'Geen beschrijving toegevoegd.' }}</p>

    @if(!empty($user->profile->media) && is_array($user->profile->media))
        <h2>Foto's en video's</h2>
        <div class="media-gallery">
            @foreach($user->profile->media as $media)
                @if(Str::endsWith($media, ['jpg', 'png', 'jpeg']))
                    <img src="{{ asset('storage/' . $media) }}" alt="Media" style="max-width: 200px; margin: 10px;">
                @elseif(Str::endsWith($media, ['mp4']))
                    <video controls style="max-width: 300px; margin: 10px;">
                        <source src="{{ asset('storage/' . $media) }}" type="video/mp4">
                        Je browser ondersteunt geen video.
                    </video>
                @endif
            @endforeach
        </div>
    @else
        <p>Geen media toegevoegd.</p>
    @endif
    <h2>Reviews</h2>
    @if($user->ontvangenReviews->isEmpty())
        <p>Geen reviews beschikbaar.</p>
    @else
        @foreach($user->ontvangenReviews as $review)
            <div class="review">
                <p>{{ $review->review }}</p>
                <small>Geschreven door: {{ $review->eigenaar->name }}</small>
            </div>
        @endforeach
    @endif
@endsection