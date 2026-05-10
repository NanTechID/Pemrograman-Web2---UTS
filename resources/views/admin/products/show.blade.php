@extends('layouts.admin')

@section('content')
    <div class="max-w-xl">
        <h1 class="text-2xl font-semibold mb-4">Product Details</h1>

        <div class="card bg-base-100 shadow-md p-6">
            <div class="space-y-3">
                <div>
                    <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                    <p class="text-sm text-base-content/70">Category: {{ $product->category?->name ?? 'Uncategorized' }}</p>
                </div>
                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2">
                    <div>
                        <span class="text-sm text-base-content/70">Price</span>
                        <p class="text-lg font-semibold">{{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <span class="text-sm text-base-content/70">Stock</span>
                        <p class="text-lg font-semibold">{{ $product->stock }}</p>
                    </div>
                </div>
                <div class="text-sm text-base-content/70">Created at {{ $product->created_at->format('Y-m-d H:i') }}</div>
            </div>
            <div class="mt-6 flex gap-3">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Back</a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">Edit</a>
            </div>
        </div>
    </div>
@endsection
