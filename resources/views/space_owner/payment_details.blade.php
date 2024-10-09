<title>Payment Details</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Details') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-4xl">
            <div class="p-6">
                <!-- Loop through each group of negotiations by business owner -->
                @foreach($negotiationsByOwner as $ownerID => $negotiations)
                    <!-- Fetch the business owner details (sender) from the first negotiation -->
                    @php
                        $businessOwner = $negotiations->first()->sender;
                        $listing = $negotiations->first()->listing;
                    @endphp

                    <!-- Business Owner Details Section -->
                    <h3 class="text-2xl font-bold mb-4">Business Owner Information</h3>
                    <table class="min-w-full divide-y divide-gray-200 mb-6">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider font-black">Field</th>
                                <th class="px-6 py-3 text-left text-xs uppercase tracking-wider font-black">Details</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Name</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucwords($businessOwner->firstName) . " " . ucwords($businessOwner->lastName) }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Email</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $businessOwner->email }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Phone</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $businessOwner->mobileNumber }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Space Title</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $listing->title }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- Billing Details Section -->
                    <h3 class="text-2xl font-bold mt-6 mb-4">Billing Details</h3>
                    @if($billingDetails)
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Field</th>
                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Details</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Billing ID</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $billingDetails->billingDetailID }}</td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">GCash Number</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $billingDetails->gcash_number }}</td>
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <p class="text-gray-600">No billing details found.</p>
                    @endif

                    <!-- Negotiation Offers Section -->
                    @if($negotiations->count())
                        <h3 class="text-2xl font-bold mt-6 mb-4">Payments</h3>
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Proof of Payment</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($negotiations as $negotiation)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">P{{ number_format($negotiation->offerAmount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            @php
                                                // Fetch the payment that matches both rentalAgreementID and amount
                                                $payment = $payments->firstWhere(function ($payment) use ($negotiation) {
                                                    return $payment->rentalAgreementID == $negotiation->negotiationID && $payment->amount == $negotiation->offerAmount;
                                                });
                                            @endphp
                                            {{ $payment ? ucwords($payment->status) : 'No Payment' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($payment && $payment->admin_proof)
                                            <div class="mt-4">
                                                <a href="{{ asset('storage/' . $payment->admin_proof) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $payment->admin_proof) }}" alt="Admin Proof of Payment" class="w-32 h-32 object-cover rounded" />
                                                </a>
                                            </div>
                                        @else
                                            <p class="text-gray-600">No proof of payment uploaded by admin yet.</p>
                                        @endif
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @if($payment && $payment->status == 'transferred')
                                                <form action="{{ route('payments.approve', $payment->paymentID) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                                                        Approve Payment
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-600">No negotiations found for this business owner.</p>
                    @endif

                    <!-- Divider between different business owners -->
                    <hr class="my-6 border-gray-200">
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
