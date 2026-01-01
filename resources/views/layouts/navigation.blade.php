<nav x-data="{ open: false }" class="bg-white dark:bg-white shadow dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                        {{ __('Produk') }}
                    </x-nav-link>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('howto')" :active="request()->routeIs('howto')">
                        {{ __('How To') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6" id="dropdown-root">
                <div class="relative" id="settings-dropdown">
                    <div id="dropdown-trigger" class="cursor-pointer">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-500 bg-white dark:bg-white hover:text-gray-700 dark:hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div id="dropdown-content"
                        class="absolute z-50 mt-2 w-48 rounded-md shadow-lg ltr:origin-top-right rtl:origin-top-left end-0 py-1 bg-white dark:bg-white ring-1 ring-black ring-opacity-5 hidden">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        {{-- <x-dropdown-link :href="route('umkm.index')">
                            {{ __('Manage UMKMs') }}
                        </x-dropdown-link> --}}

                        @if(Auth::user()->status_pembina)
                            <x-dropdown-link :href="route('pembina.binaan')">
                                {{ __('Daftar Binaan') }}
                            </x-dropdown-link>
                        @endif

                        @if(Auth::user()->admin)
                            <x-dropdown-link :href="route('admin.dashboard')">
                                {{ __('Admin Dashboard') }}
                            </x-dropdown-link>
                        @endif

                        @if(Auth::user()->data_access && !Auth::user()->admin)
                            <x-dropdown-link :href="route('data.access.dashboard')">
                                {{ __('Data Access Dashboard') }}
                            </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button id="hamburger-button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path id="hamburger-icon-open" class="inline-flex" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path id="hamburger-icon-close" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div id="responsive-menu" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Beranda') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                {{ __('Produk') }}
            </x-responsive-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('howto')" :active="request()->routeIs('howto')">
                {{ __('How To') }}
            </x-responsive-nav-link>
        </div>


        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                {{-- <x-responsive-nav-link :href="route('umkm.index')">
                    {{ __('Manage UMKMs') }}
                </x-responsive-nav-link> --}}
                @if(Auth::user()->status_pembina)
                    <x-responsive-nav-link :href="route('pembina.binaan')">
                        {{ __('Daftar Binaan') }}
                    </x-responsive-nav-link>
                @endif

                @if(Auth::user()->admin)
                    <x-responsive-nav-link :href="route('admin.dashboard')">
                        {{ __('Admin Dashboard') }}
                    </x-responsive-nav-link>
                @endif

                @if(Auth::user()->data_access && !Auth::user()->admin)
                    <x-responsive-nav-link :href="route('data.access.dashboard')">
                        {{ __('Data Access Dashboard') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Dropdown functionality
        const dropdownTrigger = document.getElementById('dropdown-trigger');
        const dropdownContent = document.getElementById('dropdown-content');

        if (dropdownTrigger && dropdownContent) {
            // Toggle dropdown when trigger is clicked
            dropdownTrigger.addEventListener('click', function (e) {
                e.stopPropagation();
                const isHidden = dropdownContent.classList.contains('hidden');

                // Close all other dropdowns first
                closeAllDropdowns();

                // Toggle current dropdown
                if (isHidden) {
                    dropdownContent.classList.remove('hidden');
                } else {
                    dropdownContent.classList.add('hidden');
                }
            });

            // Close dropdown when clicking outside
            document.addEventListener('click', function () {
                closeAllDropdowns();
            });

            // Prevent dropdown from closing when clicking inside it
            dropdownContent.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        }

        // Hamburger menu functionality
        const hamburgerButton = document.getElementById('hamburger-button');
        const responsiveMenu = document.getElementById('responsive-menu');
        const hamburgerIconOpen = document.getElementById('hamburger-icon-open');
        const hamburgerIconClose = document.getElementById('hamburger-icon-close');

        if (hamburgerButton && responsiveMenu) {
            hamburgerButton.addEventListener('click', function () {
                const isHidden = responsiveMenu.classList.contains('hidden');

                if (isHidden) {
                    responsiveMenu.classList.remove('hidden');
                    if (hamburgerIconOpen) hamburgerIconOpen.classList.add('hidden');
                    if (hamburgerIconClose) hamburgerIconClose.classList.remove('hidden');
                } else {
                    responsiveMenu.classList.add('hidden');
                    if (hamburgerIconOpen) hamburgerIconOpen.classList.remove('hidden');
                    if (hamburgerIconClose) hamburgerIconClose.classList.add('hidden');
                }
            });
        }

        // Function to close all dropdowns
        function closeAllDropdowns() {
            if (dropdownContent && !dropdownContent.classList.contains('hidden')) {
                dropdownContent.classList.add('hidden');
            }
        }
    });
</script>