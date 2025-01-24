<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="mb-4">
            <a href="{{ route('huisdieren.sorteren', 'datum') }}" class="btn-sorting">Sorteer op datum</a>
            <a href="{{ route('huisdieren.sorteren', 'soort') }}" class="btn-sorting">Sorteer op soort dier</a>
            <a href="{{ route('huisdieren.sorteren', 'tarief') }}" class="btn-sorting">Sorteer op uurtarief</a>
        </div>
        <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
            @foreach ($huisdieren as $huisdier)
                <div class="p-6 flex space-x-2 huisdier">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 -scale-x-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    <div class="flex-1">
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-gray-800">{{ $huisdier->user->name }}</span>
                                <small class="ml-2 text-sm text-gray-600">{{ $huisdier->created_at->format('j M Y, g:i a') }}</small>
                            </div>
                        </div>
                        <p class="mt-4 text-lg text-gray-900">{{ $huisdier->message }}</p>
                        
                        <div class="mt-4">
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
                            <button class="openModalBtn">Vraag om op dit huisdier te passen</button>
                            <!-- Modal -->
                            <div class="modal" style="display: none;">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <h2>Vraag om op het huisdier te passen</h2>
                                    <form action="{{ route('berichten.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="huisdier_id" value="{{ $huisdier->id }}">
                                        <textarea class="message" name="bericht" placeholder="Schrijf je bericht..."></textarea>
                                        <button type="submit" class="sendMessageBtn">Verzend</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>