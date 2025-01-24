<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Reviews voor oppassen
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-lg font-bold mb-4">Reviews voor oppassen</h1>

                    @if ($schrijftReviewVoor)
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <textarea name="review" rows="4" class="w-full border-gray-300 rounded-md" placeholder="Schrijf je review..."></textarea>
                            <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Verzend Review</button>
                        </form>
                    @else
                        <p>Er zijn op dit moment geen oppassen voor wie je een review kan schrijven.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>