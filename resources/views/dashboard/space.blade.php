<!-- resources/views/space.blade.php -->
<title>Space Owner Dashboard</title>
<x-app-layout>
    <div class="w-full py-6 flex justify-center">
        <div class="max-w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex-1 p-6 bg-white">
                    <h5>Sort by date</h5>
                    <form method="GET" action="{{ route('space.dashboard') }}" class="mt-2">
                        <input type="date" name="date" class="border rounded-md p-2" value="{{ request('date') }}">
                        <button type="submit" class="bg-orange-400 text-white py-2 px-4 rounded-md">Filter</button>
                    </form>
                    <table class="mt-4 w-full max-w-7xl text-sm text-left border-collapse rounded-lg overflow-hidden">
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
                            @foreach ($listings as $listing)
                                @if (!request('date') || $listing->dateCreated->format('Y-m-d') == request('date'))
                                    <tr class="bg-white hover:bg-opacity-75">
                                        <td class="px-6 py-4 bg-gray-100 whitespace-normal break-words">{{ $listing->title }}</td>
                                        <td class="px-6 py-4 bg-gray-100 whitespace-normal break-words">{{ $listing->location }}</td>
                                        <td class="px-6 py-4 bg-gray-100 whitespace-normal break-words">{{ $listing->description }}</td>
                                        <td class="px-6 py-4 bg-gray-100 whitespace-nowrap">{{ $listing->dateCreated->format('Y-m-d') }}</td>
                                        <td class="px-6 py-4 bg-gray-100 whitespace-nowrap">{{ $listing->status }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
