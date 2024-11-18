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
                                <th class="px-6 py-4 w-60">Date</th>
                                <th class="px-6 py-4 w-60 rounded-tr-2xl">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bhistory as $history)
                                <tr class="bg-orange-200">
                                    <!-- Display the listing title -->
                                    <td class="px-6 py-4 text-center border-b-2 border-orange-200">
                                        {{ $history->rentalAgreement->listing->title ?? 'N/A' }}
                                    </td>

                                    <!-- Display space owner's name -->
                                    <td class="px-6 py-4 text-center border-b-2 border-orange-200">
                                        {{ ucwords($history->spaceOwner->firstName ?? 'N/A') }} 
                                        {{ ucwords($history->spaceOwner->lastName ?? 'N/A') }}
                                    </td>

                                    <!-- Display rental term -->
                                    <td class="px-6 py-4 text-center border-b-2 border-orange-200">
                                        {{ ucwords($history->rentalAgreement->rentalTerm ?? 'N/A') }}
                                    </td>

                                    <!-- Display offer amount -->
                                    <td class="px-6 py-4 text-center border-b-2 border-orange-200">
                                        {{ number_format($history->amount, 2) }}
                                    </td>

                                    <!-- Display payment date -->
                                    <td class="px-6 py-4 text-center border-b-2 border-orange-200">
                                        {{ $history->date->format('Y-m-d') ?? 'N/A' }}
                                    </td>

                                    <!-- Book Again Button -->
                                    <td class="px-6 py-4 text-center">
                                        <a href="{{ route('place.detail', ['listingID' => $history->listing->listingID]) }}"
                                            class="py-1.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-red-500 rounded-lg border border-transparent hover:bg-red-700 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                            Book Again!
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center bg-orange-100">No booking history found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
