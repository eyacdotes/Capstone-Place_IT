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
            @if(session('success'))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: '{{ session('success') }}',
                            timer: 3000, // The alert will auto-close after 5 seconds
                            showConfirmButton: false
                        });
                    });
                </script>
            @endif
               <div class="overflow-hidden rounded-lg">
                    <h3 class="text-lg font-bold mb-4">Sent Negotiations</h3>
                    <table class="w-full border-seperate" style="border-spacing: 0;">
                        <thead>
                            <tr class="bg-orange-400 text-black">
                                <th class="px-6 py-4 w-60 rounded-tl-2xl">Space Title</th>
                                <th class="px-6 py-4 w-60">Space Owner</th>
                                <th class="px-6 py-4 w-60">Offer Amount</th>
                                <th class="px-6 py-4 w-60 rounded-tr-2xl">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($negotiations as $negotiation)
                            <tr class="cursor-pointer bg-orange-100 hover:bg-orange-200 hover:shadow-lg hover:border-2 hover:border-orange-400 transition duration-200 ease-in-out"
                                style="border: 1px solid transparent;" 
                                onclick="window.location='{{ route('business.negotiation.show', ['negotiationID' => $negotiation->negotiationID]) }}'">
                                <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ $negotiation->listing->title }}</td>
                                <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ ucwords($negotiation->receiver->firstName) . ' ' . ucwords($negotiation->receiver->lastName) }}</td>
                                <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ number_format($negotiation->offerAmount, 2) }}</td>
                                <td class="px-6 py-4 text-center border-b-2 border-orange-200">
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
                                <td colspan="5" class="px-6 py-4 text-center bg-orange-100">You have not sent any negotiations.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
