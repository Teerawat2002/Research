<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto py-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Approve Proposal</h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('advisor.propose.approve', $proposal->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- Group Members -->
                    <div class="mb-6">
                        <label class="block text-md font-medium text-gray-700 dark:text-gray-300">Group Members</label>
                        <ul class="list-disc ml-5 mt-2">
                            @forelse ($groupMembers as $member)
                                <li class="text-gray-900 dark:text-white">{{ $member->student->name ?? 'Unknown Student' }}</li>
                            @empty
                                <li class="text-gray-500">No members in this group.</li>
                            @endforelse
                        </ul>
                    </div>

                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" id="title" value="{{ $proposal->title }}"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>
                    </div>

                    <!-- Objective -->
                    <div class="mb-4">
                        <label for="objective"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Objective</label>
                        <textarea id="objective" rows="4"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>{{ $proposal->objective }}</textarea>
                    </div>

                    <!-- Tools -->
                    <div class="mb-4">
                        <label for="tools"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tools</label>
                        <textarea id="tools" rows="3"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                            disabled>{{ $proposal->tools }}</textarea>
                    </div>

                    <!-- Approval Checkbox -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Approval</label>
                        <div class="flex items-center space-x-4 mt-2">
                            <label class="flex items-center">
                                <input type="radio" name="approval" value="approved" id="approved"
                                    class="text-blue-500 focus:ring-blue-500">
                                <span class="ml-2 text-gray-900 dark:text-white">Approve</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="approval" value="rejected" id="rejected"
                                    class="text-red-500 focus:ring-red-500">
                                <span class="ml-2 text-gray-900 dark:text-white">Reject</span>
                            </label>
                        </div>
                        @error('approval')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rejection Reason -->
                    <div class="mb-4 hidden" id="rejection-reason">
                        <label for="reason" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Reason
                            for Rejection</label>
                        <textarea name="reason" id="reason" rows="4"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"></textarea>
                        @error('reason')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 dark:bg-blue-500 dark:hover:bg-blue-600">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Toggle Textarea Visibility -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rejectedRadio = document.getElementById('rejected');
            const approvedRadio = document.getElementById('approved');
            const rejectionReason = document.getElementById('rejection-reason');

            rejectedRadio.addEventListener('change', () => {
                rejectionReason.classList.remove('hidden');
            });

            approvedRadio.addEventListener('change', () => {
                rejectionReason.classList.add('hidden');
            });
        });
    </script>
</x-app-layout>
