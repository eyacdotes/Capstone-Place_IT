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

                    <h3 class="text-lg font-bold mb-4">Rental Agreements</h3>

                    <table class="table-auto w-full text-left">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Space Name</th>
                                <th class="px-4 py-2">Owner</th>
                                <th class="px-4 py-2">Amount Paid</th>
                                <th class="px-4 py-2">Rental Term</th>
                                <th class="px-4 py-2">Date Start</th>
                                <th class="px-4 py-2">Date End</th>
                                <th class="px-4 py-2">Status</th>
                                <th class="px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rentalAgreements as $agreement)
                                <tr>
                                    <td class="border px-4 py-2">{{ $agreement->listing->title }}</td>
                                    <td class="border px-4 py-2">{{ $agreement->owner->firstName }}</td>
                                    <td class="border px-4 py-2">{{ $agreement->offerAmount }}</td>
                                    <td class="border px-4 py-2">{{ $agreement->rentalTerm }}</td>
                                    <td class="border px-4 py-2">{{ $agreement->dateStart }}</td>
                                    <td class="border px-4 py-2">{{ $agreement->dateEnd }}</td>
                                    <td class="border px-4 py-2">{{ $agreement->status }}</td>
                                    <td class="border px-4 py-2">
                                        <a href="{{ route('business.action', ['rentalAgreementID' => $agreement->rentalAgreementID]) }}" class="text-blue-500">
                                            Give Feedback
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="border px-4 py-2 text-center">No rental agreements found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if(isset($selectedAgreement))
                        <h3 class="text-lg font-bold mt-6 mb-4">Submit Feedback for Rental Agreement ID: {{ $selectedAgreement->rentalAgreementID }}</h3>

                        <form action="{{ route('business.submit') }}" method="POST">
                            @csrf
                            <input type="hidden" name="rentalAgreementID" value="{{ $selectedAgreement->rentalAgreementID }}">
                            <input type="hidden" name="renterID" value="{{ $selectedAgreement->renterID }}">

                            <div class="mb-4">
                                <label for="rate" class="block text-gray-700">Rate (1-5):</label>
                                <input type="number" id="rate" name="rate" min="1" max="5" class="form-input mt-1 block w-full" required>
                                @error('rate')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="comment" class="block text-gray-700">Comment:</label>
                                <textarea id="comment" name="comment" class="form-textarea mt-1 block w-full"></textarea>
                                @error('comment')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit Feedback</button>
                        </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
