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
                <div class="text-center">
                    <h4 class="text-lg font-semibold">How was your experience?</h4>
                    <p class="text-sm text-gray-600">How do you feel about the system?</p>
                    <div class="flex justify-center mt-4 space-x-4">
                        <img src="{{ asset('storage/images/smile.png') }}" alt="Happy" class="w-10">
                        <img src="{{ asset('storage/images/neutral.png') }}" alt="Neutral" class="w-10">
                        <img src="{{ asset('storage//images/sad.png') }}" alt="Sad" class="w-10">
                        <img src="{{ asset('storage/images/angry.png') }}" alt="Angry" class="w-10">
                    </div>
                </div>

                <!-- Feedback Form -->
                <form action="#" method="POST" class="mt-6">
                    @csrf

                    <!-- Feedback Title -->
                    <div class="text-center mb-4">
                        <h4 class="text-lg font-bold">Leave Feedback for the System</h4>
                        <p class="text-sm text-gray-600">Summarize your experience</p>
                    </div>

                    <!-- Feedback Textarea -->
                    <div class="mb-4">
                        <textarea name="feedback" rows="4" class="w-full p-2 border border-gray-300 rounded-lg" placeholder="Leave your rant here..."></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" class="bg-orange-500 text-white py-2 px-4 rounded-lg hover:bg-orange-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
