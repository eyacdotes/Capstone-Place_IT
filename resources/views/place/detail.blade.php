<!-- resources/views/place/detail.blade.php -->
<title>Details of {{ $listing->title }}</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details of ' . $listing->title) }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <!-- Title and Owner -->
                    <div class="flex justify-between">
                        <h3 class="text-2xl font-semibold mb-2">{{ $listing->title }}</h3>
                        <p class="text-black-700"><strong>{{ $listing->owner->firstName . " " . $listing->owner->lastName }}</strong></p>
                    </div>

                    <!-- Images with Modal -->
                    <div class="relative">
                        <div class="flex space-x-4">
                            @foreach($listing->images as $image)
                                <!-- Clickable Image -->
                                <img src="{{ asset('storage/images/' . $image->image_path) }}" alt="Image" class="rounded-lg mb-4 cursor-pointer" 
                                    style="width: 300px; height: 200px; object-fit: cover;" 
                                    onclick="openModal('{{ asset('storage/images/' . $image->image_path) }}')">
                            @endforeach
                        </div>
                    </div>

                    <!-- Description and Details -->
                    <div class="mt-4">
                        <h4 class="font-semibold text-lg">Description</h4>
                        <p>{{ $listing->description }}</p>

                        <h4 class="font-semibold mt-2 text-lg">Status</h4>
                        <span class="
                            {{ $listing->status === 'Vacant' ? 'text-green-600' : '' }}
                            {{ $listing->status === 'Occupied' ? 'text-blue-600' : '' }}
                            {{ $listing->status === 'Deactivated' || $listing->status === 'Another Term' ? 'text-red-600' : '' }}
                            font-bold">
                            {{ $listing->status }}
                        </span>

                        <h4 class="font-semibold mt-2 text-lg">Location</h4>
                        <p>{{ $listing->location }}</p>
                    </div>

                    <!-- Map -->
                    <div class="mt-4">
                        <iframe src="https://www.google.com/maps?q={{ urlencode($listing->location) }}&output=embed" 
                            class="w-full h-60 rounded-lg" 
                            allowfullscreen="" 
                            loading="lazy"></iframe>
                    </div>

                    <!-- Negotiate Button -->
                    <div class="mt-6 text-center">
                        <button onclick="openNegotiationModal()" class="bg-blue-600 text-white py-2 px-4 rounded-full hover:bg-blue-700">Negotiate this Space</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Negotiation Modal -->
    <div id="negotiationModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
        <div class="relative bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
            <!-- Close Button -->
            <button onclick="closeNegotiationModal()" 
                    class="absolute top-0 right-0 mt-2 mr-2 text-gray-700 text-xl z-10 
                           bg-gray-300 hover:bg-gray-400 rounded-full h-8 w-8 flex items-center justify-center">
                &times;
            </button>

            <h2 class="text-xl font-semibold mb-4">Negotiate This Space</h2>

            <!-- Negotiation Form -->
            <form action="{{ route('negotiation.store') }}" method="POST">
                @csrf
                <input type="hidden" name="listingID" value="{{ $listing->listingID }}">
                <input type="hidden" name="receiverID" value="{{ $listing->owner->userID }}">

                <!-- Message -->
                <div class="mb-4">
                    <label class="block text-gray-700">Message</label>
                    <textarea name="message" class="w-full p-3 border rounded-md" rows="4" required>I want to negotiate this space!</textarea>
                </div>

                <!-- Offer Amount -->
                <div class="mb-4">
                    <label class="block text-gray-700">Offer Amount</label>
                    <input type="number" name="offerAmount" class="w-full p-3 border rounded-md" required>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-full hover:bg-green-700">Send Offer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Scripts -->
    <script>
        function openNegotiationModal() {
            document.getElementById('negotiationModal').classList.remove('hidden');
        }

        function closeNegotiationModal() {
            document.getElementById('negotiationModal').classList.add('hidden');
        }
    </script>

    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center">
        <div class="relative max-w-full max-h-full">
            <!-- Close Button with Circular Gray Background -->
            <button onclick="closeModal()" 
                    class="absolute top-0 right-0 mt-2 mr-2 text-white text-xl z-10 
                           bg-gray-700 bg-opacity-100 hover:bg-opacity-50 rounded-full h-10 w-10 flex items-center justify-center">
                &times;
            </button>
            <!-- Modal Image -->
            <img id="modalImage" src="" alt="Modal Image" class="rounded-lg" style="max-width: 90vw; max-height: 90vh; object-fit: contain;">
        </div>
    </div>
    

    <script>
        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }
    </script>

</x-app-layout>
