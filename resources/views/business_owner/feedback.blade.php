<title>Feedback</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg border border-gray-300">
                
                <!-- Feedback Title -->
                <div class="text-center mb-4">
                    <h3 class="text-lg font-bold">Submit Feedback</h3>
                </div>

                <!-- Feedback Experience Section -->
                <form action="{{ route('business.submit') }}" method="POST" class="mt-6">
                    @csrf
                    <div class="text-center">
                        <h4 class="text-lg font-semibold">How was your experience?</h4>
                        <p class="text-sm text-gray-600">How do you feel about this transaction?</p>
                        <div class="flex justify-center mt-4 space-x-4">
                            <label>
                                <input type="radio" name="rate" value="5" class="hidden rate-input" required>
                                <span class="text-4xl cursor-pointer rate-emoji" data-value="5">😀</span>
                            </label>
                            <label>
                                <input type="radio" name="rate" value="3" class="hidden rate-input" required>
                                <span class="text-4xl cursor-pointer rate-emoji" data-value="3">😐</span>
                            </label>
                            <label>
                                <input type="radio" name="rate" value="2" class="hidden rate-input" required>
                                <span class="text-4xl cursor-pointer rate-emoji" data-value="2">😞</span>
                            </label>
                            <label>
                                <input type="radio" name="rate" value="1" class="hidden rate-input" required>
                                <span class="text-4xl cursor-pointer rate-emoji" data-value="1">😡</span>
                            </label>
                        </div>
                    </div>
                    <div class="text-center mb-4">
                        <h4 class="text-lg font-bold">Leave Feedback for the Space Owner</h4>
                        <p class="text-sm text-gray-600">Summarize your experience</p>
                    </div>

                    <!-- Feedback Form -->
                    <input type="hidden" name="renterID" value="{{ auth()->id() }}">
                    <input type="hidden" name="rentalAgreementID" value="{{ $rentalAgreement->rentalAgreementID }}">

                    <!-- Feedback Textarea -->
                    <div class="mb-4">
                        <textarea name="comment" rows="4" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Leave your feedback here..." required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle emoji click and update radio button -->
    <script>
        document.querySelectorAll('.rate-emoji').forEach(emoji => {
            emoji.addEventListener('click', function() {
                // Find the corresponding radio button and select it
                const value = this.getAttribute('data-value');
                const radioButton = document.querySelector(`input[name="rate"][value="${value}"]`);
                if (radioButton) {
                    radioButton.checked = true;
                }
            });
        });
    </script>
</x-app-layout>
