<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-white">Proposals</h3>

                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-6">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">No.</th>
                                    <th scope="col" class="px-6 py-3">Title</th>
                                    <th scope="col" class="px-6 py-3">Group</th>
                                    <th scope="col" class="px-6 py-3">Advisor</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($proposals as $proposal)
                                    <tr
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $proposal->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $proposal->group_id }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $proposal->advisor->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @switch($proposal->status)
                                                @case(0)
                                                    <span class="text-green-500">Proposal complete</span>
                                                @break

                                                @case(1)
                                                    <span class="text-yellow-500">Waiting for approval</span>
                                                @break

                                                @case(2)
                                                    <span class="text-red-500">Rejected</span>
                                                @break

                                                @default
                                                    <span class="text-gray-500">Unknown status</span>
                                            @endswitch
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('advisor.propose.approveView', $proposal->id) }}"
                                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 text-center" colspan="6">
                                            No proposals found.
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
