<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('UMKM Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mb-6">
                        <a href="{{ route('umkm.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Back to UMKMs
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Owner</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $umkm->owner }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name of
                                UMKM</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $umkm->nama_umkm }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email
                                (UMKM)</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $umkm->email_umkm ?? 'Not provided' }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number
                                (UMKM)</label>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ $umkm->nomor_handphone_umkm ?? 'Not provided' }}</p>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $umkm->alamat }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">City</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $umkm->kota }}</p>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Province</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $umkm->provinsi }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Establishment
                                Year</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $umkm->tahun_berdiri }}</p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('umkm.edit', $umkm) }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Edit UMKM
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>