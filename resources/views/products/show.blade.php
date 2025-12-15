<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Product Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product
                                Name</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $product->nama_produk }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Date</label>
                            <p class="text-gray-900 dark:text-gray-100">{{ $product->date }}</p>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Verification
                                Status</label>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ $product->verification_status ? 'Perlu Sertifikasi' : 'Tidak Perlu Sertifikasi' }}
                            </p>

                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">UMKM
                                Name</label>
                            <p class="text-gray-900 dark:text-gray-100">
                                {{ $product->umkm->nama_umkm ?? $product->umkm->name ?? 'N/A' }}</p>
                        </div>

                        <div class="mb-4 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Product
                                Image</label>
                            @if($product->product_image)
                                <img src="{{ asset('storage/' . $product->product_image) }}"
                                    alt="{{ $product->nama_produk }}" class="w-32 h-32 object-cover rounded-md">
                            @else
                                <p class="text-gray-900 dark:text-gray-100">No image uploaded</p>
                            @endif
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('products.edit', $product) }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 mr-2">
                            Edit
                        </a>
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-500 dark:bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white dark:text-white uppercase tracking-widest hover:bg-gray-600 dark:hover:bg-gray-600 focus:bg-gray-600 dark:focus:bg-gray-600 active:bg-gray-700 dark:active:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Back to Products
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>