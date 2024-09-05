<!-- resources/views/business_owner/messagedetail.blade.php -->
<title>Business Owner Negotiation Details</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Negotiation Details') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="bg-white shadow-lg rounded-lg overflow-hidden w-full max-w-7xl">
            <div class="flex flex-col lg:flex-row h-auto lg:h-96">
                <!-- Chat Section -->
                <div class="w-full lg:w-2/3 p-4 border-b lg:border-b-0 lg:border-r border-gray-300">
                    <div class="h-full flex flex-col justify-between">
                        <!-- Messages Section -->
                        <div class="space-y-4 overflow-y-auto flex-1 chat-box">
                            @foreach($negotiation->replies as $reply)
                                <div class="flex {{ $reply->senderID == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                    <div class="p-4 rounded-lg shadow-lg {{ $reply->senderID == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200' }}">
                                        <p class="text-sm">{{ $reply->message }}</p>
                                        <small class="text-xs">{{ $reply->created_at->format('h:i A') }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Message Input -->
                        <form action="{{ route('negotiation.reply', ['negotiationID' => $negotiation->negotiationID]) }}" method="POST">
                            @csrf
                            <div class="flex items-center mt-4">
                                <input type="text" name="message" class="w-full p-2 border rounded-lg" placeholder="Type your message..." required>
                                <button type="submit" class="bg-blue-600 w-24 text-white p-2 ml-2 rounded-lg hover:bg-blue-700">Send</button>
                            </div>
                        </form>                             
                    </div>
                </div>

                <!-- Negotiation Details Section -->
                <div class="w-full lg:w-1/3 p-4 border-t lg:border-t-0 lg:border-l border-gray-300">
                    <!-- Amount and Status Section -->
                    <div class="flex justify-between items-center mb-4">
                        <div>
                            <h4 class="text-lg font-semibold">Amount Offered</h4>
                            <input class="text-2xl bg-gray-100 rounded-md w-40 font-bold" value="P{{ number_format($negotiation->offerAmount, 2) }}"></input>
                        </div>
                        <div class="text-right mb-6">
                        <h4 class="text-lg font-semibold pr-2">Status</h4>
                        <span class=" 
                                                    {{ $negotiation->negoStatus === 'Approve' ? 'text-xl font-bold text-green-600' : '' }}
                                                    {{ $negotiation->negoStatus === 'Pending' ? 'text-xl font-bold text-blue-600' : '' }}
                                                    {{ $negotiation->negoStatus === 'Disapprove' || $negotiation->negoStatus === 'Another Term' ? 'text-xl font-bold text-red-600' : '' }}
                                                    font-bold">
                                                    {{ $negotiation->negoStatus }}
                            </span>
                        </div>
                    </div>

                    <!-- Form Section for Rental Term, Start Date, End Date -->
                    <form action="{{ route('negotiation.rentAgree', ['negotiationID' => $negotiation->negotiationID]) }}" method="POST">
                    @csrf
                        <input type="hidden" name="ownerID" value="{{ $negotiation->listing->ownerID }}">
                        <input type="hidden" name="renterID" value="{{ $negotiation->senderID }}">
                        <input type="hidden" name="listingID" value="{{ $negotiation->listingID }}">
                        <!-- Rental Term -->
                        <div class="flex flex-col">
                            <label for="rentalTerm" class="block font-semibold text-gray-700">Rental Term:</label>
                            <select class="p-2 border border-gray-300 rounded-lg" name="rentalTerm" id="rentalTerm">
                                <option value="">Choose...</option>
                                <option value="weekly">Weekly</option>
                                <option value="monthly">Monthly</option>
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div class="flex flex-col">
                            <label for="startDate" class="block mb-2 font-semibold text-gray-700">Start Date:</label>
                            <input type="date" name="startDate" id="startDate" class="p-2 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- End Date -->
                        <div class="flex flex-col">
                            <label for="endDate" class="block mb-2 font-semibold text-gray-700">End Date:</label>
                            <input type="date" name="endDate" id="endDate" class="mb-2 p-2 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Hidden Fields for offerAmount -->
                        <input type="hidden" name="offerAmount" value="{{ $negotiation->offerAmount }}">

                        <!-- Submit Button -->
                        <button type="submit" class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 w-full">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        function fetchMessages() {
            $.ajax({
                url: '{{ route("negotiation.reply", ["negotiationID" => $negotiation->negotiationID]) }}',
                method: 'GET',
                success: function(data) {
                    updateChat(data);
                    scrollToBottom(); // Keep the chat box scrolled to the bottom
                }
            });
        }

        function updateChat(messages) {
            let chatBox = $('.chat-box');
            chatBox.empty();

            messages.forEach(function(message) {
                let messageHtml = `
                    <div class="flex ${message.senderID == {{ Auth::id() }} ? 'justify-end' : 'justify-start'}">
                        <div class="p-4 rounded-lg shadow-lg ${message.senderID == {{ Auth::id() }} ? 'bg-blue-500 text-white' : 'bg-gray-200'}">
                            <p class="text-sm">${message.message}</p>
                            <small class="text-xs">${new Date(message.created_at).toLocaleTimeString()}</small>
                        </div>
                    </div>
                `;
                chatBox.append(messageHtml);
            });
        }

        function scrollToBottom() {
            let chatBox = $('.chat-box');
            chatBox.animate({ scrollTop: chatBox.prop("scrollHeight") }, 300);
        }

        scrollToBottom();

        // Fetch messages every 5 seconds
        setInterval(fetchMessages, 5000);

        // Handle form submission
        $('form').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    fetchMessages();
                    $('input[name="message"]').val(''); // Clear the input field
                    scrollToBottom();
                }
            });
        });
    </script>

</x-app-layout>
