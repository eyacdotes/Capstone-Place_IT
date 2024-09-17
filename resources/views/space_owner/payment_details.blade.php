<!-- resources/views/business_owner/payment_details.blade.php -->
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
                <!-- Business Owner Details Section -->
                <h3 class="text-2xl font-bold mb-4">Business Owner Information</h3>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider font-black">Field</th>
                            <th class="px-6 py-3 text-left text-xs uppercase tracking-wider font-black">Details</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Name</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $businessOwner->firstName . " " . $businessOwner->lastName }}</td>
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
                @if($negotiations->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($negotiations as $negotiation)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Offer Amount</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">P{{ number_format($negotiation->offerAmount, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="text-gray-600">No negotiations found.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
