@extends('layouts.admin')

@section('content')
    <div class="max-w-xl">
        <h1 class="text-2xl font-semibold mb-4">Category Details</h1>

        <div class="card bg-base-100 shadow-md p-6 mb-6">
            <div class="mb-3">
                <h2 class="text-xl font-semibold">{{ $category->name }}</h2>
                <p class="text-sm text-base-content/70">Created at {{ $category->created_at->format('Y-m-d H:i') }}</p>
            </div>
            <div class="flex gap-3 mb-2">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Back</a>
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>

        <div class="card bg-base-100 shadow p-6">
            <h3 class="text-lg font-semibold mb-3">Daftar Produk dalam Kategori Ini</h3>
            @if ($category->products->count())
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-base-content/60">Belum ada produk dalam kategori ini.</div>
            @endif
        </div>
    </div>
@endsection
