<title>My Negotiations</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Sent Negotiations') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="max-w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h3 class="text-lg font-bold mb-4">Sent Negotiations</h3>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-orange-400 text-white">
                                <th class="px-6 py-4">Space Title</th>
                                <th class="px-6 py-4">Space Owner</th>
                                <th class="px-6 py-4">Offer Amount</th>
                                <th class="px-6 py-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($negotiations as $negotiation)
                            <tr class="hover:bg-opacity-75 hover:border-orange-400 hover:shadow-lg cursor-pointer transition duration-200 ease-in-out"
                                style="border: 1px solid transparent;" 
                                onclick="window.location='{{ route('negotiation.show', ['negotiationID' => $negotiation->negotiationID]) }}'">
                                <td class="px-6 py-4 bg-gray-100">{{ $negotiation->listing->title }}</td>
                                <td class="px-6 py-4 bg-gray-100">{{ $negotiation->receiver->firstName . ' ' . $negotiation->receiver->lastName }}</td>
                                <td class="px-6 py-4 bg-gray-100">{{ number_format($negotiation->offerAmount, 2) }}</td>
                                <td class="px-6 py-4 bg-gray-100">
                                <span class="
                                                    {{ $negotiation->negoStatus === 'Approved' ? 'text-green-600' : '' }}
                                                    {{ $negotiation->negoStatus === 'Pending' ? 'text-blue-600' : '' }}
                                                    {{ $negotiation->negoStatus === 'Disapproved' || $negotiation->negoStatus === 'Another Term' ? 'text-red-600' : '' }}
                                                    font-bold">
                                                    {{ $negotiation->negoStatus }}
                                                </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center bg-gray-100">You have not sent any negotiations.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
