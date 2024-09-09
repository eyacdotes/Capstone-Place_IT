<title>Edit Listing</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Listing') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="w-full sm:w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <!-- Image Preview and Management -->
                <div class="relative mb-4">
                    <div class="flex flex-wrap gap-4">
                        @foreach($listing->images as $image)
                            <div class="relative w-40 h-40">
                                <!-- Image Display -->
                                <img src="{{ asset('storage/images/' . $image->image_path) }}" alt="Image" class="rounded-lg object-cover w-full h-full">

                                <!-- Delete Button (Top-right corner of the image) -->
                                <form method="POST" action="{{ route('space_owner.delete_image', ['listingImageID' => $image->listingImageID]) }}" class="absolute top-1 right-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white rounded-full px-2 py-1 hover:bg-red-700">
                                        &times;
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Add New Image Section -->
                <form method="POST" action="{{ route('space_owner.add_image', ['listingID' => $listing->listingID]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label for="new_image" class="block text-gray-700 font-bold mb-2">Add New Image</label>
                        <input type="file" id="new_image" name="new_image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500">
                        @error('new_image')
                            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-700">Add Image</button>
                </form>

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
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-700">Update Listing</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
