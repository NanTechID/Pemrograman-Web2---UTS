@extends('layouts.kasir')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="content-panel">
        <h1 class="text-3xl font-semibold">Selamat datang di Kasir Dashboard!</h1>
        <p class="mt-2 text-base-content/70">Kelola transaksi penjualan dan laporan harian dengan cepat.</p>
    </div>

    <!-- Quick Stats -->
    <div class="grid gap-4 lg:grid-cols-3">
        <div class="stat bg-primary text-primary-content rounded-3xl shadow-lg">
            <div class="stat-figure">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/>
                </svg>
            </div>
            <div class="stat-title">Transaksi Hari Ini</div>
            <div class="stat-value">{{ number_format($today_transactions ?? 0) }}</div>
        </div>
        <div class="stat bg-secondary text-secondary-content rounded-3xl shadow-lg">
            <div class="stat-figure">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                </svg>
            </div>
            <div class="stat-title">Penjualan Hari Ini</div>
            <div class="stat-value">Rp {{ number_format($today_sales ?? 0, 0, ',', '.') }}</div>
        </div>
        <div class="stat bg-accent text-accent-content rounded-3xl shadow-lg">
            <div class="stat-figure">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19 3H4.99c-1.11 0-1.98.9-1.98 2L3 19c0 1.1.88 2 1.99 2H19c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 12h-4c0 1.66-1.35 3-3 3s-3-1.34-3-3H4.99V5H19v10zm-3-5h-2V7h-4v3H8l4 4 4-4z"/>
                </svg>
            </div>
            <div class="stat-title">Produk Low Stock</div>
            <div class="stat-value">{{ number_format($low_stock ?? 0) }}</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="content-panel">
            <h2 class="text-xl font-semibold mb-6">Aksi Cepat</h2>
            <div class="grid gap-4 md:grid-cols-3">
                <a href="{{ route('kasir.transactions.create') }}" class="btn btn-primary w-full gap-2 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Transaksi Baru
                </a>
                <a href="{{ route('kasir.transactions.index') }}" class="btn btn-outline btn-secondary w-full gap-2 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    Lihat Transaksi
                </a>
                <a href="{{ route('kasir.reports.index') }}" class="btn btn-outline btn-accent w-full gap-2 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6m3 6V7m3 10v-4m3 8H6a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2v12a2 2 0 01-2 2z" />
                    </svg>
                    Reports
                </a>
            </div>
        </div>

        <div class="content-panel">
            <h2 class="text-xl font-semibold mb-6">Transaksi Terbaru</h2>
            <div class="space-y-3 max-h-64 overflow-y-auto">
                @forelse($recent_transactions ?? [] as $transaction)
                <div class="flex items-center justify-between p-4 bg-base-100 rounded-xl border border-base-200">
                    <div>
                        <p class="font-semibold">{{ $transaction->invoice_number ?? 'INV-' . $transaction->id }}</p>
                        <p class="text-sm text-base-content/70">{{ $transaction->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-bold">Rp {{ number_format($transaction->total ?? 0, 0, ',', '.') }}</p>
                        <span class="badge badge-success badge-sm">{{ $transaction->customer?->name ?? 'Walk-in' }}</span>
                    </div>
                </div>
                @empty
                <p class="text-base-content/50 text-center py-8">Belum ada transaksi hari ini.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Notifications -->
    @if(isset($low_stock_items) && $low_stock_items->count())
    <div class="mb-4">
        <div class="rounded-xl bg-red-100 border border-red-300 p-4 text-red-800">
            <strong>Notifikasi Stok Menipis/Habis:</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach($low_stock_items as $product)
                    <li>
                        <span class="font-semibold">{{ $product->name }}</span>:
                        @if($product->stock == 0)
                            <span class="text-red-600 font-bold">Stok Habis!</span>
                        @else
                            <span class="text-orange-600 font-semibold">Sisa {{ $product->stock }}</span>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif
</div>
@endsection

