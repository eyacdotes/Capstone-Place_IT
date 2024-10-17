<!-- resources/views/admin/dashboard.blade.php -->
<title>Admin Dashboard</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Statistics Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
                <!-- Users Card -->
                <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800">Total Users</h3>
                    <p class="mt-2 text-3xl font-semibold">{{ $userCount }}</p>
                    <p class="text-gray-500">All registered users.</p>
                </div>
                
                <!-- Listings Card -->
                <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800">Total Listings</h3>
                    <p class="mt-2 text-3xl font-semibold">{{ $listingCount }}</p>
                    <p class="text-gray-500">Total active listings.</p>
                </div>

                <!-- Verified Users Card -->
                <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800">Verified Users</h3>
                    <p class="mt-2 text-3xl font-semibold">{{ $verifiedUsersCount }}</p>
                    <p class="text-gray-500">Verified user accounts.</p>
                </div>

                <!-- Space Owners Card -->
                <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800">Space Owners</h3>
                    <p class="mt-2 text-3xl font-semibold">{{ $spaceOwnersCount }}</p>
                    <p class="text-gray-500">Total space owners registered.</p>
                </div>

                <!-- Business Owners Card -->
                <div class="bg-white border border-gray-200 rounded-lg shadow p-6">
                    <h3 class="text-xl font-bold text-gray-800">Business Owners</h3>
                    <p class="mt-2 text-3xl font-semibold">{{ $businessOwnersCount }}</p>
                    <p class="text-gray-500">Total business owners registered.</p>
                </div>
            </div>

            <!-- Listing Management Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-800">Listing Management</h3>
                    <p class="text-gray-500 mb-4">Manage all active listings</p>
                    <a href="{{ route('admin.listingmanagement') }}" class="text-indigo-600 hover:underline">View All Listings</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
