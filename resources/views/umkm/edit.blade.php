<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit UMKM') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="list-disc list-inside text-red-600 dark:text-red-400">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('umkm.update', $umkm) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name of
                                UMKM</label>
                            <input type="text" name="nama_umkm"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('nama_umkm', $umkm->nama_umkm) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email
                                (UMKM)</label>
                            <input type="email" name="email_umkm"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('email_umkm', $umkm->email_umkm) }}">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Isi jika UMKM memiliki email khusus
                            </p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number
                                (UMKM)</label>
                            <input type="text" name="nomor_handphone_umkm"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('nomor_handphone_umkm', $umkm->nomor_handphone_umkm) }}">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Isi jika UMKM memiliki nomor
                                handphone khusus</p>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                            <textarea name="alamat"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required>{{ old('alamat', $umkm->alamat) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">City</label>
                            <input type="text" name="kota"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('kota', $umkm->kota) }}" required>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Province</label>
                            <input type="text" name="provinsi"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('provinsi', $umkm->provinsi) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Establishment
                                Year</label>
                            <input type="number" name="tahun_berdiri"
                                class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                value="{{ old('tahun_berdiri', $umkm->tahun_berdiri) }}" min="1900"
                                max="{{ date('Y') }}" required>
                        </div>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>