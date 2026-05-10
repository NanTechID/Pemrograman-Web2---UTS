@extends('layouts.kasir')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Detail Transaksi</h1>
        <div class="flex gap-2">
            <a href="{{ route('kasir.transactions.print', $transaction) }}" target="_blank" class="btn btn-primary px-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Struk
            </a>
            <a href="{{ route('kasir.transactions.index') }}" class="btn btn-ghost px-6">Kembali</a>
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl mb-6">
        <div class="card-body">
            <h2 class="card-title">Invoice #{{ $transaction->invoice_number ?? 'INV-' . $transaction->id }}</h2>
            <p><strong>Pelanggan:</strong> {{ $transaction->customer?->name ?? $transaction->customer_name ?? 'Walk-in' }}</p>
                <p><strong>Jenis Pelanggan:</strong> {{ $transaction->customer_type ?? '-' }}</p>
            <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
            <p><strong>Diskon:</strong> Rp {{ number_format($transaction->discount, 0, ',', '.') }}</p>
            <p><strong>Grand Total:</strong> Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</p>
            <p><strong>Tanggal:</strong> {{ $transaction->created_at->format('d M Y H:i') }}</p>
        </div>
    </div>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Item Produk</h2>
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Qty</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaction->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>Rp {{ number_format($product->pivot->price, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($product->pivot->quantity * $product->pivot->price, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-base-content/60">Tidak ada item produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
