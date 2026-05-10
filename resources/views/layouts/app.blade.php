<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="modern">
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
</head>
<body class="bg-base-100 text-base-content font-sans antialiased">
    <div class="min-h-screen flex flex-col">

        {{-- Navigation --}}
        @include('layouts.navigation')

        {{-- Page Heading --}}
        {{ $header ?? '' }}

        {{-- Page Content --}}
        <main class="flex-1 p-6 max-w-7xl mx-auto w-full">
            <div class="surface-card p-6">
                {{ $slot ?? '' }}
                @yield('content')
            </div>
        </main>

        {{-- Footer --}}
        <footer class="bg-base-200 text-base-content p-4 text-center">
            &copy; 2026 NanTech.Dev. All rights reserved.
        </footer>
    </div>
</body>
</html>
