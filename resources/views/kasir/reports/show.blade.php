@extends('layouts.kasir')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Detail Laporan</h1>
        <a href="{{ route('kasir.reports.index') }}" class="btn btn-ghost">Kembali</a>
    </div>

    <div class="card bg-base-100 shadow-xl border border-base-200">
        <div class="card-body">
            <h2 class="card-title">Template Detail Laporan</h2>
            <p class="text-base-content/70">
                Halaman ini disiapkan sebagai view detail laporan kasir.
                Anda bisa menghubungkannya ke data laporan spesifik saat route show diaktifkan.
            </p>
            <div class="card-actions justify-end mt-4">
                <a href="{{ route('kasir.reports.index') }}" class="btn btn-primary">Kembali ke Laporan</a>
            </div>
        </div>
    </div>
@endsection
