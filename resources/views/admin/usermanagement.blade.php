<title>Admin User Management</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Total Registered Users: {{ $userCount }}</h3>
                    
                    @if($users->isEmpty())
                        <p class="text-gray-500">No users found.</p>
                    @else
                        <table class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">ID</th>
                                    <th class="py-2 px-4 border-b">First Name</th>
                                    <th class="py-2 px-4 border-b">Last Name</th>
                                    <th class="py-2 px-4 border-b">Email</th>
                                    <th class="py-2 px-4 border-b">Role</th>
                                    <th class="py-2 px-4 border-b">Verified</th>
                                    <th class="py-2 px-4 border-b">Created At</th>
                                    <th class="py-2 px-4 border-b">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="py-2 px-4 border-b">{{ $user->userID }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->firstName }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->lastName }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->email }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->role }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->isVerified ? 'Yes' : 'No' }}</td>
                                        <td class="py-2 px-4 border-b">{{ $user->created_at->format('Y-m-d') }}</td>
                                        <td class="py-2 px-4 border-b">
                                            <a href="#" class="text-blue-600 hover:text-blue-900">View</a>
                                            <a href="#" class="ml-2 text-green-600 hover:text-green-900">Edit</a>
                                            <form method="POST" action="#" class="inline-block ml-2">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
