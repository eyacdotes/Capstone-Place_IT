<title>Business Owner Negotiation Details</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Negotiation Details') }}
        </h2>
    </x-slot>

    <div class="w-full py-4 flex justify-center">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-7xl">
            <div class="flex flex-col lg:flex-row h-[500px]">
                <!-- Chat Section -->
                <div class="w-full lg:w-2/3 p-4 border-b lg:border-b-0 lg:border-r border-gray-300">
                    <div class="h-full flex flex-col justify-between">
                        <!-- Name Section -->
                        <div class="flex items-center justify-between p-4 border-b border-gray-300">
                            <div class="flex items-center text-gray-800">
                                <a href="{{ route('business.negotiations') }}" class="flex items-center text-orange-500 hover:text-orange-800 hover:bg-gray-200 rounded-3xl p-2">
                                    <span class="flex items-center">
                                        <i class="fas fa-arrow-left mr-2"></i> 
                                    </span>
                                </a>
                                <span class="font-semibold p-4 text-xl">{{ ucwords($negotiation->receiver->firstName) }} {{ ucwords($negotiation->receiver->lastName) }}</span>
                            </div>
                        </div>
                        <!-- Messages Section -->
                        <div class="space-y-4 overflow-y-auto flex-1 chat-box h-[calc(100%_-_80px)] pt-4">
                        @foreach($negotiation->replies as $reply)
                            <div class="flex {{ $reply->senderID == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                <div class="p-4 rounded-lg shadow-lg {{ $reply->senderID == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                    @if (preg_match('/\.(jpeg|jpg|png|gif)$/i', $reply->message))
                                        <!-- Display the image if the message field contains an image name -->
                                        <img src="{{ asset('storage/negotiation_images/' . $reply->message) }}" alt="Image" class="max-w-xs rounded-lg cursor-pointer" onclick="openModal('{{ asset('storage/negotiation_images/' . $reply->message) }}')">
                                    @else
                                        <!-- Display the text message if not an image -->
                                        <p class="text-sm">{{ $reply->message }}</p>
                                    @endif
                                    <small class="text-xs">{{ $reply->created_at->format('h:i A') }}</small>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        <!-- Message Input -->
                        <form action="{{ route('bnegotiation.reply', ['negotiationID' => $negotiation->negotiationID]) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                            @csrf
                            <div class="flex items-center space-x-2 bg-gray-100 p-2 rounded-lg ">
                                <!-- Hidden file input -->
                                <label for="aImage" class="cursor-pointer flex items-center justify-center bg-gray-200 text-gray-600 p-2 rounded-lg hover:bg-gray-300">
                                    <!-- File attachment icon -->
                                    <i class="fas fa-paperclip"></i>
                                </label>
                                <input type="file" name="aImage" id="aImage" class="hidden" onchange="showFileName()"/>

                                <!-- File name display -->
                                <span id="fileName" class="text-gray-600 text-sm"></span>

                                <!-- Message input -->
                                <input type="text" name="message" class="flex-grow p-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-500" placeholder="Type your message...">

                                <!-- Send button -->
                                <button type="submit" class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700 flex items-center">
                                    Send
                                </button>
                            </div>
                        </form>

                        <!-- Include Font Awesome for the paperclip icon -->
                        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

                    </div>
                </div>

                <!-- Negotiation Details and Form Section -->
                <div class="w-full lg:w-1/2 p-4 border-t lg:border-t-0 lg:border-l border-gray-300">
                    <!-- Amount and Status Section -->
                    <div class="flex justify-between items-center mb-4">
                    <form action="{{ route('business.updateOfferAmount', $negotiation->negotiationID) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <h4 class="text-lg font-semibold pl-2">Amount Offered</h4>
                            <input name="offerAmount" class="pl-2 text-2xl bg-gray-100 rounded-md w-40 font-bold" value="{{ number_format($negotiation->offerAmount, 2) }}" step="0.01" required>
                        </div>

                        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Update Offer
                        </button>
                    </form>
                        <div class="text-right mb-6 pb-16">
                            <h4 class="text-lg font-semibold pr-4">Status</h4>
                            <span class="
                                {{ $negotiation->negoStatus === 'Approved' ? 'text-xl font-bold text-green-600' : '' }}
                                {{ $negotiation->negoStatus === 'Pending' ? 'text-xl font-bold text-blue-600' : '' }}
                                {{ $negotiation->negoStatus === 'Disapproved' || $negotiation->negoStatus === 'Another Term' ? 'text-xl font-bold text-red-600' : '' }}
                                font-bold">
                                {{ $negotiation->negoStatus }}
                            </span>
                        </div>
                    </div>

                    <!-- Conditional Display of Form or Proceed to Payment Button -->
                    <h4 class="text-lg font-semibold">Rental Agreement</h4>
                    @if($rentalAgreement) <!-- Check if rental agreement exists -->
                        <!-- Display the Rental Agreement Details -->
                        <div class="p-4 bg-gray-300 rounded-lg">
                            <p><strong>Rental Term:</strong> {{ ucfirst($rentalAgreement->rentalTerm) }}</p>
                            <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($rentalAgreement->dateStart)->format('M d, Y') }}</p>
                            <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($rentalAgreement->dateEnd)->format('M d, Y') }}</p>
                            <p><strong>Offer Amount:</strong> ₱{{ number_format($rentalAgreement->offerAmount, 2) }}</p>
                        </div>

                        @if(Auth::id() == $negotiation->senderID) <!-- If Business Owner -->
                            @if($rentalAgreement->status == 'approved' && !$rentalAgreement->isPaid)
                                <!-- Proceed to Payment Button -->
                                <a href="{{ route('business.proceedToPayment', ['negotiationID' => $negotiation->negotiationID]) }}" class="bg-green-600 text-white mt-4 py-2 px-4 rounded-lg hover:bg-green-700 w-full text-center block">
                                    Proceed to Payment
                                </a>
                            @elseif($rentalAgreement->isPaid)
                                <!-- Payment Confirmation Message -->
                                <p class="text-green-600 mt-4">Payment sent, wait for confirmation.</p>
                                <!-- Payment Status Display -->
                                @if($rentalAgreement->payments->isNotEmpty())
                                    @foreach($rentalAgreement->payments as $payment)
                                        <p class="text-gray-600">Payment Status: 
                                            @if($payment->status == 'pending')
                                                <span class="text-yellow-500">Pending</span>
                                            @elseif($payment->status == 'confirmed')
                                                <span class="text-green-500">Confirmed</span>
                                            @elseif($payment->status == 'transferred')
                                                <span class="text-red-500">Sent to Space Owner</span>
                                            @elseif($payment->status == 'received')
                                                <span class="text-red-500">Received by Space Owner</span>
                                            @else
                                                <span class="text-gray-500">Unknown</span>
                                            @endif
                                        </p>
                                    @endforeach
                                @else
                                    <p class="text-red-600">No payments found for this rental agreement.</p>
                                @endif

                            @else <!-- Check if rental agreement was submitted -->
                                <!-- Allow Business Owner to Edit if not confirmed -->
                                <button id="editModalButton" data-id="{{ $rentalAgreement->rentalAgreementID }}" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">
                                    Edit Rental Agreement
                                </button>

                                <!-- Modal Background -->
                                <div id="editModal" class="fixed inset-0 items-center flex justify-center bg-gray-900 bg-opacity-50 hidden">
                                    <!-- Modal Content -->
                                    <div class="bg-white rounded-lg w-full max-w-lg p-6">
                                        <h2 class="text-xl font-bold mb-4">Edit Rental Agreement</h2>

                                        <!-- Edit Rental Agreement Form -->
                                        <form method="POST" action="{{ route('rentalagreement.update', ['negotiationID' => $negotiation->negotiationID, 'rentalAgreementID' => $rentalAgreement->rentalAgreementID]) }}">
                                            @csrf
                                            @method('PUT')
                                            <!-- term -->
                                            <div class="mb-4">
                                                <label for="rentalTerm" class="block text-gray-700">Rental Term</label>
                                                <input type="text" id="rentalTerm" name="rentalTerm" class="w-full border-gray-300 rounded-lg" value="{{ $rentalAgreement->rentalTerm }}" required>
                                            </div>

                                            <!-- start date -->
                                            <div class="mb-4">
                                                <label for="dateStart" class="block text-gray-700">Start Date</label>
                                                <input type="date" id="dateStart" name="dateStart" class="w-full border-gray-300 rounded-lg" value="{{ $rentalAgreement->dateStart }}" required>
                                            </div>

                                            <!-- end date -->
                                            <div class="mb-4">
                                                <label for="dateEnd" class="block text-gray-700">End Date</label>
                                                <input type="date" id="dateEnd" name="dateEnd" class="w-full border-gray-300 rounded-lg" value="{{ $rentalAgreement->dateEnd }}" required>
                                            </div>
                                            
                                            <!-- Submit Button -->
                                            <div class="flex justify-end">
                                                <button type="button" id="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded mr-2">Cancel</button>
                                                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @else
                            <!-- If the user is not the sender, show Proceed to Payment Button -->
                            <a href="{{ route('business.proceedToPayment', ['negotiationID' => $negotiation->negotiationID]) }}" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 w-full text-center block">
                                Proceed to Payment
                            </a>
                        @endif
                    @else <!-- Form Section for Rental Term, Start Date, End Date -->
                                <form action="{{ route('negotiation.rentAgree', ['negotiationID' => $negotiation->negotiationID]) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="ownerID" value="{{ $negotiation->listing->ownerID }}">
                                    <input type="hidden" name="renterID" value="{{ $negotiation->senderID }}">
                                    <input type="hidden" name="listingID" value="{{ $negotiation->listingID }}">

                                    <!-- Rental Term -->
                                    <div class="flex flex-col">
                                        <label for="rentalTerm" class="block font-semibold text-gray-700">Rental Term:</label>
                                        <select class="p-2 border border-gray-300 rounded-lg" name="rentalTerm" id="rentalTerm" required>
                                            <option value="">Choose...</option>
                                            <option value="weekly">Weekly</option>
                                            <option value="monthly">Monthly</option>
                                            <option value="yearly">Yearly</option>
                                        </select>
                                    </div>

                                    <!-- Start Date -->
                                    <div class="flex flex-col mt-2">
                                        <label for="startDate" class="block mb-2 font-semibold text-gray-700">Start Date:</label>
                                        <input type="date" name="startDate" id="startDate" class="p-2 border border-gray-300 rounded-lg" required>
                                    </div>

                                    <!-- End Date -->
                                    <div class="flex flex-col mt-2">
                                        <label for="endDate" class="block mb-2 font-semibold text-gray-700">End Date:</label>
                                        <input type="date" name="endDate" id="endDate" class="mb-2 p-2 border border-gray-300 rounded-lg" required>
                                    </div>

                                    <!-- Hidden Fields for offerAmount -->
                                    <input type="hidden" name="offerAmount" value="{{ $negotiation->offerAmount }}">

                                    <!-- Submit Button -->
                                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 w-full">Submit</button>
                                </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
    let userScrolledUp = false; // Track if the user has scrolled up

    function fetchMessages() {
        $.ajax({
            url: '{{ route("negotiation.getMessages", ["negotiationID" => $negotiation->negotiationID]) }}',
            method: 'GET',
            success: function(data) {
                updateChat(data);
                scrollToBottom(); // Automatically scroll to the bottom after updating the chat, if user hasn't scrolled up
            }
        });
    }

    function updateChat(messages) {
        let chatBox = $('.chat-box');
        chatBox.empty();

        messages.forEach(function(message) {
            let messageHtml = '';

            if (/\.(jpeg|jpg|png|gif)$/i.test(message.message)) {
                // If the message is an image
                messageHtml = `
                    <div class="flex ${message.senderID == {{ Auth::id() }} ? 'justify-end' : 'justify-start'}">
                        <div class="p-4 rounded-lg shadow-lg ${message.senderID == {{ Auth::id() }} ? 'bg-blue-500 text-white' : 'bg-gray-200'}">
                            <img src="{{ asset('storage/negotiation_images/') }}/${message.message}" alt="Image" class="max-w-xs rounded-lg cursor-pointer" onclick="openModal('{{ asset('storage/negotiation_images/') }}/${message.message}')">
                            <small class="text-xs">${new Date(message.created_at).toLocaleTimeString()}</small>
                        </div>
                    </div>
                `;
            } else {
                messageHtml = `
                    <div class="flex ${message.senderID == {{ Auth::id() }} ? 'justify-end' : 'justify-start'}">
                        <div class="p-4 rounded-lg shadow-lg ${message.senderID == {{ Auth::id() }} ? 'bg-blue-500 text-white' : 'bg-gray-200'}">
                            <p class="text-sm">${message.message}</p>
                            <small class="text-xs">${new Date(message.created_at).toLocaleTimeString()}</small>
                        </div>
                    </div>
                `;
            }

            chatBox.append(messageHtml);
        });

        scrollToBottom(); // Scroll to the bottom if user has not scrolled up
    }

    function scrollToBottom() {
        let chatBox = $('.chat-box');

        // Only scroll to the bottom if user hasn't scrolled up
        if (!userScrolledUp) {
            chatBox.scrollTop(chatBox.prop("scrollHeight"));
        }
    }

    // Detect if user scrolls up in the chat box
    $('.chat-box').on('scroll', function() {
        let chatBox = $(this);

        // If user is near the bottom (within 50px), we consider it as not scrolled up
        if (chatBox.scrollTop() + chatBox.innerHeight() >= chatBox.prop('scrollHeight') - 50) {
            userScrolledUp = false; // User is near the bottom
        } else {
            userScrolledUp = true; // User has scrolled up
        }
    });

    function openModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }

    $(document).ready(function() {
        scrollToBottom(); // Immediately scroll to the bottom when the page is ready
    });

    // Fetch messages every 1 second
    setInterval(fetchMessages, 1000);

    function showFileName() {
        const fileInput = document.getElementById('aImage');
        const fileNameDisplay = document.getElementById('fileName');
        if (fileInput.files.length > 0) {
            fileNameDisplay.textContent = fileInput.files[0].name;
        } else {
            fileNameDisplay.textContent = ''; // Clear the text if no file is selected
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const editModal = document.getElementById('editModal');
        const editModalButton = document.getElementById('editModalButton');
        const closeModalButton = document.getElementById('closeModal'); 

        // Open the modal when the "Edit" button is clicked
        editModalButton.addEventListener('click', function () {
            editModal.classList.remove('hidden');
        });

        // Close the modal when the "Cancel" button is clicked
        closeModalButton.addEventListener('click', function () {
            editModal.classList.add('hidden');
        });

        // Optional: Close the modal when clicking outside of the modal content
        editModal.addEventListener('click', function (event) {
            if (event.target === editModal) {
                editModal.classList.add('hidden');
            }
        });
    });
</script>
    <!-- Image Modal -->
    <div id="imageModal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 items-center justify-center">
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
</x-app-layout>
