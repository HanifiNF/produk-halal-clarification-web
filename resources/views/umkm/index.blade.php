<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My UMKMs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold">My UMKMs</h1>
                        <button id="registerUmkmBtn"
                            class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Register New UMKM
                        </button>
                    </div>

                    @if(session('success'))
                        <div class="alert alert-success bg-green-100 text-green-700 p-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($umkms->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            ID</th>
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
                                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                                    @foreach($umkms as $umkm)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $umkm->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $umkm->nama_umkm }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                                {{ $umkm->kota }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('umkm.show', $umkm) }}"
                                                    class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-2">View</a>
                                                <a href="{{ route('umkm.edit', $umkm) }}"
                                                    class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 mr-2">Edit</a>
                                                <form action="{{ route('umkm.destroy', $umkm) }}" method="POST"
                                                    style="display:inline-block;" onsubmit="return confirm('Delete UMKM?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $umkms->links() }}
                        </div>
                    @else
                        <p class="text-gray-800 dark:text-gray-200">You haven't registered any UMKMs yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Background -->
    <div id="umkmModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="fixed inset-0 w-full h-full bg-black opacity-50"></div>
        <div class="flex min-h-screen items-center justify-center px-4 py-8">
            <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl transform transition-all sm:w-full sm:max-w-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            Register New UMKM
                        </h3>
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    
                    <form id="umkmForm" action="{{ route('umkm.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Name of UMKM</label>
                                <input type="text" name="nama_umkm" class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email (UMKM)</label>
                                <input type="email" name="email_umkm" class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Isi jika UMKM memiliki email khusus</p>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number (UMKM)</label>
                                <input type="text" name="nomor_handphone_umkm" class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Isi jika UMKM memiliki nomor handphone khusus</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Establishment Year</label>
                                <input type="number" name="tahun_berdiri" class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white" min="1900" max="{{ date('Y') }}" required>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                            <textarea name="alamat" class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white" required></textarea>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                                <input type="text" name="kota" class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Province</label>
                                <input type="text" name="provinsi" class="block w-full rounded-md border-gray-300 shadow-sm dark:border-gray-600 dark:bg-gray-700 dark:text-white" required>
                            </div>
                        </div>
                        
                        <div class="flex justify-end">
                            <button type="button" id="cancelForm" class="mr-2 px-4 py-2 text-sm text-gray-700 dark:text-gray-300 bg-gray-200 dark:bg-gray-600 rounded-md hover:bg-gray-300 dark:hover:bg-gray-500">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 text-sm text-white bg-gray-800 dark:bg-gray-200 rounded-md hover:bg-gray-700 dark:hover:bg-white focus:outline-none">
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

        // Show modal
        registerUmkmBtn.addEventListener('click', function () {
            umkmModal.classList.remove('hidden');
        });

        // Close modal functions
        closeModal.addEventListener('click', function () {
            umkmModal.classList.add('hidden');
        });

        cancelForm.addEventListener('click', function () {
            umkmModal.classList.add('hidden');
        });

        // Close modal when clicking outside the form
        umkmModal.addEventListener('click', function (event) {
            if (event.target === umkmModal) {
                umkmModal.classList.add('hidden');
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