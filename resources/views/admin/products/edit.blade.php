@extends('layouts.admin')

@section('content')
    <div class="max-w-xl">
        <h1 class="text-2xl font-semibold mb-4">Edit Product</h1>

        <form action="{{ route('admin.products.update', $product) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="label" for="name">
                    <span class="label-text">Product Name</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="input input-bordered w-full" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label" for="category_id">
                    <span class="label-text">Category</span>
                </label>
                <select id="category_id" name="category_id" class="select select-bordered w-full" required>
                    <option value="">Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="label" for="price">
                        <span class="label-text">Price</span>
                    </label>
                    <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $product->price) }}" class="input input-bordered w-full" required>
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="label" for="stock">
                        <span class="label-text">Stock</span>
                    </label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" class="input input-bordered w-full" required>
                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline">Back</a>
                <button type="submit" class="btn btn-primary">Update Product</button>
            </div>
        </form>
    </div>
@endsection
