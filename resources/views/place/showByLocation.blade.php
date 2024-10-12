<!-- resources/views/place/showByLocation.blade.php -->
<title>Locations in {{ $location }}</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Spaces in ' . $location) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($listings->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-gray-500">
                    No listings found for {{ $location }}.
                </div>
            @else
                <div class="grid grid-cols-1 gap-4">
                    @foreach($listings as $listing)
                        <!-- Card wrapper that is now clickable -->
                        <a href="{{ route('place.detail', ['listingID' => $listing->listingID]) }}" class="block border border-gray-200 rounded-lg shadow-lg p-4 
                        bg-green-50 @if($loop->index % 3 == 0) bg-green-50 @elseif($loop->index % 3 == 1) bg-yellow-50 @else bg-yellow-100 @endif 
                        hover:bg-gray-100">
                            <div class="flex justify-between items-center">
                                <div class="flex flex-col">
                                    <h3 class="text-lg font-semibold text-blue-800 mb-1">{{ $listing->title }}</h3>
                                    <p class="text-gray-700 text-sm mb-1">{{ $listing->location }}</p>
                                    <p class="text-gray-700 text-sm mb-1">{{ $listing->description }}</p>
                                </div>
                                <div class="text-right pb-14">
                                    <p class="text-black-700"><strong>Owner:</strong> {{ $listing->spaceOwner->firstName }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-700 text-sm mb-1">{{ $listing->dateCreated->format('Y-m-d') }}</p>
                            </div>
                        </a> <!-- End of clickable card -->
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
