@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-xl font-bold">Huisdier aanmaken</h1>

            <form action="{{ route('huisdieren.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="naam_dier">Naam dier:</label>
                    <input type="text" id="naam_dier" name="naam_dier" required>
                </div>

                <div>
                    <label for="soort_dier">Soort dier:</label>
                    <input type="text" id="soort_dier" name="soort_dier" required>
                </div>

                <div>
                    <label for="begindatum_oppassen">Begindatum oppassen:</label>
                    <input type="date" id="begindatum_oppassen" name="begindatum_oppassen" required>
                </div>

                <div>
                    <label for="einddatum_oppassen">Einddatum oppassen:</label>
                    <input type="date" id="einddatum_oppassen" name="einddatum_oppassen" required>
                </div>

                <div>
                    <label for="uurtarief">Uurtarief (€):</label>
                    <input type="number" id="uurtarief" name="uurtarief" step="0.01" required>
                </div>

                <div>
                    <label for="belangrijke_zaken">Belangrijke zaken:</label>
                    <textarea id="belangrijke_zaken" name="belangrijke_zaken"></textarea>
                </div>

                <div>
                    <label for="foto_huisdier">Foto van het huisdier:</label>
                    <input type="file" id="foto_huisdier" name="foto_huisdier" accept="image/*">
                </div>

                <button type="submit">Huisdier toevoegen</button>
            </form>
        </div>
    </div>
</div>
@endsection