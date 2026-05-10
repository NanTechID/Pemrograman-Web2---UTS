@extends('layouts.kasir')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-semibold">Laporan Transaksi Kasir</h1>
            <p class="text-base-content/70">Ringkasan transaksi berdasarkan rentang waktu.</p>
        </div>
        <div class="flex gap-2">
            <button id="btn-print" class="btn btn-primary px-6" onclick="window.print()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print
            </button>
            <a href="{{ route('kasir.reports.index') }}" class="btn btn-ghost px-6">Refresh</a>
        </div>
    </div>

    <form method="GET" action="{{ route('kasir.reports.index') }}" class="mb-4">
        <div class="join">
            <select name="range" class="select select-bordered join-item">
                <option value="daily" @selected(($range ?? 'daily') === 'daily')>Harian</option>
                <option value="weekly" @selected(($range ?? 'daily') === 'weekly')>Mingguan</option>
                <option value="monthly" @selected(($range ?? 'daily') === 'monthly')>Bulanan</option>
            </select>
            <button type="submit" class="btn btn-primary join-item">Terapkan</button>
        </div>
    </form>

    <div class="stats stats-vertical lg:stats-horizontal shadow mb-6 w-full">
        <div class="stat">
            <div class="stat-title">Jumlah Transaksi</div>
            <div class="stat-value text-primary">{{ $transactions->count() }}</div>
        </div>
        <div class="stat">
            <div class="stat-title">Total Penjualan</div>
            <div class="stat-value text-secondary text-2xl">Rp {{ number_format($transactions->sum('grand_total'), 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Invoice</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->invoice_number ?? '-' }}</td>
                        <td>{{ $transaction->customer?->name ?? $transaction->customer_name ?? 'Walk-in' }}</td>
                        <td>Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</td>
                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-base-content/60 py-8">Tidak ada data laporan pada rentang ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
