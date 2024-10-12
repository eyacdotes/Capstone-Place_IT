<title>Edit Listing</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Listing') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="w-full sm:w-11/12 lg:w-10/12 mx-auto flex flex-col sm:flex-row gap-6">
            <!-- Left Side: Image Preview and Add New Image -->
            <div class="w-full sm:w-1/2 lg:w-1/2 flex flex-col">
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg flex-1">
                    <!-- Image Preview and Management -->
                    <div class="relative mb-4">
                        @php $imageCount = count($listing->images); @endphp

                        <div class="{{ $imageCount == 1 ? 'grid grid-cols-1' : 'grid grid-cols-2 sm:grid-cols-3' }} gap-4">
                            @foreach($listing->images as $image)
                                <div class="{{ $imageCount == 1 ? 'w-full h-64' : 'relative w-full h-40' }}">
                                    <!-- Image Display -->
                                    <img src="{{ asset('storage/images/' . $image->image_path) }}" alt="Image" class="rounded-lg object-cover w-full h-full">

                                    <!-- Delete Button (Top-right corner of the image) -->
                                    <form method="POST" action="{{ route('space_owner.delete_image', ['listingImageID' => $image->listingImageID]) }}" class="absolute top-1 right-1">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-gradient-to-r from-white to-gray-80 text-white rounded-s-3xl px-2 py-1 hover:bg-gradient-to-r from-gray to-white-90">
                                            &times;
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Add New Image Section -->
                    <div class="mt-4">
                        <form method="POST" action="{{ route('space_owner.add_image', ['listingID' => $listing->listingID]) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="new_image" class="block text-gray-700 font-bold mb-2">Add New Image</label>
                                <input type="file" id="new_image" name="new_image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                                @error('new_image')
                                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="flex justify-center mt-4">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-700">Add Image</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form Inputs -->
            <div class="w-full sm:w-1/2 lg:w-1/2 flex flex-col">
                <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg flex-1">
                    <form method="POST" action="{{ route('space_owner.update', ['listingID' => $listing->listingID]) }}">
                        @csrf

                        <!-- Title -->
                        <div class="mb-4">
                            <label for="title" class="block text-gray-700 font-bold mb-2">Title</label>
                            <input type="text" id="title" name="title" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('title', $listing->title) }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Location -->
                        <div class="mb-4">
                            <label for="location" class="block text-gray-700 font-bold mb-2">Location</label>
                            <input type="text" id="location" name="location" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('location', $listing->location) }}" required>
                            @error('location')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                            <textarea id="description" name="description" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>{{ old('description', $listing->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-center mt-6">
                            <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-700">Update Listing</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
