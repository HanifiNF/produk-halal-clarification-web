<x-app-layout>
    <style>
        .blurred {
            filter: blur(5px);
            transition: filter 0.3s ease;
        }
    </style>

    <div id="pageContent" class="content">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}

                        <div class="mt-6">
                            <button id="registerUmkmBtn"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                Register New UMKM
                            </button>
                            <a href="{{ route('umkm.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-4">
                                Manage My UMKMs
                            </a>
                        </div>
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