<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-600">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">List Produk</h1>
                        <a href="{{ route('products.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-200 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-gray-900 focus:bg-gray-700 dark:focus:bg-gray-200 active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Tambah Produk
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success bg-green-100 text-green-700 p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($products->count() > 0)
                        <div class="relative overflow-x-auto bg-neutral-primary-soft shadow-xs rounded-base ">
                            <div class="p-4">
                                <form method="GET" action="{{ route('products.index') }}">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                            <svg class="w-4 h-4 text-body" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                                viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                    d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </div>
                                        <input type="text" name="search" value="{{ request('search') }}"
                                            class="block w-full max-w-96 ps-9 pe-3 py-2 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand px-3 py-2.5 shadow-xs placeholder:text-body"
                                            placeholder="Search">
                                        <!-- Preserve sort parameters when searching -->
                                        @if(request('sort_by'))
                                            <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                                        @endif
                                        @if(request('sort_order'))
                                            <input type="hidden" name="sort_order" value="{{ request('sort_order') }}">
                                        @endif
                                        <!-- Preserve user_id parameter when searching -->
                                        @if(request('user_id'))
                                            <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                                        @endif
                                    </div>
                                </form>
                            </div>
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            ID</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Nama Produk</th>
                                        @if(auth()->user()->admin || auth()->user()->data_access || auth()->user()->status_pembina)
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                Nama UMKM</th>
                                        @endif
                                        <th
                                            class="px-6 py-3  text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            <div class="flex items-center">
                                                Tanggal Upload
                                                @if(request('sort_by') == 'date' && request('sort_order') == 'asc')
                                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'date', 'sort_order' => 'desc']) }}"
                                                        class="ms-1">
                                                        <svg class="w-4 h-4" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                                        </svg>
                                                    </a>
                                                @elseif(request('sort_by') == 'date' && request('sort_order') == 'desc')
                                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'date', 'sort_order' => 'asc']) }}"
                                                        class="ms-1">
                                                        <svg class="w-4 h-4 rotate-180" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'date', 'sort_order' => 'desc']) }}"
                                                        class="ms-1">
                                                        <svg class="w-4 h-4" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </th>
                                        <th
                                            class="px-6 py-3 font-medium text-xs text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            <div class="flex items-center">
                                                Status Klarifikasi
                                                @if(request('sort_by') == 'verification_status' && request('sort_order') == 'asc')
                                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'verification_status', 'sort_order' => 'desc']) }}"
                                                        class="ms-1">
                                                        <svg class="w-4 h-4" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                                        </svg>
                                                    </a>
                                                @elseif(request('sort_by') == 'verification_status' && request('sort_order') == 'desc')
                                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'verification_status', 'sort_order' => 'asc']) }}"
                                                        class="ms-1">
                                                        <svg class="w-4 h-4 rotate-180" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                                        </svg>
                                                    </a>
                                                @else
                                                    <a href="{{ request()->fullUrlWithQuery(['sort_by' => 'verification_status', 'sort_order' => 'desc']) }}"
                                                        class="ms-1">
                                                        <svg class="w-4 h-4" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            fill="none" viewBox="0 0 24 24">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m8 15 4 4 4-4m0-6-4-4-4 4" />
                                                        </svg>
                                                    </a>
                                                @endif
                                            </div>
                                        </th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white dark:bg-white divide-y divide-gray-200 dark:divide-gray-600">
                                    @foreach($products as $product)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-900">
                                                {{ $product->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-900">
                                                {{ $product->nama_produk }}
                                            </td>
                                            @if(auth()->user()->admin || auth()->user()->data_access || auth()->user()->status_pembina)
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-900">
                                                    {{ $product->umkm->nama_umkm ?? $product->umkm->name ?? 'N/A' }}
                                                </td>
                                            @endif
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-900">
                                                {{ \Carbon\Carbon::parse($product->date)->format('d M Y') }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-900">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $product->verification_status ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' }}">
                                                    {{ $product->verification_status ? 'Perlu Sertifikasi' : 'Tidak Perlu Sertifikasi' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('products.show', $product) }}"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</a>
                                                @if(auth()->user()->admin || $product->umkm_id == auth()->id())
                                                    <a href="{{ route('products.edit', $product) }}"
                                                        class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 mr-2">Edit</a>
                                                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                        style="display:inline-block;" onsubmit="return confirm('Delete product?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $products->links() }}
                        </div>
                    @else
                        <p class="text-gray-800 dark:text-gray-600">Anda belum mempunyai produk</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>