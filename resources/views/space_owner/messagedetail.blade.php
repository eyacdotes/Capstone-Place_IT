<!-- resources/views/space_owner/messagedetail.blade.php -->
<title>Space Owner Negotiation Details</title>
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
                        <div class="space-y-4 overflow-y-auto flex-1 chat-box" x-data="chatApp()">
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
                        <form action="{{ route('negotiation.reply', ['negotiationID' => $negotiation->negotiationID]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="flex items-center mt-4 space-x-2">
                                <input type="file" name="aImage" class="flex-shrink-0 w-52">
                                <input type="text" name="message" class="flex-grow p-2 border rounded-lg" placeholder="Type your message...">
                                <button type="submit" class="bg-blue-600 text-white p-2 rounded-lg hover:bg-blue-700">Send</button>
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
        }

        function scrollToBottom() {
            let chatBox = $('.chat-box');
            chatBox.animate({ scrollTop: chatBox.prop("scrollHeight") }, 300);
        }

        function openModal(imageSrc) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        scrollToBottom();

        // Fetch messages every 5 seconds
        setInterval(fetchMessages, 5000);
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
