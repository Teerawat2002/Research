<x-app-layout>
    <div class="mt-16 py-8">
        <div class="p-6 text-gray-900">
            <div class="max-w-md mx-auto bg-gray-50 dark:bg-gray-800 p-6 shadow-lg rounded-lg">
                <h1 class="text-2xl text-white font-bold mb-4">Create Major</h1>
                @if ($errors->any())
                    <div class="mb-4">
                        <ul class="text-red-500 list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.major.store') }}" method="POST" class="max-w-sm mx-auto">
                    @csrf

                    <!-- Major Name -->
                    <label for="m_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Major Name</label>
                    <div class="flex">
                        <span
                            class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                            <!-- Updated icon for Major Name -->
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 10a8 8 0 1 1 16 0 8 8 0 0 1-16 0Zm8-3a1 1 0 1 0 0 2 1 1 0 0 0 0-2Zm0 4a1 1 0 0 0-1 1v2a1 1 0 1 0 2 0v-2a1 1 0 0 0-1-1Z" />
                            </svg>
                        </span>
                        <input type="text" id="m_name" name="m_name"
                            class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="เช่น Computer Science" required value="{{ old('m_name') }}">
                    </div>

                    <div class="mt-4 flex justify-end">
                        <a class="button px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700"
                            href="{{ route('admin.major.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Cancel</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
