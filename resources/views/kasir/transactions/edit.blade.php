@extends('layouts.kasir')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Edit Transaksi</h1>
        <a href="{{ route('kasir.transactions.index') }}" class="btn btn-ghost">Kembali</a>
    </div>

    <div class="card bg-base-100 shadow-xl border border-base-200">
        <div class="card-body">
            <h2 class="card-title">Fitur Belum Tersedia</h2>
            <p class="text-base-content/70">
                Halaman edit transaksi kasir sudah disiapkan sebagai view,
                namun endpoint update belum diaktifkan di route kasir.
            </p>
            <div class="card-actions justify-end mt-4">
                <a href="{{ route('kasir.transactions.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
            </div>
        </div>
    </div>
@endsection
