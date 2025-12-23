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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .link-hover {
            color: white;
            transition: color 0.2s ease-in-out;
        }

        .link-hover:hover {
            color: #c7cace;
            /* gray-300 */
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0"
        style="background: linear-gradient(to top right, #1e3a8a, #3b82f6, #93c5fd);">
        <div>
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current" />
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4
                    bg-white/20 backdrop-blur-md
                    shadow-lg rounded-lg border border-blue/30">
            {{ $slot }}
        </div>
    </div>
</body>

</html>