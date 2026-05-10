@extends('layouts.guest')

@section('content')
<div class="flex justify-center items-center min-h-screen bg-base-200">
    <div class="card w-96 bg-base-100 shadow-xl p-6">
        <h2 class="text-2xl font-bold text-center mb-4">Input Data Pegawai</h2>
        <p class="text-sm text-gray-600 mb-4">OTP berhasil diverifikasi. Halaman ini masih placeholder untuk input data pegawai.</p>
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-primary w-full">Kembali ke Login</a>
        </div>
    </div>
</div>
@endsection
