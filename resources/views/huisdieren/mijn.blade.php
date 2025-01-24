<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mijn Huisdieren
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-lg font-bold mb-4">Overzicht van mijn huisdieren</h1>
                    <div class="mt-6 divide-y">
                        @forelse ($huisdieren as $huisdier)
                            <div class="py-4">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <strong class="text-gray-800">{{ $huisdier->naam_dier }}</strong>
                                        <small class="ml-2 text-sm text-gray-600">
                                            Toegevoegd op {{ $huisdier->created_at->format('j M Y, g:i a') }}
                                        </small>
                                    </div>
                                </div>
                                <p class="mt-2 text-gray-700">
                                    <strong>Soort dier:</strong> {{ $huisdier->soort_dier }}
                                </p>
                                <p class="text-gray-700">
                                    <strong>Begindatum oppassen:</strong> {{ $huisdier->begindatum_oppassen }}
                                </p>
                                <p class="text-gray-700">
                                    <strong>Einddatum oppassen:</strong> {{ $huisdier->einddatum_oppassen }}
                                </p>
                                <p class="text-gray-700">
                                    <strong>Uurtarief:</strong> €{{ number_format($huisdier->uurtarief, 2) }}
                                </p>
                                <p class="text-gray-700">
                                    <strong>Belangrijke zaken:</strong> {{ $huisdier->belangrijke_zaken }}
                                </p>
                                @if ($huisdier->foto_huisdier)
                                    <div class="mt-4">
                                        <strong>Foto van het huisdier:</strong><br>
                                        <img src="{{ asset('storage/' . $huisdier->foto_huisdier) }}" alt="Foto van {{ $huisdier->naam_dier }}" class="w-32 h-32 object-cover">
                                    </div>
                                @endif
                                <h4>Berichten:</h4>
                                @forelse ($huisdier->berichten as $bericht)
                                    <div class="bericht mt-4">
                                        <p><strong>{{ $bericht->user->name }}:</strong> {{ $bericht->bericht }}</p>
                                        <form action="{{ route('berichten.accept') }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="huisdier_id" value="{{ $huisdier->id }}">
                                            <input type="hidden" name="bericht_id" value="{{ $bericht->id }}">
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Accepteren</button>
                                        </form>
                                        <form action="{{ route('berichten.reject') }}" method="POST" style="display: inline;">
                                            @csrf
                                            <input type="hidden" name="bericht_id" value="{{ $bericht->id }}">
                                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">Weigeren</button>
                                        </form>
                                    </div>
                                @empty
                                    <p>Er zijn nog geen berichten voor dit huisdier.</p>
                                @endforelse
                            </div>
                        @empty
                            <p class="text-gray-600">Je hebt nog geen huisdieren toegevoegd.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>