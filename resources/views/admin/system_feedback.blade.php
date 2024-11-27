<!-- resources/views/admin/feedbacks/index.blade.php -->
<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-4 text-center">System Feedbacks</h2>

        <!-- Feedbacks Table -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Feedback</th>
                    <th>Rating</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($feedbacks as $feedback)
                    <tr>
                        <td>{{ $feedback->feedbackID}}</td>
                        <td>{{ $feedback->spaceOwner->firstName }} {{ $feedback->spaceOwner->lastName }}</td>
                        <td>{{ $feedback->feedback_content }}</td>
                        <td>{{ $feedback->rating }}</td>
                        <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
