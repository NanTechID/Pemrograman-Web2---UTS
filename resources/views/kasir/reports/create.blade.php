@extends('layouts.kasir')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold">Buat Laporan</h1>
        <a href="{{ route('kasir.reports.index') }}" class="btn btn-ghost">Kembali</a>
    </div>

    <div class="card bg-base-100 shadow-xl border border-base-200">
        <div class="card-body">
            <h2 class="card-title">Halaman Siap Digunakan</h2>
            <p class="text-base-content/70">
                View untuk membuat laporan kasir sudah tersedia.
                Endpoint penyimpanan laporan belum diaktifkan pada route kasir saat ini.
            </p>
            <div class="card-actions justify-end mt-4">
                <a href="{{ route('kasir.reports.index') }}" class="btn btn-primary">Lihat Daftar Laporan</a>
            </div>
        </div>
    </div>
@endsection
