<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8"> <!-- Reduced the container width -->
            <div class="bg-gray-50 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold text-white">Create Advisor</h3>

                    <form method="POST" action="{{ route('admin.advisor.store') }}" class="mt-6">
                        @csrf

                        <!-- Advisor ID -->
                        <div class="mb-4">
                            <label for="a_id" class="block text-sm font-medium text-white">Advisor ID</label>
                            <input type="text" id="a_id" name="a_id" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- First Name -->
                        <div class="mb-4">
                            <label for="a_fname" class="block text-sm font-medium text-white">First Name</label>
                            <input type="text" id="a_fname" name="a_fname" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- Last Name -->
                        <div class="mb-4">
                            <label for="a_lname" class="block text-sm font-medium text-white">Last Name</label>
                            <input type="text" id="a_lname" name="a_lname" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="block text-sm font-medium text-white">Password</label>
                            <input type="password" id="password" name="password" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="block text-sm font-medium text-white">Confirm
                                Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                        </div>

                        <!-- Advisor Type -->
                        <div class="mb-4">
                            <label for="a_type" class="block text-sm font-medium text-white">Advisor Type</label>
                            <select id="a_type" name="a_type" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                                <option value="advisor">Advisor</option>
                                <option value="teacher">Teacher</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <!-- Major -->
                        <div class="mb-4">
                            <label for="m_id" class="block text-sm font-medium text-white">Major</label>
                            <select id="m_id" name="m_id" required
                                class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border rounded-md focus:border-blue-400 focus:ring-blue-300 focus:outline-none focus:ring focus:ring-opacity-40">
                                <option value="" disabled selected>Select Major</option>
                                @foreach ($majors as $major)
                                    <option value="{{ $major->id }}">{{ $major->m_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="mb-4">
                            <button type="submit"
                                class="w-full px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:bg-blue-700 focus:outline-none">
                                Create Advisor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
