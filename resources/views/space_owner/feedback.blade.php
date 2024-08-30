<!-- resources/views/space_owner/feedbacks.blade.php -->
<title>Feedbacks</title>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Feedbacks') }}
        </h2>
    </x-slot>

    <div class="w-full py-6 flex justify-center">
        <div class="max-w-auto mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h3 class="text-lg font-bold mb-4">User Feedbacks</h3>
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-orange-400 text-white">
                                <th class="px-6 py-4">Space Title</th>
                                <th class="px-6 py-4">Feedback</th>
                                <th class="px-6 py-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Add logic to fetch and display feedbacks -->
                            <tr class="hover:bg-opacity-75">
                                <td class="px-6 py-4 bg-gray-100">Example Space</td>
                                <td class="px-6 py-4 bg-gray-100">Great location and easy process!</td>
                                <td class="px-6 py-4 bg-gray-100">2024-08-30</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
