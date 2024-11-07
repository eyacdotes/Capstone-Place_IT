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
                        <h3 class="text-lg font-bold mb-4">Rental Agreements</h3>

                        <table class="w-full border-seperate" style="border-spacing: 0;">
                            <thead>
                                <tr class="bg-orange-400 text-black">
                                    <th class="px-6 py-4 w-44 rounded-tl-2xl">Space Name</th>
                                    <th class="px-4 py-2">Owner</th>
                                    <th class="px-4 py-2">Amount Paid</th>
                                    <th class="px-4 py-2">Rental Term</th>
                                    <th class="px-4 py-2">Date Start</th>
                                    <th class="px-4 py-2">Date End</th>
                                    <th class="px-4 py-2">Status</th>
                                    <th class="px-6 py-4 w-44 rounded-tr-2xl">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rentalAgreements as $agreement)
                                    <tr class="bg-orange-100">
                                        <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ $agreement->listing->title }}</td>
                                        <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ ucwords($agreement->owner->firstName) }} {{ ucwords($agreement->owner->lastName) }}</td>
                                        <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ $agreement->offerAmount }}</td>
                                        <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ ucwords($agreement->rentalTerm) }}</td>
                                        <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ $agreement->dateStart }}</td>
                                        <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ $agreement->dateEnd }}</td>
                                        <td class="px-6 py-4 text-center border-b-2 border-orange-200">{{ $agreement->status }}</td>
                                        <td class="px-6 py-4 text-center border-b-2 border-orange-200">
                                            <a href="{{ route('business.action', ['rentalAgreementID' => $agreement->rentalAgreementID]) }}" class="text-blue-500">
                                                Give Feedback
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-2 text-center bg-orange-200">No rental agreements found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if(isset($selectedAgreement))
                        <h3 class="text-lg font-bold mt-6 mb-4">Submit Feedback for Rental Agreement ID: {{ $selectedAgreement->rentalAgreementID }}</h3>

                        @if($errors->has('feedback'))
                            <div class="bg-red-200 text-red-600 p-4 rounded mb-4">
                                {{ $errors->first('feedback') }}
                            </div>
                        @endif

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
