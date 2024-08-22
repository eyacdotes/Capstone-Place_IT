<!-- resources/views/space.blade.php -->
<title>Space Owner Dashboard</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Space Owner Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex-1 p-6 bg-white border-b border-gray-200">
                    Welcome, Space Owner! 
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
