<title>My Sent Negotiations</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Sent Negotiations') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="w-full max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-8 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h3 class="text-2xl font-extrabold mb-6">Sent Negotiations</h3>

                    <div class="grid grid-cols-1 gap-6">
                        @forelse($negotiations as $negotiation)
                        <a href="{{ route('business.negotiation.show', ['negotiationID' => $negotiation->negotiationID]) }}" 
                           class="block bg-gray-100 p-8 rounded-lg shadow-lg hover:bg-gray-200 transition duration-200">
                            <h4 class="text-3xl font-extrabold text-orange-600 mb-4">{{ $negotiation->listing->title }}</h4>
                            <p class="text-1xl text-gray-700 mb-4">
                                <strong>Space Owner:</strong> {{ ucwords($negotiation->receiver->firstName) . ' ' . ucwords($negotiation->receiver->lastName) }}
                            </p>
                            <p class="text-gray-700 mb-4">
                                <strong>Offer:</strong> {{ number_format($negotiation->offerAmount, 2) }}
                            </p>
                            <p class="text-gray-700">
                                <strong>Status:</strong>
                                <span class="
                                    {{ $negotiation->negoStatus === 'Approved' ? 'text-green-600' : '' }}
                                    {{ $negotiation->negoStatus === 'Pending' ? 'text-blue-600' : '' }}
                                    {{ $negotiation->negoStatus === 'Disapproved' || $negotiation->negoStatus === 'Another Term' ? 'text-red-600' : '' }}
                                ">
                                    {{ $negotiation->negoStatus }}
                                </span>
                            </p>
                        </a>
                        @empty
                        <div class="text-center w-full">
                            <p class="text-gray-700">No sent negotiations found.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
