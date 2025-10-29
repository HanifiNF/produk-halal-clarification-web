<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create User') }}
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

                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Name</label>
                                <input type="text" name="name"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('name') }}" required>
                            </div>
                            <div class="mb-4">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                                <input type="email" name="email"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('email') }}" required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone
                                    Number</label>
                                <input type="text" name="phone_number"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('phone_number') }}">
                            </div>
                            <div class="mb-4">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Password</label>
                                <input type="password" name="password"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    required>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">UMKM
                                    Name</label>
                                <input type="text" name="nama_umkm"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('nama_umkm') }}">
                            </div>
                            <div class="mb-4">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                                <input type="text" name="address"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('address') }}">
                            </div>
                            <div class="mb-4">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">City</label>
                                <input type="text" name="city"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('city') }}">
                            </div>
                            <div class="mb-4">
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Province</label>
                                <input type="text" name="province"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('province') }}">
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Establish
                                    Year</label>
                                <input type="number" name="establish_year"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('establish_year') }}" min="1900" max="{{ date('Y') }}">
                            </div>
                        </div>
                        @if(Auth::user()->admin)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Data
                                    Access</label>
                                <div class="flex items-center mb-2">
                                    <input type="radio" name="data_access" id="data_access_yes" value="1"
                                        class="rounded text-indigo-600 shadow-sm" {{ old('data_access') ? 'checked' : '' }}>
                                    <label for="data_access_yes" class="ml-2 text-gray-700 dark:text-gray-300">Yes</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="data_access" id="data_access_no" value="0"
                                        class="rounded text-indigo-600 shadow-sm" {{ !old('data_access') ? 'checked' : '' }}>
                                    <label for="data_access_no" class="ml-2 text-gray-700 dark:text-gray-300">No</label>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Pembina</label>
                                <select name="pembina" 
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                    <option value="">-- Pilih Pembina --</option>
                                    <option value="Pembina A" {{ old('pembina') == 'Pembina A' ? 'selected' : '' }}>Pembina A</option>
                                    <option value="Pembina B" {{ old('pembina') == 'Pembina B' ? 'selected' : '' }}>Pembina B</option>
                                    <option value="Pembina C" {{ old('pembina') == 'Pembina C' ? 'selected' : '' }}>Pembina C</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status
                                    Pembina</label>
                                <div class="flex items-center mb-2">
                                    <input type="radio" name="status_pembina" id="status_pembina_yes" value="1"
                                        class="rounded text-indigo-600 shadow-sm" {{ old('status_pembina') == '1' ? 'checked' : '' }}>
                                    <label for="status_pembina_yes" class="ml-2 text-gray-700 dark:text-gray-300">Yes</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="status_pembina" id="status_pembina_no" value="0"
                                        class="rounded text-indigo-600 shadow-sm" {{ old('status_pembina') !== '1' ? 'checked' : '' }}>
                                    <label for="status_pembina_no" class="ml-2 text-gray-700 dark:text-gray-300">No</label>
                                </div>
                            </div>
                        @endif
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Create
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>