<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/images/placeholder.png') }}" type="image/png">
    <title>Email Verification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Add jQuery CDN -->
    <script src="{{ asset('jquery.js') }}"></script>    
</head>
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 font-medium">
        {{ __('Before you get started, please verify your email address. Click the "Send OTP" button below to receive your One-Time Passcode (OTP) via email. Once you\'ve received the OTP, enter it to complete the verification process.') }}
    </div>

    @if(session('status'))
        <div id="statusMessage" class="mb-4 text-sm text-green-600 font-medium">{{ session('status') }}</div>
    @endif

    @if(session('error'))
        <div id="errorMessage" class="mb-4 text-sm text-red-600 font-medium">{{ session('error') }}</div>
    @endif

    <!-- OTP Input with Verify OTP button below -->
    <form method="POST" action="{{ route('otp.verify.submit') }}">
        @csrf
        <input type="text" name="otp" id="otp" class="border-2 p-2 rounded-md" placeholder="Enter OTP">
        <button class="border-2 p-2 rounded-lg bg-green-400 hover:bg-green-700 font-semibold" type="submit">Verify OTP</button>
    </form>

    <!-- Send OTP with AJAX -->
    <form id="sendOtpForm" method="POST">
        @csrf
        <div class="mt-4">
            <x-primary-button id="sendOtpButton">
                {{ __('Send OTP') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Logout form -->
    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Log Out') }}
        </button>
    </form>

    <!-- jQuery (make sure you have it loaded in your app.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            const cooldownKey = 'otpCooldown';
            const cooldownTimeKey = 'otpCooldownTime';

            // Check if there's a cooldown in localStorage
            if (localStorage.getItem(cooldownKey) === 'true') {
                const remainingTime = localStorage.getItem(cooldownTimeKey);
                startCooldown(remainingTime);
            }

            $('#sendOtpForm').on('submit', function(event) {
                event.preventDefault(); // Prevent form submission and page reload

                let sendOtpButton = $('#sendOtpButton');
                sendOtpButton.prop('disabled', true); // Disable button while processing
                sendOtpButton.text('Sending...');

                $.ajax({
                    url: "{{ route('email.send') }}", // Send OTP route
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}" // Include CSRF token
                    },
                    success: function(response) {
                        // Handle success
                        $('#statusMessage').text('OTP has been sent to your email address.').show();
                        sendOtpButton.text('Sent');
                        localStorage.setItem(cooldownKey, 'true'); // Set cooldown active
                        startCooldown(60); // Start cooldown
                    },
                    error: function(xhr) {
                        // Handle error
                        $('#errorMessage').text('There was an error sending the OTP. Please try again later.').show();
                        sendOtpButton.prop('disabled', false); // Re-enable button on error
                        sendOtpButton.text('Send OTP');
                    }
                });
            });

            // Function to start a cooldown timer
            function startCooldown(duration) {
                let cooldownTime = duration; // Use the passed duration
                const button = $('#sendOtpButton');
                
                button.prop('disabled', true); // Disable the button
                let interval = setInterval(function() {
                    if (cooldownTime > 0) {
                        button.text('Resend in ' + cooldownTime + 's');
                        cooldownTime--;
                        localStorage.setItem(cooldownTimeKey, cooldownTime); // Store remaining time
                    } else {
                        clearInterval(interval);
                        button.prop('disabled', false);
                        button.text('Send OTP');
                        localStorage.removeItem(cooldownKey); // Remove cooldown flag
                        localStorage.removeItem(cooldownTimeKey); // Clear remaining time
                    }
                }, 1000);
            }
        });
    </script>
</x-guest-layout>

