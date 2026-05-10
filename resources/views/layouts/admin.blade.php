<!DOCTYPE html>
<html lang="en" data-theme="modern">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/@heroicons/vue@2.0.18/outline/index.js" defer></script>
</head>
<body class="flex flex-col min-h-screen bg-base-100 text-base-content">
    @include('components.flash-toast')

    <header class="navbar bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 text-white shadow-lg px-6">
        <div class="flex-1 gap-3 items-center hidden sm:flex">
            <x-application-logo class="w-12 h-12 text-white" />
            <div>
                <p class="text-lg font-semibold text-white">Toko Laravel</p>
                <p class="text-sm text-white/80">Admin dashboard untuk manajemen pengguna dan transaksi</p>
            </div>
        </div>

        <div class="flex-none space-x-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline text-white border-white hover:bg-white hover:text-emerald-500">Dashboard</a>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost gap-2 text-white hover:bg-white/20">
                    {{ Auth::user()->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-4 shadow-xl bg-base-100 rounded-xl w-56 gap-3">
                    <li><a href="{{ route('profile.edit') }}" class="btn btn-lg btn-primary w-full justify-center text-center font-semibold text-base transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] h-14">Profil</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="btn btn-lg btn-error w-full justify-center text-center font-semibold text-base transition-all duration-200 hover:scale-[1.02] active:scale-[0.98] h-14">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="flex flex-1">
        <aside class="sidebar-shell w-72 p-5 shadow-sm">
            <div class="mb-6">
                <p class="text-sm uppercase tracking-[0.2em] text-base-content/60">Admin Menu</p>
            </div>
            <ul class="menu themed-menu rounded-box menu-vertical w-full gap-2">
                <li class="menu-title"><span>Data Master</span></li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class="rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-primary/10 text-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6 1a4 4 0 100-8 4 4 0 000 8zm6 0a4 4 0 00-3-3.87" />
                                </svg>
                            </span>
                            <span>Users</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.categories.index') }}" class="rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-secondary/10 text-secondary">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </span>
                            <span>Categories</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.products.index') }}" class="rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-accent/10 text-accent">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M3 7h18M9 3h6m-6 4h6M4 12h16m-5 4h5m-5 4h5" />
                                </svg>
                            </span>
                            <span>Products</span>
                        </div>
                    </a>
                </li>
                <li class="menu-title"><span>Operasional</span></li>
                <li>
                    <a href="{{ route('admin.transactions.index') }}" class="rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-info/10 text-info">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2" />
                                </svg>
                            </span>
                            <span>Transactions</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.reports.index') }}" class="rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-warning/10 text-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M9 17v-6a2 2 0 012-2h2a2 2 0 012 2v6m-4 4h.01" />
                                </svg>
                            </span>
                            <span>Reports</span>
                        </div>
                    </a>
                </li>
                <li class="menu-title mt-6"><span>Lainnya</span></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="rounded-xl text-error hover:bg-error/10">
                            <div class="flex items-center gap-3">
                                <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-error/10 text-error">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                </span>
                                <span>Logout</span>
                            </div>
                        </button>
                    </form>
                </li>
            </ul>
        </aside>

        <main class="flex-1 overflow-y-auto p-6 max-w-7xl mx-auto w-full">
            <div class="surface-card p-6">
                @yield('content')
            </div>
        </main>
    </div>

    <footer class="bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500 text-white text-center py-6 shadow-lg mt-12">
        <div class="max-w-7xl mx-auto">
            <p class="font-semibold mb-2">Admin Panel</p>
            <p class="text-sm opacity-90">&copy; 2026 NanTech.Dev. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
