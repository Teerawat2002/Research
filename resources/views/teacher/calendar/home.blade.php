<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-white">
                        Calendar
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border border-gray-300 dark:border-gray-700">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3 border border-gray-300 dark:border-gray-600">Date</th>
                                    <th scope="col" class="px-6 py-3 border border-gray-300 dark:border-gray-600">Task</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($calendarData as $data)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <!-- Date range -->
                                        {{-- <td class="px-6 py-4 border border-gray-300 dark:border-gray-600">
                                            {{ $data->start_date }} - {{ $data->end_date }}
                                        </td> --}}
                                        <td class="px-6 py-4 border border-gray-300 dark:border-gray-600">
                                            {{ \Carbon\Carbon::parse($data->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($data->end_date)->format('d/m/Y') }}
                                        </td>
                                        
                                        <!-- Description -->
                                        <td class="px-6 py-4 border border-gray-300 dark:border-gray-600">
                                            <div class="font-medium text-gray-900 dark:text-white">{{ $data->title }}</div>
                                            <div class="text-gray-500 dark:text-gray-400">{{ $data->description }}</div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 text-center border border-gray-300 dark:border-gray-600" colspan="2">
                                            No data found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
