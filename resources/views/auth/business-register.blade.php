<!-- resources/views/auth/space-register.blade.php -->

<title>Register as Business Owner</title>
<x-guest-layout>
    <form method="POST" action="{{ route('business.register') }}">
        @csrf
        <div class="flex justify-between mb-2">
            <span>Are you a Space Owner?</span>
            <a href="{{ route('space.register') }}" class="text-blue-500 hover:underline">Register here</a>
        </div>
        <hr class="border-black border-1 my-6">
        <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- First Name -->
            <div>
                <x-input-label for="firstName" :value="__('First Name')" />
                <x-text-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus autocomplete="given-name" />
                <x-input-error :messages="$errors->get('firstName')" class="mt-2" />
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="lastName" :value="__('Last Name')" />
                <x-text-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required autocomplete="family-name" />
                <x-input-error :messages="$errors->get('lastName')" class="mt-2" />
            </div>
        </div>


        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mobile Number -->
        <div class="mt-4">
            <x-input-label for="mobileNumber" :value="__('Mobile Number')" />
            <x-text-input id="mobileNumber" class="block mt-1 w-full" type="text" name="mobileNumber" :value="old('mobileNumber')" required autocomplete="tel" />
            <x-input-error :messages="$errors->get('mobileNumber')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-between mt-4">
    <!-- Already registered link on the left -->
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <!-- Register button on the right -->
            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>