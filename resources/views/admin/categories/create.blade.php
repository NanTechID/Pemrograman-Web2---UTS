@extends('layouts.admin')

@section('content')
    <div class="max-w-xl">
        <h1 class="text-2xl font-semibold mb-4">Create Category</h1>

        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="label" for="name">
                    <span class="label-text">Category Name</span>
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" class="input-stroke input input-bordered w-full" required>

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline">Back</a>
                <button type="submit" class="btn btn-primary">Save Category</button>
            </div>
        </form>
    </div>
@endsection
