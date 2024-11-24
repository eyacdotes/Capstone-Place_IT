<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-6 sm:-my-px sm:ml-12 sm:flex">
                    <x-nav-link :href="route('space.dashboard')"  class="ajax-link" :active="request()->routeIs('space.dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('space.newspaces')"  class="ajax-link" :active="request()->routeIs('space.newspaces')">
                        {{ __('Post New Spaces') }}
                    </x-nav-link>
                    <x-nav-link :href="route('space.negotiations')"  class="ajax-link" :active="request()->routeIs('space.negotiations')">
                        {{ __('Negotiations') }}
                    </x-nav-link>
                    <x-nav-link :href="route('space.reviews')"  class="ajax-link" :active="request()->routeIs('space.reviews')">
                        {{ __('Feedback') }}
                    </x-nav-link>
                    <x-nav-link :href="route('space.business_details')"  class="ajax-link" :active="request()->routeIs('space.business_details')">
                        {{ __('Payment') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center space-x-4">
                <!-- Notification Icon -->
                <div class="relative">
                    <i class="fa-regular fa-bell font-semibold text-gray-500 hover:text-orange-500 cursor-pointer"></i>
                    <!-- Red dot for new notifications -->
                    <span id="notification-dot" class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full" style="display: none;"></span>
                    <!-- Notification Dropdown -->
                    <div id="notification-dropdown" class="border absolute right-0 mt-1 w-96 bg-white rounded-md shadow-lg py-2 z-50 hidden"  style="right: -50px;">
                        <h2 class="px-4 py-2 text-lg font-semibold text-gray-800 border-b">Notifications</h2>
                        <div id="notification-list" class="max-h-80">
                            <p class="px-4 py-2 text-gray-800">No new notifications.</p>
                        </div>
                        <button id="see-previous-btn" class="px-4 py-2 w-full text-center text-blue-600 hover:bg-gray-100 hidden">See previous notifications</button>
                    </div>
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->firstName }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('space.dashboard')" :active="request()->routeIs('space.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('space.newspaces')" :active="request()->routeIs('space.newspaces')">
                {{ __('Post New Spaces') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('space.negotiations')" :active="request()->routeIs('space.negotiations')">
                {{ __('Negotiations') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('space.reviews')" :active="request()->routeIs('space.reviews')">
                {{ __('Feedback') }}
            </x-responsive-nav-link>
        </div>
        

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const notificationIcon = document.querySelector('.fa-bell');
        const notificationDropdown = document.getElementById('notification-dropdown');
        const notificationDot = document.getElementById('notification-dot');
        const notificationList = document.getElementById('notification-list');
        const seePreviousBtn = document.getElementById('see-previous-btn');

        let offset = 0;
        let hasPrevious = false;

        // Fetch notifications via AJAX
        function loadNotifications() {
    fetch(`/notifications?offset=${offset}&limit=8`)
        .then(response => response.json())
        .then(data => {
            const unreadNotifications = data.filter(notification => notification.read_at === null);

            // Show or hide red dot based on unread notifications
            if (unreadNotifications.length > 0) {
                notificationDot.style.display = 'inline-block';  // Show the red dot
            } else {
                notificationDot.style.display = 'none';  // Hide the red dot if no unread notifications
            }
            if (data.length > 0) {
                if (offset === 0) {
                    notificationList.innerHTML = ''; // Clear placeholder on first load
                }

                data.forEach(notification => {
                    const notificationLink = document.createElement('a');
                    notificationLink.classList.add('block', 'px-4', 'py-2', 'text-gray-800', 'hover:bg-gray-100', 'cursor-pointer');

                    // Set background based on read status
                    if (notification.read_at === null) {
                        notificationLink.classList.add('bg-gray-200'); // Unread - gray background
                    } else {
                        notificationLink.classList.add('bg-white'); // Read - white background
                    }

                    notificationLink.href = getNotificationUrl(notification);
                    notificationLink.setAttribute('data-id', notification.notificationID);

                    // Add click event for marking as read and redirect
                    notificationLink.addEventListener('click', function (event) {
                        event.preventDefault();
                        const url = this.href;
                        const notificationId = this.getAttribute('data-id');
                        markAsRead(notificationId, url);
                    });
                    
                    const notificationMessage = document.createElement('div');
                    // Customize the message based on notification type
                    if (notification.type === 'listing_approved') {
                        notificationMessage.innerHTML = 'Your listing <strong>' + notification.data +'</strong> has been approved.';
                    } else if (notification.type === 'listing_disapproved') {
                        notificationMessage.innerHTML = 'Your listing <strong>' + notification.data +'</strong> has been disapproved.';
                    } else if (notification.type === 'payment') {
                        notificationMessage.textContent = 'You received a payment.';
                    } else if (notification.type === 'maintenance') {
                        notificationMessage.textContent = notification.data;
                    }else if (notification.type === 'feedback') {
                        notificationMessage.textContent = notification.data;
                    }else if (notification.type === 'follow-up') {
                        notificationMessage.textContent = notification.data;
                    }else if (notification.type === 'message') {
                        const data = JSON.parse(notification.data); // Parse the notification data to extract senderName
                        const senderName = data.senderName || 'Unknown sender'; // Default to 'Unknown sender' if no name is available
                        notificationMessage.innerHTML = `You have a new message from <strong> ${senderName}. </strong>`;
                    }else if (notification.type === 'maintenance') {
                        notificationMessage.textContent = notification.data;
                    }else if (notification.type === 'negotiation') {
                        notificationMessage.innerHTML = 'Someone wants to negotiate your space: <strong>' + notification.data + '</strong>.';
                    } else if (notification.type === 'payment_sent') {
                        notificationMessage.innerHTML = notification.data;
                    } else if (notification.type === 'payment_confirmed') {
                        notificationMessage.innerHTML = 'Renter ' + '<strong>' + notification.data + '</strong> has sent a payment confirmed by the admin.';
                    } else if (notification.type === 'listing') {
                        notificationMessage.innerHTML = 'Your listing ' + '<strong>' + notification.data + '</strong> has beed monitored.';
                    } else {
                        notificationMessage.textContent = notification.description;  // Default message
                    }

                    const notificationDate = document.createElement('span');
                    notificationDate.classList.add('text-gray-400', 'text-sm');
                    notificationDate.textContent = new Date(notification.created_at).toLocaleString();

                    notificationLink.appendChild(notificationMessage);
                    notificationLink.appendChild(notificationDate);

                    notificationList.appendChild(notificationLink);
                });

                // Show "See previous notifications" button if there are more notifications
                if (data.length === 8) {
                    seePreviousBtn.style.display = 'block';
                    hasPrevious = true; // Previous notifications exist
                } else {
                    seePreviousBtn.style.display = 'none';
                    hasPrevious = false; // No previous notifications
                }

                offset += data.length; // Increase the offset
            } else if (offset === 0) {
                notificationList.innerHTML = '<p class="px-4 py-2 text-gray-800">No new notifications.</p>';
            }
        })
        .catch(error => console.error('Error loading notifications:', error));
}


            // Event listener for "See previous notifications" button
            seePreviousBtn.addEventListener('click', function () {
                // Enable scrolling when this button is clicked
                notificationList.classList.add('max-h-96');
                notificationList.style.overflowY = 'auto'; // Allow scrolling
                loadNotifications();
            });

            // Show/hide the dropdown on bell icon click
            notificationIcon.addEventListener('click', function () {
                notificationDropdown.classList.toggle('hidden');
                // Reset icon color if dropdown is closed
                if (notificationDropdown.classList.contains('hidden')) {
                    notificationIcon.classList.remove('text-orange-500'); // Remove highlight if dropdown is closed
                } else if (hasPrevious) {
                    // Reset the overflow property when dropdown is opened again
                    notificationList.classList.remove('max-h-96');
                    notificationList.style.overflowY = 'hidden'; // Disable scrolling until button is clicked
                }
            });

            // Hide dropdown on outside click
            document.addEventListener('click', function (event) {
                if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
                    notificationDropdown.classList.add('hidden');
                    notificationIcon.classList.remove('text-orange-500'); // Remove highlight if clicked outside
                }
            });

            // Mark as read function
            function markAsRead(notificationId, redirectUrl) {
                fetch(`/notifications/${notificationId}/read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => window.location.href = redirectUrl)
                .catch(error => console.error('Error marking notification as read:', error));
            }

        // Function to generate the notification URL based on type
        function getNotificationUrl(notification) {
            const baseNegotiationUrl = '/space/negotiations';

            if (notification.type === 'listing_approved') {
                return '/space/dashboard';  // Adjust to the correct URL where the space owner manages listings
            } else if (notification.type === 'payment_sent') {
                return '/space/payment';  // Adjust to the payment-related page
            } else if (notification.type === 'payment') {
                return '/space/payment';  // Adjust to the payment-related page
            } else if (notification.type === 'message' || notification.type === 'negotiation') {
                let data;
                
                // Try to parse the notification data if it's valid JSON
                try {
                    data = JSON.parse(notification.data);
                } catch (e) {
                    console.error('Error parsing notification data:', e);
                    return baseNegotiationUrl;  // Return a default URL if parsing fails
                }

                // If the negotiationID exists, redirect to the specific negotiation
                if (data && data.negotiationID) {
                    return `${baseNegotiationUrl}/${data.negotiationID}`;
                } else {
                    return baseNegotiationUrl;  // Return the base negotiations URL if no negotiationID
                }
            } else if (notification.type === 'listing_disapproved') {
                return '/space/dashboard';
            } else if (notification.type === 'payment_confirmed') {
                return '/space/negotiations';
            }
            return '/space/dashboard';  // Default URL
        }
        loadNotifications();
    });
</script>

