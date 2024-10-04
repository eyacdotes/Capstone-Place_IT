<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/images/placeholder.png') }}" type="image/png">
    <title>Email Verification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-nmkRI2k3l2GKtWo8ZxLpW2VfZHRlXYWnPbm2LFl9hAL5ZtntF7D1h6jcNcdEHOo5AC5f5E3i6fq4+Qkv3DdOdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Ensure Tailwind is loaded -->
    
</head>
<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600 font-medium">
        {{ __('Thanks for signing up! Before getting started, could you verify using the OTP (One-Time Passcode) we just emailed to you?') }}
    </div>

    @if(session('status'))
        <div>{{ session('status') }}</div>
    @endif

    @if(session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('otp.verify.submit') }}">
        @csrf
            <label for="otp">Enter the OTP:</label>
            <input type="text" name="otp" id="otp" required>
            <button class="border-2 p-2 rounded-lg bg-green-400 font-semibold" type="submit">Verify OTP</button>
    </form>

    <form method="POST" action="{{ route('email.send') }}">
        @csrf
        <div>
            <x-primary-button>
                {{ __('Send OTP') }}
            </x-primary-button>
        </div>
    </form>
    <!-- Logout form -->
    <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Log Out') }}
            </button>
        </form>
</x-guest-layout>
