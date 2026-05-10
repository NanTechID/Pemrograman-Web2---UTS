<!DOCTYPE html>
<html lang="en" data-theme="modern">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir - Toko Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen bg-base-100 text-base-content">
    @include('components.flash-toast')

<nav class="navbar bg-gradient-to-r from-primary via-blue-600 to-cyan-500 text-primary-content shadow-lg px-6 py-4 z-50">
        <div class="flex-1 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <label for="drawer-kasir" class="btn btn-ghost btn-circle drawer-button lg:hidden text-primary-content hover:bg-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
                <div class="text-xl font-semibold">Kasir Panel</div>
            </div>
            <div class="hidden lg:flex">
                <ul class="menu menu-horizontal px-1 gap-1">
                    <li>
                        <a href="{{ route('kasir.dashboard') }}" class="text-primary-content hover:text-primary-content hover:bg-white/20 {{ request()->routeIs('kasir.dashboard') ? 'bg-white/30' : '' }}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kasir.transactions.index') }}" class="text-primary-content hover:text-primary-content hover:bg-white/20 {{ request()->routeIs('kasir.transactions.*') ? 'bg-white/30' : '' }}">
                            Transactions
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kasir.reports.index') }}" class="text-primary-content hover:text-primary-content hover:bg-white/20 {{ request()->routeIs('kasir.reports.*') ? 'bg-white/30' : '' }}">
                            Reports
                            <span class="badge badge-primary badge-sm">Kasir</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost gap-2 text-primary-content hover:bg-white/20">
                    {{ Auth::user()->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.293l3.71-4.06a.75.75 0 111.08 1.04l-4.25 4.65a.75.75 0 01-1.08 0l-4.25-4.65a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </label>
                <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow-lg bg-base-100 rounded-box w-44 gap-2">
                    <li><a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary w-full justify-center text-center transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">Profil</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-error w-full justify-center text-center transition-all duration-200 hover:scale-[1.02] active:scale-[0.98]">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Drawer Sidebar -->
    <input id="drawer-kasir" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col">
        <main class="flex-1 overflow-y-auto p-6 max-w-7xl mx-auto w-full">
            <div class="surface-card p-6">
                @yield('content')
            </div>
        </main>
    </div> 
    <div class="drawer-side">
        <label for="drawer-kasir" aria-label="close sidebar" class="drawer-overlay"></label>
        <ul class="menu themed-menu sidebar-shell p-4 w-64 min-h-full gap-2">
            <!-- Sidebar Header -->
            <li class="menu-title text-lg font-bold mb-4">Kasir Dashboard</li>
            
            <!-- Transaksi Section -->
            <li class="menu-title">
                <span>Transaksi</span>
            </li>
            <li>
                <a href="{{ route('kasir.transactions.index') }}" class="{{ request()->routeIs('kasir.transactions.index') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" /></svg>
                    Daftar Transaksi
                </a>
            </li>
            <li>
                <a href="{{ route('kasir.transactions.create') }}" class="{{ request()->routeIs('kasir.transactions.create') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Tambah Transaksi
                </a>
            </li>
            <li>
                <a class="tooltip text-base-content/50" data-tip="Edit tidak tersedia untuk kasir">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1 1a2 2 0 002 2h.01M19 7V5a2 2 0 00-2-2H9a2 2 0 00-2 2v1.586l.586.586a2 2 0 002 2H19z" /></svg>
                    Edit Transaksi
                </a>
            </li>
            <li>
                <a href="{{ route('kasir.transactions.index') }}" class="tooltip" data-tip="Lihat semua transaksi">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    Detail Transaksi
                </a>
            </li>

            <!-- Laporan Section -->
            <li class="menu-title mt-4">
                <span>Laporan</span>
            </li>
            <li>
                <a href="{{ route('kasir.reports.index') }}" class="{{ request()->routeIs('kasir.reports.index') ? 'active' : '' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                    Daftar Laporan
                </a>
            </li>
            <li>
                <a class="tooltip text-base-content/50" data-tip="Create tidak tersedia untuk kasir">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" /></svg>
                    Buat Laporan
                </a>
            </li>
            <li>
                <a class="tooltip text-base-content/50" data-tip="Edit tidak tersedia untuk kasir">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.5h3m1 1a2 2 0 002 2h.01M19 7V5a2 2 0 00-2-2H9a2 2 0 00-2 2v1.586l.586.586a2 2 0 002 2H19z" /></svg>
                    Edit Laporan
                </a>
            </li>
            <li>
                <a href="{{ route('kasir.reports.index') }}" class="tooltip" data-tip="Lihat semua laporan">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                    Detail Laporan
                </a>
            </li>
        </ul>
    </div>

    <footer class="bg-gradient-to-r from-primary via-blue-600 to-cyan-500 text-primary-content text-center py-6 shadow-lg mt-12">
        <div class="max-w-7xl mx-auto">
            <p class="font-semibold mb-2">Kasir Panel</p>
            <p class="text-sm opacity-90">&copy; 2026 NanTech.Dev. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
