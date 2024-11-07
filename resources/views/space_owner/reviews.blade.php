<title>Feedback</title>
<style>
    /* Emojis with transition and hover effects */
    .rate-emoji {
        transition: background-color 0.3s, transform 0.2s, box-shadow 0.2s ease-in-out;
        padding: 10px;
        border-radius: 50%; /* Fully rounded appearance */
    }

    .rate-emoji:hover {
        transform: scale(1.2); /* Slight zoom effect on hover */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
    }

    .rate-emoji.selected {
        background-color: #ff7f3f;
        color: white;
    }

    /* Rounded container with gradient background */
    .feedback-container {
        border-radius: 1.5rem;
        overflow: hidden;
        background: linear-gradient(135deg, #ffb88e, #ea5753); /* New gradient background */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Shadow for depth */
    }

    /* Enhanced submit button */
    .submit-btn {
        border-radius: 1.5rem;
        transition: background-color 0.3s, transform 0.2s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect */
    }

    .submit-btn:hover {
        background-color: #e86d3a; /* Darker shade on hover */
        transform: translateY(-2px); /* Slight lift effect */
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15); /* Slightly bigger shadow */
    }

    .submit-btn:focus {
        outline: none;
        ring: 4px rgba(255, 163, 87, 0.6); /* Focus ring */
    }

    /* Text animations */
    .fade-in {
        animation: fadeIn 1s ease-out;
    }

    /* Fade-in animation */
    @keyframes fadeIn {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }

    /* Stylish text in the container */
    .container-header h3 {
        font-size: 2rem;
        color: #fff;
        font-weight: bold;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3); /* Light text shadow for visibility */
    }

    .container-header p {
        color: #fff;
        font-size: 1rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2); /* Light text shadow */
    }

    .rate-emoji span {
        font-size: 1.25rem;
        transition: transform 0.3s;
    }

    .rate-emoji:hover span {
        transform: scale(1.2);
    }

</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedback') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="max-w-7xl mx-auto sm:px-7 lg:px-9"> <!-- Increased max-width to fit all items -->
            <div class="bg-white p-12 shadow-xl sm:rounded-2xl border border-gray-200 feedback-container">
                
                <!-- Feedback Title -->
                <div class="text-center mb-8 container-header fade-in">
                    <h3 class="text-2xl font-semibold text-gray-800">We Value Your Feedback!</h3>
                    <p class="text-gray-600 mt-2">Tell us how you feel about using our platform.</p>
                    <p class="text-gray-600">Your feedback is valuable to us and helps improve our system, PlaceIt.</p>
                    <p class="text-gray-600">Please share your experience to help us grow and serve you better!</p>
                </div>

                <!-- Feedback Experience Section -->
                <form action="{{ route('space.submit') }}" method="POST" class="mt-6 space-y-6">
                    @csrf

                    <!-- Rating -->
                    <div class="text-center">
                        <h4 class="text-lg font-semibold text-gray-700">How was your experience?</h4>
                        <p class="text-sm text-gray-500 mb-6">Click an emoji to rate us!</p>
                        <div class="flex justify-center space-x-8"> <!-- Centered emojis -->
                            <label class="flex flex-col items-center cursor-pointer">
                                <input type="radio" name="rate" value="1" class="hidden rate-input" required>
                                <span class="text-4xl rate-emoji" data-value="1">😡</span>
                                <span class="text-yellow-500 text-sm mt-2">⭐</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer">
                                <input type="radio" name="rate" value="2" class="hidden rate-input" required>
                                <span class="text-4xl rate-emoji" data-value="2">😞</span>
                                <span class="text-yellow-500 text-sm mt-2">⭐⭐</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer">
                                <input type="radio" name="rate" value="3" class="hidden rate-input" required>
                                <span class="text-4xl rate-emoji" data-value="3">😐</span>
                                <span class="text-yellow-500 text-sm mt-2">⭐⭐⭐</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer">
                                <input type="radio" name="rate" value="4" class="hidden rate-input" required>
                                <span class="text-4xl rate-emoji" data-value="4">😀</span>
                                <span class="text-yellow-500 text-sm mt-2">⭐⭐⭐⭐</span>
                            </label>
                            <label class="flex flex-col items-center cursor-pointer">
                                <input type="radio" name="rate" value="5" class="hidden rate-input" required>
                                <span class="text-4xl rate-emoji" data-value="5">😊</span>
                                <span class="text-yellow-500 text-sm mt-2">⭐⭐⭐⭐⭐</span>
                            </label>
                        </div>
                    </div>

                    <!-- Feedback Section -->
                    <div class="text-center mt-6">
                        <h4 class="text-lg font-semibold text-gray-700">Leave your feedback</h4>
                        <p class="text-sm text-gray-500 mb-6">We'd love to hear your thoughts!</p>
                    </div>

                    <!-- Hidden Renter ID -->
                    <input type="hidden" name="renterID" value="{{ auth()->id() }}">

                    <!-- Feedback Textarea -->
                    <div class="mb-6">
                        <textarea name="feedback_content" rows="4" class="w-full p-4 border border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-400" placeholder="Leave your feedback here..." required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="bg-orange-500 text-white py-3 px-8 rounded-2xl submit-btn hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-400">Submit Feedback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle emoji click and update radio button -->
    <script>
        document.querySelectorAll('.rate-emoji').forEach(emoji => {
            emoji.addEventListener('click', function() {
                // Remove 'selected' class from all emojis
                document.querySelectorAll('.rate-emoji').forEach(e => e.classList.remove('selected'));
                
                // Add 'selected' class to the clicked emoji
                this.classList.add('selected');

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
