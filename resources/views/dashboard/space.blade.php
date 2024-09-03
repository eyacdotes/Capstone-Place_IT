<!-- resources/views/space.blade.php -->
<title>Space Owner Dashboard</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Spaces') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="w-full sm:w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex-1 p-6 bg-white">
                    <h5>Sort by date</h5>
                    <form method="GET" action="{{ route('space.dashboard') }}" class="mt-2">
                        <input type="date" name="date" class="border rounded-md p-2" value="{{ request('date') }}">
                        <button type="submit" class="bg-orange-400 text-white py-2 px-4 rounded-md">Filter</button>
                    </form>
                    <div class="overflow-x-auto mt-4">
                        <table class="w-full max-w-7xl text-sm text-left border-collapse rounded-lg">
                            <thead class="bg-orange-400">
                                <tr>
                                    <th class="px-6 py-4 text-white">Title</th>
                                    <th class="px-6 py-4 text-white">Location</th>
                                    <th class="px-6 py-4 text-white">Description</th>
                                    <th class="px-6 py-4 text-white">Date Posted</th>
                                    <th class="px-6 py-4 text-white">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $found = false;
                                @endphp
                                @foreach ($listings as $listing)
                                    @if (!request('date') || $listing->dateCreated->format('Y-m-d') == request('date'))
                                        @php
                                            $found = true;
                                        @endphp
                                        <tr class="bg-white hover:bg-opacity-75">
                                            <td class="px-6 py-4 bg-gray-100 whitespace-normal break-words">{{ $listing->title }}</td>
                                            <td class="px-6 py-4 bg-gray-100 whitespace-normal break-words">{{ $listing->location }}</td>
                                            <td class="px-6 py-4 bg-gray-100 whitespace-normal break-words">{{ $listing->description }}</td>
                                            <td class="px-6 py-4 bg-gray-100 whitespace-nowrap">{{ $listing->dateCreated->format('Y-m-d') }}</td>
                                            <td class="px-6 py-4 bg-gray-100 whitespace-nowrap">
                                                <span class="
                                                    {{ $listing->status === 'Vacant' ? 'text-green-600' : '' }}
                                                    {{ $listing->status === 'Occupied' ? 'text-blue-600' : '' }}
                                                    {{ $listing->status === 'Deactivated' || $listing->status === 'Another Term' ? 'text-red-600' : '' }}
                                                    font-bold">
                                                    {{ $listing->status }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                @if (!$found)
                                <tr>
                                    <td colspan="6" class="text-lg text-center py-4 bg-gray-100">
                                        No Space Found 
                                        <a href="{{ route('space.newspaces') }}" class="text-blue-500 hover:text-blue-700">Post a space</a>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
