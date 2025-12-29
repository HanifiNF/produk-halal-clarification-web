<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-sm sm:rounded-lg">
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

                    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-700 mb-2">Nama
                                    Produk</label>
                                <input type="text" name="nama_produk"
                                    class="block w-full mt-1 rounded-md border-gray-700 shadow-sm dark:border-gray-600 dark:bg-white dark:text-gray-700"
                                    value="{{ old('nama_produk', $product->nama_produk) }}" required>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-700 mb-2">Gambar
                                    Produk
                                </label>
                                @if($product->product_image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $product->product_image) }}"
                                            alt="{{ $product->nama_produk }}" class="w-32 h-32 object-cover rounded-md">
                                    </div>
                                @endif
                                <input type="file" name="product_image"
                                    class="block w-full mt-1 rounded-md border-gray-700 shadow-sm dark:border-gray-600 dark:bg-gray-white dark:text-gray-700 border">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Optional: Upload new product
                                    image (max 2MB)</p>
                            </div>

                            @if(Auth::user()->admin)
                                <div class="mb-4">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-700 mb-2">Date</label>
                                    <input type="date" name="date"
                                        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-white dark:text-gray-700"
                                        value="{{ old('date', $product->date) }}" required>
                                </div>
                            @else
                                <div class="mb-4">
                                    <label
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-700 mb-2">Date</label>
                                    <div
                                        class="block w-full mt-1 rounded-md border border-gray-300 shadow-sm dark:border-gray-600 dark:bg-white dark:text-gray-700">
                                        {{ $product->date }}
                                    </div>
                                </div>
                            @endif
                        </div>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Update Produk
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>