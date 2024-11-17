<!-- resources/views/space_owner/negotiations.blade.php -->
<title>Negotiations</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Negotiations') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="w-full max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h3 class="text-2xl font-extrabold mb-6">Active Negotiations</h3>

                    <div class="grid grid-cols-1 gap-6">
                        @forelse($negotiations as $negotiation)
                        <a href="{{ route('space.negotiation.show', ['negotiationID' => $negotiation->negotiationID]) }}" class="block bg-gray-100 p-8 rounded-lg shadow-lg hover:bg-gray-200 transition duration-200">
                            <h4 class="text-3xl font-extrabold text-orange-600 mb-4">{{ $negotiation->listing->title }}</h4>
                            <p class="text-1xl text-gray-700 mb-4"><strong>Business Owner:</strong> {{ ucwords($negotiation->sender->firstName) . ' ' . ucwords($negotiation->sender->lastName) }}</p>
                            <p class="text-gray-700 mb-4"><strong>Offer:</strong> {{ number_format($negotiation->offerAmount, 2) }}</p>
                        </a>
                        @empty
                        <div class="text-center w-full">
                            <p class="text-gray-700">No active negotiations found.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
