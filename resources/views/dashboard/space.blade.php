<title>Space Owner Dashboard</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Spaces') }}
        </h2>
    </x-slot>
        <div class="w-full lg:w-3/4 mx-auto mt-4 sm:px-4 lg:px-9">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex-1 p-6 bg-white">
                    <h5>Sort by date</h5>
                    <form method="GET" action="{{ route('space.dashboard') }}" class="mt-2">
                        <input type="date" name="date" class="border rounded-md p-2" value="{{ request('date') }}">
                        <button type="submit" class="bg-orange-400 text-white py-2 px-4 rounded-md">Filter</button>
                    </form>

                    <div class="mt-4 space-y-4">
                        @php
                            $found = false;
                        @endphp
                        @foreach ($listings as $listing)
                            @if (!request('date') || $listing->dateCreated->format('Y-m-d') == request('date'))
                                @php
                                    $found = true;
                                @endphp
                                <!-- Card Section (wider card) -->
                                <div class="bg-neutral-200 text-white rounded-lg shadow-lg flex p-4 items-start flex-col space-y-4 w-full">
                                    <!-- Image and Details Section -->
                                    <div class="flex items-start space-x-6 w-full">
                                        <!-- Listing Image Section -->
                                        <div class="w-40 h-40">
                                            @if($listing->images->count() > 0)
                                                <!-- Display the first image for the listing -->
                                                <img src="{{ asset('storage/images/' . $listing->images->first()->image_path) }}" alt="{{ $listing->title }}" class="object-cover rounded-md w-full h-full">
                                            @else
                                                <!-- Display a placeholder image if no images are available -->
                                                <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="object-cover rounded-md w-full h-full">
                                            @endif
                                        </div>

                                        <!-- Listing Details Section (expanded width) -->
                                        <div class="flex-grow">
                                            <h3 class="text-xl font-bold text-black">{{ $listing->title }}</h3>
                                            <p class="text-sm text-gray-800">{{ $listing->location }}</p>
                                            <p class="text-sm text-gray-800 mt-1">{{ $listing->description }}</p>
                                            <p class="text-sm text-gray-800 mt-1">Listed on {{ $listing->dateCreated->format('Y-m-d') }}</p>

                                            <!-- Display Status with dynamic color based on status -->
                                            <p class="mt-2 font-semibold text-sm 
                                                {{ $listing->status === 'Vacant' ? 'text-green-500' : '' }}
                                                {{ $listing->status === 'Pending' ? 'text-gray-400' : '' }}
                                                {{ $listing->status === 'Disapproved' ? 'text-red-500' : '' }}
                                                {{ $listing->status === 'Deactivated' ? 'text-red-500' : '' }}
                                                {{ $listing->status === 'Occupied' ? 'text-red-500' : '' }}">
                                                {{ $listing->status }}
                                            </p>
                                            
                                        </div>
                                        
                                    </div>
                                    <hr class="border-gray-500 w-full border-1 my-6">

                                    <!-- Edit and Delete Button Section (placed below details) -->
                                    <div class="flex w-full space-x-2 justify-end">
                                        <a href="{{ route('space_owner.edit', ['listingID' => $listing->listingID]) }}" class="bg-orange-500 text-white px-4 py-2 w-40 h-10 rounded-lg hover:bg-orange-400 text-center">
                                            Edit
                                        </a>
                                        @if ($listing->status === 'Deactivated')
                                        <form action="{{ route('listings.restore', ['listingID' => $listing->listingID]) }}" method="POST" class="inline-block">
                                            @csrf
                                            <button type="submit" class="bg-green-500 text-white px-4 py-2 w-40 rounded-lg hover:bg-green-700 text-center">
                                                Restore
                                            </button>
                                        </form>
                                        @else
                                        <form action="{{ route('listings.destroy', ['listingID' => $listing->listingID]) }}" method="POST" class="inline-block" id="deactivate-form-{{ $listing->listingID }}">
                                            @csrf
                                            <button type="button" class="bg-red-700 text-white px-4 py-2 w-40 rounded-lg hover:bg-red-500 text-center" onclick="confirmDeactivation('{{ $listing->listingID }}', '{{ $listing->title }}')">
                                                Deactivate
                                            </button>
                                        </form>
                                        @endif
                                    </div>

                                    <script>
                                    function confirmDeactivation(listingID, listingTitle) {
                                        Swal.fire({
                                            title: 'Are you sure?',
                                            text: "Deactivate " + listingTitle + "?",
                                            icon: 'warning',
                                            showCancelButton: true,
                                            confirmButtonColor: '#d33',
                                            cancelButtonColor: '#3085d6',
                                            confirmButtonText: 'Yes, deactivate it!'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('deactivate-form-' + listingID).submit();
                                            }
                                        });
                                    }
                                    </script>
                                </div>
                            @endif
                        @endforeach
                                @if (!$found)
                                <tr>
                                    <td colspan="6" class="text-lg text-center py-4 bg-gray-100">
                                        No Space Posted. 
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