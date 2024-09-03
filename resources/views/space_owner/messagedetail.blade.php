<!-- resources/views/negotiations/show.blade.php -->
<title>Negotiation Details</title>
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
                <div class="w-full lg:w-1/3 p-4">
                    <h4 class="text-lg font-semibold mb-4">Amount Offered</h4>
                    <div class="bg-gray-100 p-4 rounded-lg mb-4">
                        <p class="text-2xl font-bold">P{{ number_format($negotiation->offerAmount, 2) }}</p>
                    </div>
                    <button class="bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700">Submit</button>
                </div>
            </div>
        </div>
    </div>
            <script src="{{ asset('js/app.js') }}"></script>
                <script>
                    function fetchMessages() {
                        $.ajax({
                            url: '{{ route("negotiation.reply", ["negotiationID" => $negotiation->negotiationID]) }}', // Ensure this route exists
                            method: 'GET',
                            success: function(data) {
                                updateChat(data);
                                scrollToBottom(); // Keep the chat box scrolled to the bottom
                            }
                        });
                    }

                    function updateChat(messages) {
                        let chatBox = $('.chat-box');
                        chatBox.empty(); // Clear the chat box

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

                    // Scroll to bottom on initial load
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
                                fetchMessages(); // Re-fetch messages after sending
                                $('input[name="message"]').val(''); // Clear the input field
                                scrollToBottom(); // Keep chat at the bottom
                            }
                        });
                    });
                </script>

</x-app-layout>
