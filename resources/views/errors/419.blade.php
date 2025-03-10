<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>419 - Page Expired</title>
    <link rel="icon" href="{{ asset('placeholder.png') }}" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="text-center px-6">
        <img src="https://i.ibb.co/71R4xGX/467480305-1108971497441214-9193229465343957486-n-removebg-preview.png" alt="Error Image" class="mx-auto w-40 h-40">
        <h1 class="text-7xl font-extrabold text-yellow-500">419</h1>
        <p class="text-2xl text-gray-700 mt-4">Page Expired</p>
        <p class="text-lg text-gray-600 mt-2">
            It looks like your session has expired. Please refresh the page or log in again.
        </p>
        <a href="{{ url('/dashboard') }}" class="mt-6 inline-block bg-blue-600 text-white px-6 py-3 rounded-lg text-lg hover:bg-blue-700 transition">
            Back to Homepage
        </a>
    </div>
</body>
</html>
