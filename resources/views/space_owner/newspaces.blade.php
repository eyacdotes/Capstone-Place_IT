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
                    <div>
                        <p class="font-bold text-xl">Space for rent</p>
                        <span class="text-gray-500">Be descriptive as possible</span>
                    </div>
                    <hr class="mb-4 bg-gray-800 h-0.5">

                    <!-- Container to align form fields in two columns -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Left side fields (Title, Location, Upload Images) -->
                        <div>
                            <div class="mb-4">
                                <label class="block text-gray-700">Title</label>
                                <input type="text" name="title" class="text-sm w-full p-3 border rounded-md" placeholder="e.g Gate Space" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-gray-700">Location</label>
                                <input type="text" name="location" class="text-sm w-full p-3 border rounded-md" placeholder="e.g Pardo Cebu City" required>
                            </div>

                            <!-- New Upload Images Section -->
                                <label class="block text-gray-700">Upload Images</label>
                                <section class="container w-full mx-auto items-center py-2">
                                        <div class="px-4 py-2">
                                            <div id="image-preview" class="max-w-sm p-6 mb-4 bg-gray-100 border-dashed border-2 border-gray-400 rounded-lg items-center mx-auto text-center cursor-pointer">
                                                <input id="upload" type="file" name="images[]" class="hidden" accept="image/*" multiple />
                                                <label for="upload" class="cursor-pointer">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-700 mx-auto mb-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                                    </svg>
                                                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-700">Upload picture</h5>
                                                    <p class="font-normal text-sm text-gray-400 md:px-6">Choose photo size should be less than <b class="text-gray-600">2MB</b></p>
                                                    <p class="font-normal text-sm text-gray-400 md:px-6">and should be in <b class="text-gray-600">JPG, PNG, or GIF</b> format.</p>
                                                    <span id="filename" class="text-gray-500 bg-gray-200 z-50"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </section>

                        <!-- Right side (Description) -->
                        <div>
                            <label class="block text-gray-700">Description</label>
                            <textarea name="description" class="text-sm w-full p-3 border rounded-md h-32" placeholder="Short Description..." required></textarea>
                        </div>
                    </div>

                    <!-- Centered button -->
                    <div class="flex justify-center mt-3">
                        <button type="submit" class="bg-orange-400 text-white py-2 px-4 rounded-md">Post Space</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const uploadInput = document.getElementById('upload');
        const filenameLabel = document.getElementById('filename');
        const imagePreview = document.getElementById('image-preview');

        uploadInput.addEventListener('change', (event) => {
            const files = event.target.files;

            if (files.length > 0) {
                filenameLabel.textContent = `${files.length} file(s) selected`;

                imagePreview.innerHTML = '';
                for (const file of files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'max-h-48 rounded-lg mx-auto mb-2';
                        imagePreview.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            } else {
                filenameLabel.textContent = '';
                imagePreview.innerHTML = `
                    <div class="bg-gray-200 h-48 rounded-lg flex items-center justify-center text-gray-500">No image preview</div>`;
            }
        });

        imagePreview.addEventListener('click', () => {
            uploadInput.click();
        });
    </script>
</x-app-layout>
