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
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
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
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="relative">
                    <i class="fa-regular font-semibold fa-bell text-gray-500 hover:text-gray-700 cursor-pointer"></i>
                    <!-- Red dot label (initially hidden) -->
                    <span id="notification-dot" class="absolute top-0 right-0 inline-block w-2 h-2 bg-red-600 rounded-full" style="display: none;"></span>
                    <!-- Notification Dropdown (initially hidden) -->
                    <div id="notification-dropdown" class="border absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg py-2 z-50 hidden">
                        <div id="notification-list">
                            <p class="px-4 py-2 text-gray-800">No new notifications.</p>
                        </div>
                    </div>
                </div>
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
            <x-responsive-nav-link :href="route('space.business_details')" :active="request()->routeIs('space.business_details')">
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

    notificationDropdown.classList.add('w-96');

    // Fetch notifications via AJAX
    fetch('/notifications')  // Adjust this route to call your getNotifications method
        .then(response => response.json())
        .then(notifications => {
            // If there are notifications, display them in the dropdown
            if (notifications.length > 0) {
                notificationDot.style.display = 'inline-block'; // Show the red dot
                notificationList.innerHTML = ''; // Clear the "No new notifications" text

                // Append each notification to the list
                notifications.forEach(notification => {
                    // Create a div container for each notification
                    const notificationItem = document.createElement('div');
                    notificationItem.classList.add('flex', 'flex-col', 'w-full', 'px-4', 'py-2', 'text-gray-800', 'border-b', 'space-y-1');

                    // Create a span for the notification message based on the notification type
                    const notificationMessage = document.createElement('span');

                    // Define custom messages for each notification type
                    if (notification.notificationType === 'listing') {
                        notificationMessage.innerHTML = `<strong>${notification.user.firstName}</strong> has posted a new listing. See more about the listing.`;
                    } else if (notification.notificationType === 'negotiation') {
                        notificationMessage.innerHTML = `<strong>${notification.user.firstName}</strong> requested to negotiate your space. See more about the details.`;
                    } else if (notification.notificationType === 'feedback') {
                        notificationMessage.innerHTML = `<strong>${notification.user.firstName}</strong> gives a feedback to you. See more about the details.`;
                    } else if (notification.notificationType === 'payment') {
                        notificationMessage.innerHTML = `<strong>Admin</strong> already sent/paid the amount to you. See more about the details.`;
                    } else if (notification.notificationType === 'maintenance') {
                        notificationMessage.innerHTML = `<strong>Admin</strong> posted a new announcement. See more about the details.`;
                    } else if (notification.notificationType === 'listing_approval') {
                        notificationMessage.innerHTML = `${notification.description}`;
                    }

                    // Create a span for the date below the message
                    const notificationDate = document.createElement('span');
                    notificationDate.classList.add('text-gray-500', 'text-sm'); // Make the date faded and smaller
                    notificationDate.textContent = new Date(notification.created_at).toLocaleString(); // Format the date to a readable string

                    // Append the message and date to the notification item
                    notificationItem.appendChild(notificationMessage);
                    notificationItem.appendChild(notificationDate);

                    // Append the notification item to the list
                    notificationList.appendChild(notificationItem);
                });
            } else {
                notificationDot.style.display = 'none'; // Hide the red dot if no notifications
                notificationList.innerHTML = '<p class="px-4 py-2 text-gray-800">No new notifications.</p>';
            }
        })
        .catch(error => {
            console.error('Error fetching notifications:', error);
        });

    // Toggle the visibility of the dropdown when the notification icon is clicked
    notificationIcon.addEventListener('click', function () {
        notificationDropdown.classList.toggle('hidden');
    });

    // Optional: Hide the dropdown if clicked outside
    document.addEventListener('click', function (event) {
        if (!notificationIcon.contains(event.target) && !notificationDropdown.contains(event.target)) {
            notificationDropdown.classList.add('hidden');
        }
    });
});



</script>

