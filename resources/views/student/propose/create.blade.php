<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto py-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Create New Proposal</h2>

                @if (session('success'))
                    <div
                        class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-800 dark:text-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('student.propose.store') }}">
                    @csrf

                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
                        <input type="text" name="title" id="title"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500"
                            required>
                        @error('title')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Objective -->
                    <div class="mb-4">
                        <label for="objective"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Objective</label>
                        <textarea name="objective" id="objective" rows="4"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500"
                            required></textarea>
                        @error('objective')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Scope -->
                    <div class="mb-4">
                        <label for="scope"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Scope</label>
                        <textarea name="scope" id="scope" rows="4"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500"
                            required></textarea>
                        @error('scope')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tools -->
                    <div class="mb-4">
                        <label for="tools"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tools</label>
                        <textarea type="text" name="tools" id="tools"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500">
                        </textarea>
                        @error('tools')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Advisor -->
                    <div class="mb-4">
                        <label for="a_id"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Advisor</label>
                        <select name="a_id" id="a_id"
                            class="block w-full mt-1 rounded-md shadow-sm border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600 dark:focus:ring-blue-500"
                            required>
                            <option value="" disabled selected>Select an Advisor</option>
                            @foreach ($advisors as $advisor)
                                <option value="{{ $advisor->id }}">{{ $advisor->a_fname }} {{ $advisor->a_lname }}</option>
                            @endforeach
                        </select>
                        @error('a_id')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit"
                            class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-md focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-blue-500 dark:hover:bg-blue-600">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
