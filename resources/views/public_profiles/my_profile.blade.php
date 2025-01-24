@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <h1 class="text-xl font-bold">Mijn profiel</h1>
            <p>Naam: {{ $user->name }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Beschrijving: {{ $user->profile->description ?? 'Geen beschrijving toegevoegd.' }}</p>
        </div>

        @php
            $mediaFiles = json_decode($user->profile->media, true) ?? [];
        @endphp
        @if(!empty($mediaFiles))
            <h2>Media</h2>
            <div class="grid grid-cols-2 gap-4">
                @foreach($mediaFiles as $media)
                    @if(Str::endsWith($media, ['jpg', 'png', 'jpeg']))
                        <img src="{{ asset('storage/' . $media) }}" alt="Media" class="w-full h-auto rounded">
                    @elseif(Str::endsWith($media, ['mp4']))
                        <video controls class="w-full h-auto rounded">
                            <source src="{{ asset('storage/' . $media) }}" type="video/mp4">
                            Je browser ondersteunt geen video.
                        </video>
                    @endif
                @endforeach
            </div>
        @else
            <p>Geen media toegevoegd.</p>
        @endif

        <form action="{{ route('sitters.updateProfilePut') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <textarea name="description" placeholder="Voeg een beschrijving toe">{{ old('description', $user->profile->description ?? '') }}</textarea>

        <input type="file" name="media[]" multiple>

        <button type="submit">Profiel bijwerken</button>
        </form>
    </div>
</div>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif
@endsection