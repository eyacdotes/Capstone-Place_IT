<!-- resources/views/admin/payments/index.blade.php -->
<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Payment History</h2>

        <!-- Payments Table -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Renter</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->paymentID }}</td>
                        <td>{{ $payment->renter->firstName }} {{ $payment->renter->lastName }}</td>
                        <td>₱{{ number_format($payment->amount, 2) }}</td>
                        <td>{{ ucfirst($payment->status) }}</td>
                        <td>{{ $payment->date->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
