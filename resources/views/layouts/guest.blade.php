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
        
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #ecfeff 0%, #f0fdfa 35%, #ecfeff 70%, #eff6ff 100%);
                background-size: 400% 400%;
                animation: gradientShift 15s ease infinite;
            }
            @keyframes gradientShift {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .glass-card {
                backdrop-filter: blur(12px);
                background: rgba(255, 255, 255, 0.92);
                border: 1px solid rgba(13, 148, 136, 0.18);
                box-shadow: 0 20px 45px -30px rgba(15, 23, 42, 0.45);
            }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased min-h-screen gradient-bg relative overflow-x-hidden">
        @include('components.flash-toast')

        @yield('background-effects')

        <!-- Animated particles -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-20 h-20 bg-white/20 rounded-full blur-xl animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 right-20 w-32 h-32 bg-white/10 rounded-full blur-3xl animate-bounce delay-2000"></div>
            <div class="absolute bottom-20 left-1/4 w-24 h-24 bg-sky-100/30 rounded-full blur-xl animate-pulse delay-3000"></div>
        </div>

        <div class="min-h-screen flex flex-col justify-center items-center px-4 py-12 sm:px-6 lg:px-8 relative z-10">
            <!-- Logo Header -->
            <div class="flex flex-col items-center gap-4 mb-8 text-center animate-fade-in">
                <a href="/" class="inline-flex items-center gap-3 group">
                    <div class="w-16 h-16 bg-white/90 rounded-2xl p-4 shadow-lg group-hover:scale-110 transition-all duration-500 border border-teal-100">
                        <x-application-logo class="w-12 h-12 text-teal-600" />
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold bg-gradient-to-r from-emerald-600 via-teal-500 to-cyan-500 bg-clip-text text-transparent">
                            {{ config('app.name', 'Laravel') }}
                        </h1>
                        <p class="text-sm text-slate-600 font-medium">Akses Dashboard Aman</p>
                    </div>
                </a>
            </div>

            <!-- Form Container - Full hero card -->
            <div class="w-full max-w-md form-stroke glass-card p-8 sm:p-10 animate-slide-up">
                @yield('content')
            </div>

            <!-- Footer -->
            <div class="mt-12 text-center">
                <p class="text-slate-500 text-sm">&copy; 2026 NanTech.Dev. All rights reserved.</p>
            </div>
        </div>
    </body>
</html>
