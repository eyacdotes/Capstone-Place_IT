<title>Space Owner Negotiation Details</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Negotiation Details') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-7xl">
            <div class="flex flex-col lg:flex-row h-[500px]">
                <!-- Chat Section -->
                <div class="w-full lg:w-2/3 p-4 border-b lg:border-b-0 lg:border-r border-gray-300">
                    <div class="h-full flex flex-col justify-between">
                        <!-- Messages Section -->
                        <div class="space-y-4 overflow-y-auto flex-1 chat-box h-[calc(100%_-_80px)]">
                            @foreach($negotiation->replies as $reply)
                                <div class="flex {{ $reply->senderID == Auth::id() ? 'justify-end' : 'justify-start' }} ">
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
                        <form action="{{ route('negotiation.reply', ['negotiationID' => $negotiation->negotiationID]) }}" method="POST" enctype="multipart/form-data" class="mt-4">
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
                    </div>
                </div>

                <!-- Negotiation Details Section -->
                <div class="w-full lg:w-1/3 p-4 overflow-y-auto">
                    <!-- Amount and Status Section -->
                    <div class="flex flex-col h-full justify-between">
                        <div class="mb-4">
                            <div class="flex items-center mb-2">
                                <div class="mr-4">
                                    <h4 class="text-lg font-semibold">Amount Offered</h4>
                                    <input class="text-2xl bg-gray-100 rounded-md w-40 font-bold" value="P{{ number_format($negotiation->offerAmount, 2) }}" readonly>
                                </div>
                                <div>
                                    <h4 class="text-lg font-semibold">Status</h4>
                                    <span class="
                                        {{ $negotiation->negoStatus === 'Approved' ? 'text-xl font-bold text-green-600' : '' }}
                                        {{ $negotiation->negoStatus === 'Pending' ? 'text-xl font-bold text-blue-600' : '' }}
                                        {{ $negotiation->negoStatus === 'Disapproved' || $negotiation->negoStatus === 'Another Term' ? 'text-xl font-bold text-red-600' : '' }}
                                        font-bold">
                                        {{ $negotiation->negoStatus }}
                                    </span>
                                </div>
                            </div>
                            @if($negotiation->negoStatus !== 'Approved')
                                <form action="{{ route('negotiation.updateStatus', ['negotiationID' => $negotiation->negotiationID]) }}" method="POST">
                                    @csrf
                                    <div class="mb-4">
                                        <label for="status" class="block text-lg font-semibold">Update Status:</label>
                                        <select name="status" id="status" class="form-select mt-1 block w-full">
                                            <option value="Pending" {{ $negotiation->negoStatus === 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Approved" {{ $negotiation->negoStatus === 'Approved' ? 'selected' : '' }}>Approve</option>
                                            <option value="Disapproved" {{ $negotiation->negoStatus === 'Disapproved' ? 'selected' : '' }}>Disapprove</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 w-full">Submit</button>
                                </form>
                            @else
                                <button id="openModalButton" data-offer-amount="{{ $negotiation->offerAmount }}" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 w-full text-center">
                                    Click here to send details
                                </button>
                            @endif
                        </div>
                        <form id="myForm" action="{{ route('billing.store', ['negotiationID' => $negotiation->negotiationID]) }}" method="POST">
                        @csrf
                        <div id="detailsModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-sm w-full relative">
                            <button onclick="closeDetailsModal()" 
                                    class="absolute top-0 right-0 mt-2 mr-2 text-gray-600 text-xl z-10 
                                        hover:bg-gray-200 rounded-full h-8 w-8 flex items-center justify-center">
                                &times;
                            </button>
                                <h3 class="text-lg font-semibold mb-4">Send Details</h3>
                                <div class="mb-4">
                                    <label for="amountSent" class="block text-sm font-semibold">Amount Sent:</label>
                                    <input type="text" id="amountSent" name="amountSent" class="form-input mt-1 block w-full" disabled>
                                </div>
                                <div class="mb-4">
                                    <label for="taxPayment" class="block text-sm font-semibold">Tax Payment (10%):</label>
                                    <input type="text" id="taxPayment" name="taxPayment" class="form-input mt-1 block w-full" disabled>
                                </div>
                                <div class="mb-4">
                                    <label for="total" class="block text-sm font-semibold">Total:</label>
                                    <input type="text" id="total" name="total" class="form-input mt-1 block w-full" disabled>
                                </div>
                                <div class="mb-4">
                                    <label for="gcashNumber" class="block text-sm font-semibold">Gcash Number:</label>
                                    <input type="text" id="gcashNumber" name="gcashNumber" class="form-input mt-1 block w-full" placeholder="0911-222-3333" required>
                                </div>
                                <div class="mb-4">
                                    <h4 class="text-sm font-semibold">Terms and Conditions:</h4>
                                    <p class="text-xs text-gray-600 mt-2">
                                        The 10% tax deduction is applied to cover commission fees and other associated costs. This ensures that the transaction can proceed smoothly and all necessary charges are accounted for. The total amount reflects the final amount after the deduction of these fees.
                                    </p>
                                    <input type="checkbox" id="myCheckbox" name="myCheckbox" value="myCheckbox" required>
                                    <label for="myCheckbox"> I agree the terms and conditions</label><br>
                                </div>
                                <div class="flex justify-between mt-4">
                                    <button type="submit" id="agreeButton" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700">Submit</button>
                                </div>
                            </div>
                        </div> 
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    
    function closeDetailsModal() {
    document.getElementById('detailsModal').classList.add('hidden');
    }

    $(document).ready(function() {
        scrollToBottom(); // Immediately scroll to the bottom when the page is ready
    });

    // Fetch messages every 1 second
    setInterval(fetchMessages, 1000);

    document.getElementById('openModalButton').addEventListener('click', function() {
        const offerAmount = parseFloat(this.getAttribute('data-offer-amount'));
        const tax = offerAmount * 0.10;
        const total = offerAmount - tax;

        document.getElementById('amountSent').value = offerAmount.toFixed(2);
        document.getElementById('taxPayment').value = tax.toFixed(2);
        document.getElementById('total').value = total.toFixed(2);

        document.getElementById('detailsModal').classList.remove('hidden');
    });


    document.getElementById('agreeButton').addEventListener('click', function() {
        // Handle agree action here
        document.getElementById('detailsModal').classList.add('hidden');
    });

    document.getElementById('myForm').addEventListener('submit', function(event) {
            var checkbox = document.getElementById('myCheckbox');
            if (!checkbox.checked) {
                alert('You must agree to the terms and conditions.');
                event.preventDefault(); // Prevent form submission
            }
        });
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
</x-app-layout>
