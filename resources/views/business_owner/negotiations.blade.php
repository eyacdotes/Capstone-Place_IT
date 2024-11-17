<title>My Negotiations</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Sent Negotiations') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="w-full max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    });
                </script>
                @endif
                <div class="overflow-hidden rounded-lg">
                    <h3 class="text-lg font-bold mb-4">Sent Negotiations</h3>
                    <div class="space-y-6">
                        @forelse($negotiations as $negotiation)
                        <div onclick="window.location='{{ route('business.negotiation.show', ['negotiationID' => $negotiation->negotiationID]) }}'"
                             class="cursor-pointer bg-orange-100 p-6 rounded-lg shadow-md hover:bg-orange-200 hover:shadow-lg hover:border-2 hover:border-orange-400 transition duration-200 ease-in-out">
                            <h4 class="text-lg font-semibold">{{ $negotiation->listing->title }}</h4>
                            <p class="text-gray-600 mt-2"><strong>Space Owner:</strong> {{ ucwords($negotiation->receiver->firstName) . ' ' . ucwords($negotiation->receiver->lastName) }}</p>
                            <p class="text-gray-600 mt-2"><strong>Offer Amount:</strong> {{ number_format($negotiation->offerAmount, 2) }}</p>
                            <p class="mt-4 font-bold
                                {{ $negotiation->negoStatus === 'Approved' ? 'text-green-600' : '' }}
                                {{ $negotiation->negoStatus === 'Pending' ? 'text-blue-600' : '' }}
                                {{ $negotiation->negoStatus === 'Disapproved' || $negotiation->negoStatus === 'Another Term' ? 'text-red-600' : '' }}">
                                {{ $negotiation->negoStatus }}
                            </p>
                        </div>
                        @empty
                        <div class="px-6 py-4 text-center bg-orange-100 rounded-lg">
                            You have not sent any negotiations.
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
