@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Moderatie Dashboard</h1>
        <p class="mb-6">Welkom, admin! Hier kun je moderatie uitvoeren.</p>

        <h2 class="text-xl font-semibold text-gray-900 mb-4">Oppasprofielen</h2>
        @if($sitters->isEmpty())
            <p>Er zijn geen oppasprofielen beschikbaar.</p>
        @else
            @foreach($sitters as $user)
                <div class="bg-white shadow-md rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                    <p>Email: {{ $user->email }}</p>
                    <p>Beschrijving: {{ $user->profile->description ?? 'Geen beschrijving toegevoegd.' }}</p>

                    @if(!empty($user->profile->media) && is_array($user->profile->media))
                        <h4 class="text-md font-semibold mt-4">Foto's en video's</h4>
                        <div class="grid grid-cols-2 gap-4 mt-2">
                            @foreach($user->profile->media as $media)
                                @if(Str::endsWith($media, ['jpg', 'png', 'jpeg']))
                                    <img src="{{ asset('storage/' . $media) }}" alt="Media" class="max-w-xs mx-auto">
                                @elseif(Str::endsWith($media, ['mp4']))
                                    <video controls class="max-w-xs mx-auto">
                                        <source src="{{ asset('storage/' . $media) }}" type="video/mp4">
                                        Je browser ondersteunt geen video.
                                    </video>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p>Geen media toegevoegd.</p>
                    @endif

                    <h4 class="text-md font-semibold mt-4">Reviews</h4>
                    @if($user->ontvangenReviews->isEmpty())
                        <p>Geen reviews beschikbaar.</p>
                    @else
                        @foreach($user->ontvangenReviews as $review)
                            <div class="border-t pt-2 mt-2">
                                <p>{{ $review->review }}</p>
                                <small>Geschreven door: {{ $review->eigenaar->name }}</small>
                            </div>
                        @endforeach
                    @endif

                    <form action="{{ route('moderatie.deleteUser', $user->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Weet je zeker dat je deze oppas wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">Verwijder Oppas</button>
                    </form>
                </div>
            @endforeach
        @endif

        <h2 class="text-xl font-semibold text-gray-900 mb-4">Eigenaar Profielen</h2>
        @if($owners->isEmpty())
            <p>Er zijn geen eigenaar profielen beschikbaar.</p>
        @else
            <ul class="space-y-4">
                @foreach($owners as $owner)
                    <li class="bg-white shadow-md rounded-lg p-4">
                        <strong>{{ $owner->name }}</strong> ({{ $owner->email }})
                        <form action="{{ route('moderatie.deleteUser', $owner->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze eigenaar wilt verwijderen?');" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">Verwijder Eigenaar</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <h2 class="text-xl font-semibold text-gray-900 mb-4">Huisdieren</h2>
        @if($huisdieren->isEmpty())
            <p>Er zijn geen huisdieren beschikbaar.</p>
        @else
            <ul class="space-y-4">
                @foreach($huisdieren as $huisdier)
                    <li class="bg-white shadow-md rounded-lg p-4">
                        <strong>Naam dier:</strong> {{ $huisdier->naam_dier }}<br>
                        <strong>Soort dier:</strong> {{ $huisdier->soort_dier }}<br>
                        <strong>Begindatum oppassen:</strong> {{ $huisdier->begindatum_oppassen }}<br>
                        <strong>Einddatum oppassen:</strong> {{ $huisdier->einddatum_oppassen }}<br>
                        <strong>Uurtarief:</strong> €{{ number_format($huisdier->uurtarief, 2) }}<br>
                        <strong>Belangrijke zaken:</strong> {{ $huisdier->belangrijke_zaken }}<br>

                        @if ($huisdier->foto_huisdier)
                            <div class="mt-4">
                                <strong>Foto van het huisdier:</strong><br>
                                <img src="{{ asset('storage/' . $huisdier->foto_huisdier) }}" alt="Foto van {{ $huisdier->naam_dier }}" class="w-32 h-32 object-cover">
                            </div>
                        @endif

                        <form action="{{ route('moderatie.deleteHuisdier', $huisdier->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit huisdier wilt verwijderen?');" class="mt-4">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700">Verwijder Huisdier</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection