<!-- resources/views/admin/negotiations/index.blade.php -->
<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-4 text-center">All Negotiations</h2>

        <!-- Negotiations Table -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Owner</th>
                    <th>Offer Amount</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($negotiations as $negotiation)
                    <tr>
                        <td>{{ $negotiation->negotiationID }}</td>
                        <td>{{ $negotiation->listing->title }}</td>
                        <td>{{ $negotiation->receiver->firstName }} {{ $negotiation->receiver->lastName }}</td>
                        <td>₱{{ number_format($negotiation->offerAmount, 2) }}</td>
                        <td>{{ ucfirst($negotiation->negoStatus) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
