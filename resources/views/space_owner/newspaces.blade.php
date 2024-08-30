<!-- resources/views/space_owner/post-new-space.blade.php -->
<title>Post New Space</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post New Space') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="max-w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('space.new.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700">Title</label>
                        <input type="text" name="title" class="w-full p-2 border rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Location</label>
                        <input type="text" name="location" class="w-full p-2 border rounded-md" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Description</label>
                        <textarea name="description" class="w-full p-2 border rounded-md" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Upload Image</label>
                        <input type="file" name="image" class="w-full p-2 border rounded-md">
                    </div>

                    <div>
                        <button type="submit" class="bg-orange-400 text-white py-2 px-4 rounded-md">Post Space</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
