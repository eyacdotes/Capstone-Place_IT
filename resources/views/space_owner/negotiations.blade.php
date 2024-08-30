<!-- resources/views/space_owner/negotiations.blade.php -->
<title>Negotiations</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Negotiations') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="max-w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h3 class="text-lg font-bold mb-4">Active Negotiations</h3>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-orange-400 text-white">
                                <th class="px-6 py-4">Space Title</th>
                                <th class="px-6 py-4">Business Owner</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add logic to fetch and display negotiations -->
                            <tr class="hover:bg-opacity-75">
                                <td class="px-6 py-4 bg-gray-100">Example Space</td>
                                <td class="px-6 py-4 bg-gray-100">John Doe</td>
                                <td class="px-6 py-4 bg-gray-100">Pending</td>
                                <td class="px-6 py-4 bg-gray-100">
                                    <a href="#" class="text-blue-500 hover:underline">View Details</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
