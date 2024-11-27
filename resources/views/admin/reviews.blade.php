<!-- resources/views/admin/reviews/index.blade.php -->
<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-4 text-center">Reviews</h2>

        <!-- Reviews Table -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Agreement ID</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->rentalAgreementID }}</td>
                        <td>{{ $review->rate }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
