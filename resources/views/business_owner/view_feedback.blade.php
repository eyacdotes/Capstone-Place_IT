<title>Feedback</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="overflow-hidden rounded-lg">
                        <h3 class="text-lg font-bold mb-4">Provide Feedbacks</h3>

                        <table class="w-full border-seperate" style="border-spacing: 0;">
                            <thead>
                                <tr class="bg-orange-400 text-black">
                                    <th class="px-6 py-4 w-44 rounded-tl-2xl">Space Name</th>
                                    <th class="px-4 py-2">Owner</th>
                                    <th class="px-4 py-2">Amount Paid</th>
                                    <th class="px-4 py-2">Rental Term</th>
                                    <th class="px-4 py-2">Date Start</th>
                                    <th class="px-4 py-2">Date End</th>
                                    <th class="px-6 py-4 w-44 rounded-tr-2xl">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rentalAgreements as $agreement)
                                    <tr class="text-center bg-orange-100 border-b-2 border-orange-200">
                                        <td class="px-4 py-2 ">{{ $agreement->listing->title }}</td>
                                        <td class="px-4 py-2 ">{{ ucwords($agreement->spaceOwner->firstName) }} {{ ucwords($agreement->spaceOwner->lastName) }}</td>
                                        <td class="px-4 py-2 ">{{ $agreement->offerAmount }}</td>
                                        <td class="px-4 py-2 ">{{ ucwords($agreement->rentalTerm) }}</td>
                                        <td class="px-4 py-2 ">{{ $agreement->dateStart }}</td>
                                        <td class="px-4 py-2 ">{{ $agreement->dateEnd }}</td>
                                        <td class="px-4 py-2 w-60 ">
                                            @if (isset($feedbacks[$agreement->rentalAgreementID]))
                                                <span colspan="7" class="py-1.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900">Done feedback idiot.</span>
                                            @else
                                                <a href="{{ route('business.action', ['rentalAgreementID' => $agreement->rentalAgreementID]) }}" class="py-1.5 px-5 me-2 mb-2 text-sm font-medium text-white focus:outline-none bg-red-500 rounded-lg border border-transparent hover:bg-red-700 hover:text-white focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                    Give Feedback
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">No rental agreements found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>