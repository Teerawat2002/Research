<x-app-layout>
    <div class="mt-16 py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold">Welcome, {{ Auth::user()->name }}!</h3>
                    <p>{{ __("You're logged in!") }}</p>

                    <!-- Example Statistics Section -->
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="p-4 bg-blue-100 rounded shadow">
                            <h4 class="text-lg font-bold">Tasks</h4>
                            <p>You have 5 tasks pending.</p>
                        </div>
                        <div class="p-4 bg-green-100 rounded shadow">
                            <h4 class="text-lg font-bold">Meetings</h4>
                            <p>Next meeting: Tomorrow at 10:00 AM.</p>
                        </div>
                        <div class="p-4 bg-yellow-100 rounded shadow">
                            <h4 class="text-lg font-bold">Messages</h4>
                            <p>You have 2 unread messages.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
