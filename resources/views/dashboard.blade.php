<x-app-layout>
    <style>
        .blurred {
            filter: blur(5px);
            transition: filter 0.3s ease;
        }
    </style>

    <div id="pageContent" class="content">
        {{--<x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-600 dark:text-gray-500 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>--}}

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-white overflow-hidden shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-700">
                        <!-- Carousel Placeholder -->
                        <div class="relative bg-red-500 flex items-center justify-center my-6">
                            <p class="text-white text-xl font-bold">CAROUSEL PLACEHOLDER</p>
                            <!-- Nanti carousel sebenarnya akan ditambahkan di sini -->
                        </div>

                        <div class="mt-6">
                            {{-- <button id="registerUmkmBtn"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Register New UMKM
                            </button> --}}
                            {{-- <a href="{{ route('umkm.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-4">
                                Manage My UMKMs
                            </a> --}}
                            <a href="{{ route('products.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-4">
                                Add New Product
                            </a>
                            <a href="{{ route('products.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-4">
                                Manage My Products
                            </a>

                            @if(Auth::user()->status_pembina)
                                <a href="{{ route('pembina.binaan') }}"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-4">
                                    Manage My Binaan
                                </a>
                            @endif
                        </div>

                        <!-- Display User's Products -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-700 mb-4">My Products</h3>
                            @php
                                $userProducts = \App\Models\Product::with('umkm')->where('umkm_id', Auth::id())->latest()->take(10)->get();
                            @endphp

                            @if($userProducts->count() > 0)
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
                                    @foreach($userProducts as $product)
                                        <div
                                            class="bg-white dark:bg-white border rounded-lg shadow-lg overflow-hidden hover:bg-gray-100 dark:hover:bg-gray-100">
                                            <!-- Product Image -->
                                            <a href="{{ route('products.show', $product) }}">
                                                @if($product->product_image)
                                                    <img class="rounded-t-lg w-full h-32 object-cover"
                                                        src="{{ asset('storage/' . $product->product_image) }}"
                                                        alt="{{ $product->nama_produk }}" />
                                                @else
                                                    <div
                                                        class="w-full h-32 bg-gray-200 dark:bg-gray-600 flex items-center justify-center rounded-t-lg">
                                                        <span class="text-gray-500 dark:text-gray-400 text-sm">No Image</span>
                                                    </div>
                                                @endif
                                            </a>
                                            <div class="p-4 text-center">
                                                <a href="{{ route('products.show', $product) }}">
                                                    <h5
                                                        class="mt-2 mb-2 text-lg font-semibold tracking-tight text-gray-800 dark:text-gray-700 truncate">
                                                        {{ $product->nama_produk }}
                                                    </h5>
                                                </a>
                                                <div class="mb-2">
                                                    <span
                                                        class="px-1 inline-flex text-xs leading-4 font-semibold rounded-full {{ $product->verification_status ? 'bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100' }}">
                                                        {{ $product->verification_status ? 'Perlu Sertifikasi' : 'Tidak Perlu
                                                                                                    Sertifikasi' }}
                                                    </span>
                                                </div>
                                                <div class="flex justify-center space-x-1">
                                                    <a href="{{ route('products.show', $product) }}"
                                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 text-xs">View</a>
                                                    @if(auth()->user()->admin || $product->umkm_id == auth()->id())
                                                        <a href="{{ route('products.edit', $product) }}"
                                                            class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 text-xs">|
                                                            Edit</a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('products.index') }}"
                                        class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                        View All Products &rarr;
                                    </a>
                                </div>
                            @else
                                <p class="text-gray-800 dark:text-gray-700">You haven't registered any products yet.</p>
                                <a href="{{ route('products.create') }}"
                                    class="inline-flex items-center px-4 py-2 mt-4 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    Add Your First Product
                                </a>
                            @endif
                        </div>

                        @if(Auth::user()->status_pembina)
                            <!-- Display Pembina's Binaan -->
                            <div class="mt-8">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">My Binaan</h3>
                                @php
                                    $binaan = \App\Models\User::where('pembina_id', Auth::id())->latest()->take(5)->get();
                                @endphp

                                @if($binaan->count() > 0)
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                            <thead class="bg-gray-50 dark:bg-gray-700">
                                                <tr>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                        Name</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                        Email</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                        UMKM Name</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                        City</th>
                                                    <th
                                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                        Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody
                                                class="bg-sky-50 dark:bg-sky-700 divide-y divide-gray-200 dark:divide-gray-600">
                                                @foreach($binaan as $user)
                                                    <tr>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                            {{ $user->name }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                            {{ $user->email }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                            {{ $user->nama_umkm ?? 'N/A' }}
                                                        </td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                            {{ $user->city ?? 'N/A' }}
                                                        </td>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                            <a href="{{ route('products.index', ['user_id' => $user->id]) }}"
                                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">View
                                                                Products</a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mt-4">
                                        <a href="{{ route('pembina.binaan') }}"
                                            class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300">
                                            View All Binaan &rarr;
                                        </a>
                                    </div>
                                @else
                                    <p class="text-gray-800 dark:text-gray-200">You don't have any binaan yet.</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Background -->
    <div id="umkmModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 w-full h-full bg-black bg-opacity-50"></div>
        <div class="flex min-h-screen items-center justify-center px-4 py-8">
            <div
                class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Register New UMKM
                        </h3>
                        <button id="closeModal"
                            class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <form id="umkmForm" action="{{ route('umkm.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name of
                                    UMKM</label>
                                <input type="text" name="nama_umkm"
                                    class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email
                                    (UMKM)</label>
                                <input type="email" name="email_umkm"
                                    class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Isi jika UMKM memiliki email
                                    khusus</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone
                                    Number (UMKM)</label>
                                <input type="text" name="nomor_handphone_umkm"
                                    class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Isi jika UMKM memiliki nomor
                                    handphone khusus</p>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Establishment
                                    Year</label>
                                <input type="number" name="tahun_berdiri"
                                    class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    min="1900" max="{{ date('Y') }}" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                            <textarea name="alamat"
                                class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                required></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                                <input type="text" name="kota"
                                    class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    required>
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Province</label>
                                <input type="text" name="provinsi"
                                    class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white"
                                    required>
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" id="cancelForm"
                                class="mr-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-md hover:bg-gray-300 dark:hover:bg-gray-500">
                                Cancel
                            </button>
                            <button type="submit"
                                class="px-4 py-2 text-sm text-white bg-gray-800 dark:bg-gray-200 rounded-md hover:bg-gray-700 dark:hover:bg-white focus:outline-none">
                                Register
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Get DOM elements
        const registerUmkmBtn = document.getElementById('registerUmkmBtn');
        const umkmModal = document.getElementById('umkmModal');
        const closeModal = document.getElementById('closeModal');
        const cancelForm = document.getElementById('cancelForm');
        const umkmForm = document.getElementById('umkmForm');
        const pageContent = document.getElementById('pageContent');

        // Show modal
        registerUmkmBtn.addEventListener('click', function () {
            umkmModal.classList.remove('hidden');
            pageContent.classList.add('blurred');
        });

        // Close modal functions
        closeModal.addEventListener('click', function () {
            umkmModal.classList.add('hidden');
            pageContent.classList.remove('blurred');
        });

        cancelForm.addEventListener('click', function () {
            umkmModal.classList.add('hidden');
            pageContent.classList.remove('blurred');
        });

        // Close modal when clicking outside the form
        umkmModal.addEventListener('click', function (event) {
            if (event.target === umkmModal) {
                umkmModal.classList.add('hidden');
                pageContent.classList.remove('blurred');
            }
        });

        // Handle form submission
        umkmForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(umkmForm);

            // Send the form data via AJAX
            fetch(umkmForm.getAttribute('action'), {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success message
                        alert(data.message);

                        // Close the modal
                        umkmModal.classList.add('hidden');
                        pageContent.classList.remove('blurred');

                        // Optionally, refresh the page to show the new UMKM
                        location.reload();
                    } else {
                        // Handle validation errors if they're returned in the response
                        if (data.errors) {
                            let errorMessages = '';
                            for (let field in data.errors) {
                                errorMessages += data.errors[field].join(', ') + '\n';
                            }
                            alert('Validation errors:\n' + errorMessages);
                        } else {
                            alert('There were some errors with your submission. Please try again.');
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while submitting the form. Please try again.');
                });
        });
    </script>
</x-app-layout>