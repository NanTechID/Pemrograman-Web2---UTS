@extends('layouts.kasir')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Edit Laporan</h1>
        <a href="{{ route('kasir.reports.index') }}" class="btn btn-ghost">Kembali</a>
    </div>

    <div class="card bg-base-100 shadow-xl border border-base-200">
        <div class="card-body">
            <h2 class="card-title">Fitur Belum Tersedia</h2>
            <p class="text-base-content/70">
                View edit laporan kasir sudah dibuat, tetapi route update laporan untuk kasir belum diaktifkan.
            </p>
            <div class="card-actions justify-end mt-4">
                <a href="{{ route('kasir.reports.index') }}" class="btn btn-primary">Kembali ke Daftar</a>
            </div>
        </div>
    </div>
@endsection
