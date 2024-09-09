<!-- resources/views/business_owner/bookinghistory.blade.php -->
<title>Booking History</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Booking History') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="max-w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h3 class="text-lg font-bold mb-4">My Booking History</h3>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-blue-400 text-white">
                                <th class="px-6 py-4">Space Title</th>
                                <th class="px-6 py-4">Owner</th>
                                <th class="px-6 py-4">Rental Term</th>
                                <th class="px-6 py-4">Amount</th>
                                <th class="px-6 py-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bhistory as $history)
                            <tr class="hover:bg-opacity-75">
                                <td class="px-6 py-4 bg-gray-100">{{ $history->rentalAgreement->space->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 bg-gray-100">{{ $history->rentalAgreement->owner->firstName ?? 'N/A' }}</td>
                                <td class="px-6 py-4 bg-gray-100">{{ $history->rentalAgreement->rentalTerm ?? 'N/A' }}</td>
                                <td class="px-6 py-4 bg-gray-100">{{ number_format($history->rentalAgreement->offerAmount, 2) }}</td>
                                <td class="px-6 py-4 bg-gray-100">{{ $history->date }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center bg-gray-100">No booking history found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
