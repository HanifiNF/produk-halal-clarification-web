<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h1 class="text-2xl font-bold mb-6">User Details</h1>

                    <div class="bg-white dark:bg-gray-700 shadow overflow-hidden sm:rounded-lg">
                        <div class="px-4 py-5 sm:px-6">
                            <div class="grid grid-cols-1 gap-4">
                                <p><span class="font-semibold">ID:</span> {{ $user->id }}</p>
                                <p><span class="font-semibold">Name:</span> {{ $user->name }}</p>
                                <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                                <p><span class="font-semibold">Phone Number:</span> {{ $user->phone_number ?? 'N/A' }}
                                </p>
                                <p><span class="font-semibold">Admin:</span> {{ $user->admin ? 'Yes' : 'No' }}</p>
                                <p><span class="font-semibold">Data Access:</span>
                                    {{ $user->data_access ? 'Yes' : 'No' }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('users.index') }}"
                        class="mt-6 inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        Back to users
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>