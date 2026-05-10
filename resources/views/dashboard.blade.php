<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-2xl font-semibold text-gray-900">Welcome back!</h1>
                <p class="mt-2 text-sm text-gray-600">Pilih menu cepat di bawah untuk mengelola pengguna, kategori, produk, transaksi, atau laporan.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('admin.users.index') }}" class="block rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-lg font-semibold text-sky-600">Users</p>
                    <p class="mt-2 text-sm text-gray-500">Manage admin and cashier users.</p>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-lg font-semibold text-emerald-600">Categories</p>
                    <p class="mt-2 text-sm text-gray-500">Manage product categories.</p>
                </a>
                <a href="{{ route('admin.products.index') }}" class="block rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-lg font-semibold text-violet-600">Products</p>
                    <p class="mt-2 text-sm text-gray-500">Manage inventory and pricing.</p>
                </a>
                <a href="{{ route('admin.transactions.index') }}" class="block rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-lg font-semibold text-teal-600">Transactions</p>
                    <p class="mt-2 text-sm text-gray-500">View and process sales transactions.</p>
                </a>
                <a href="{{ route('admin.reports.index') }}" class="block rounded-3xl border border-gray-200 bg-white p-6 shadow-sm transition hover:shadow-md">
                    <p class="text-lg font-semibold text-orange-600">Reports</p>
                    <p class="mt-2 text-sm text-gray-500">Generate and print sales reports.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
