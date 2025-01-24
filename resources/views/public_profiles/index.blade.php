@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-semibold text-gray-900 mb-6">Oppassers</h1>
        <ul class="space-y-4">
            @foreach ($sitters as $sitter)
                <li class="border-b pb-4">
                    <a href="{{ route('sitters.show', $sitter->id) }}" class="text-blue-600 hover:text-blue-800">
                        {{ $sitter->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection