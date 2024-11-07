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
                <div class="overflow-hidden rounded-lg">
                    <h3 class="text-lg font-bold mb-4">My Booking History</h3>
                    <table class="w-full border-seperate" style="border-spacing: 0;">
                        <thead>
                            <tr class="bg-orange-400 text-black">
                                <th class="px-6 py-4 w-60 rounded-tl-2xl">Space Title</th>
                                <th class="px-6 py-4 w-60">Owner</th>
                                <th class="px-6 py-4 w-60">Rental Term</th>
                                <th class="px-6 py-4 w-60">Amount</th>
                                <th class="px-6 py-4 w-60 rounded-tr-2xl">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bhistory as $history)
                            <tr class="bg-orange-200">
                                <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ $history->rentalAgreement->space->title ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ ucwords($history->rentalAgreement->owner->firstName).' '.ucwords($history->rentalAgreement->owner->lastName)?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ ucwords($history->rentalAgreement->rentalTerm) ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ number_format($history->rentalAgreement->offerAmount, 2) }}</td>
                                <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ $history->date }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center bg-orange-100">No booking history found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
