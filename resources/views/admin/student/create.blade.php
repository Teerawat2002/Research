<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-white">Create Student</h3>

                    <form method="POST" action="{{ route('admin.student.store') }}" class="mt-6">
                        @csrf

                        <!-- Student ID -->
                        <div class="mb-4">
                            <label for="s_id" class="block text-sm font-medium text-white">Student ID</label>
                            <input type="text" id="s_id" name="s_id" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                            @error('s_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- First Name -->
                        <div class="mb-4">
                            <label for="s_fname" class="block text-sm font-medium text-white">First Name</label>
                            <input type="text" id="s_fname" name="s_fname" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                            @error('s_fname')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Last Name -->
                        <div class="mb-4">
                            <label for="s_lname" class="block text-sm font-medium text-white">Last Name</label>
                            <input type="text" id="s_lname" name="s_lname" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                            @error('s_lname')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-white">Password</label>
                            <input type="password" id="password" name="password" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                            @error('password')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm
                                Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- Major -->
                        <div class="mb-4">
                            <label for="m_id" class="block text-sm font-medium text-gray-700">Major</label>
                            <select id="m_id" name="m_id" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                                <option value="" disabled selected>Select Major</option>
                                @foreach ($majors as $major)
                                    <option value="{{ $major->id }}">{{ $major->m_name }}</option>
                                @endforeach
                            </select>
                            @error('m_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Academic Year -->
                        <div class="mb-4">
                            <label for="ac_id" class="block text-sm font-medium text-white">Academic Year</label>
                            <select id="ac_id" name="ac_id" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                                <option value="" disabled selected>Select Academic Year</option>
                                @foreach ($academicYears as $year)
                                    <option value="{{ $year->id }}">{{ $year->year }}</option>
                                @endforeach
                            </select>
                            @error('ac_id')
                                <p class="text-red-500 text-sm">{{ $message }}</p>
                            @enderror
                        </div>


                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit"
                                class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">
                                Create Student
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
