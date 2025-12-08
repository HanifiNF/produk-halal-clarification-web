<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Product') }}
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

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Name</label>
                                <input type="text" name="nama_produk" 
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('nama_produk') }}" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product Image</label>
                                <input type="file" name="product_image"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Optional: Upload product image (max 2MB)</p>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date</label>
                                <input type="date" name="date"
                                    class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    value="{{ old('date') }}" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Verification Status</label>
                                <div class="flex items-center mb-2">
                                    <input type="radio" name="verification_status" id="verification_status_approved" value="1"
                                        class="rounded text-indigo-600 shadow-sm" {{ old('verification_status') == '1' ? 'checked' : '' }}>
                                    <label for="verification_status_approved" class="ml-2 text-gray-700 dark:text-gray-300">Approved</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="verification_status" id="verification_status_pending" value="0"
                                        class="rounded text-indigo-600 shadow-sm" {{ old('verification_status') == '0' || old('verification_status') === null ? 'checked' : '' }}>
                                    <label for="verification_status_pending" class="ml-2 text-gray-700 dark:text-gray-300">Pending</label>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Create Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>