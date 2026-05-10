@extends('layouts.kasir')

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-6">
        <div>
            <h1 class="text-2xl font-semibold">Daftar Transaksi Kasir</h1>
            <p class="text-base-content/70">Kelola transaksi harian kasir dan lihat detail pembayaran.</p>
        </div>
        <a href="{{ route('kasir.transactions.create') }}" class="btn btn-primary">Tambah Transaksi</a>
    </div>

    <form method="GET" action="{{ route('kasir.transactions.index') }}" class="mb-4">
        <div class="join w-full md:max-w-lg">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                class="input input-bordered join-item w-full"
                placeholder="Cari nomor invoice"
            >
            <button type="submit" class="btn btn-primary join-item">Cari</button>
            <a href="{{ route('kasir.transactions.index') }}" class="btn btn-ghost join-item">Reset</a>
        </div>
    </form>

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>Invoice</th>
                    <th>Customer</th>
                    <th>Grand Total</th>
                    <th>Tanggal</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->invoice_number ?? 'INV-' . $transaction->id }}</td>
                        <td>{{ $transaction->customer?->name ?? $transaction->customer_name ?? 'Walk-in' }}</td>
                        <td>Rp {{ number_format($transaction->grand_total ?? $transaction->total, 0, ',', '.') }}</td>
                        <td>{{ $transaction->created_at->format('d M Y H:i') }}</td>
                        <td class="text-right space-x-2">
                            <a href="{{ route('kasir.transactions.show', $transaction) }}" class="btn btn-sm btn-info">Detail</a>
                            <a href="{{ route('kasir.transactions.print', $transaction) }}" target="_blank" class="btn btn-sm btn-secondary">Print</a>
                            <form action="{{ route('kasir.transactions.destroy', $transaction) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Yakin ingin menghapus transaksi ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-base-content/60 py-8">Belum ada transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $transactions->links() }}
    </div>
@endsection

