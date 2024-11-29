<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-white">Create Student Group</h3>

                    <form method="POST" action="{{ route('student.group.store') }}" class="mt-6">
                        @csrf

                        <!-- Student Selection -->
                        <div class="mb-4">
                            <label for="students" class="block text-sm font-medium text-white">Select Students</label>
                            <select name="students[]" id="students" 
                                class="w-full mt-2 p-2 border rounded-md focus:ring focus:ring-blue-500 focus:outline-none" 
                                multiple>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}">
                                        {{ $student->s_fname }} {{ $student->s_lname }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-gray-300">Hold down the Ctrl (Windows) / Command (Mac) button to select multiple students.</small>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit"
                                class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">
                                Create Group
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
