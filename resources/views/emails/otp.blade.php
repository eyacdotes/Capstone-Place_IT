<!-- resources/views/emails/verify_email_otp.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        /* Include Tailwind CSS styles */
        @import url('https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css');
    </style>
</head>
<body class="bg-gray-100 py-8">
    <div class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-lg">
        <h1 class="text-2xl font-semibold text-gray-800">Verify Your Email</h1>
        <p class="mt-2 text-gray-600">Dear User,</p>
        <p class="mt-2 text-gray-600">
            To complete your registration, please enter the OTP code below in the verification page.
        </p>

        <div class="mt-4 bg-gray-50 border border-gray-300 rounded-lg p-4 text-center">
            <p class="text-lg font-bold text-gray-900">{{ $otp }}</p>
        </div>

        <p class="mt-4 text-gray-600">
            This code is valid for the next 10 minutes. If you did not request this, please ignore this email.
        </p>

        <p class="mt-6 text-sm text-gray-500">
            Thank you for using our platform!
        </p>

        <div class="mt-8 border-t border-gray-200 pt-6 text-sm text-gray-400">
            <p>&copy; {{ date('Y') }} Your Company. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
