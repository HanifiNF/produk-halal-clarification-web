<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @if(app()->environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}"></script>
    @endif

    <style>
        header {
            background-color: transparent !important;
            backdrop-filter: none !important;
        }
    </style>
</head>

<body class="font-sans antialiased min-h-screen flex flex-col"
    style="background: linear-gradient(to top right, #d7e2ff, #e8f1ff, #f9fcff);">
    <div class="flex-grow flex flex-col">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            {{--<header class="bg-white dark:bg-gray-800">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>--}}
        @endif

        <!-- Page Content -->
        <main class="flex-grow">
            {{ $slot }}
        </main>
    </div>


    <footer class="bg-white rounded-base shadow-xs border border-default w-full">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="https:/mui.or.id/" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="components/logohalal.png" class="h-7" alt="halal Logo" />
                    <span class="text-heading self-center text-2xl font-semibold whitespace-nowrap">Halal Product
                        Classification</span>
                </a>
                <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-body sm:mb-0">
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">About</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">Contact</a>
                    </li>
                </ul>
            </div>
            <hr class="my-6 border-default sm:mx-auto lg:my-8" />
            <span class="block text-sm text-body sm:text-center">© 2025 <a href="https:/mui.or.id/"
                    class="hover:underline">HalalP™</a>. All Rights Reserved.</span>
        </div>
    </footer>


</body>

</html>