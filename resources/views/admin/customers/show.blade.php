@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Customer Details</h1>

    <div class="card w-full max-w-lg bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">{{ $customer->name }}</h2>
            <p><strong>Phone:</strong> {{ $customer->phone }}</p>
            <p><strong>Email:</strong> {{ $customer->email }}</p>
            <p><strong>Address:</strong> {{ $customer->address }}</p>
            <p><strong>Created At:</strong> {{ $customer->created_at->format('d M Y') }}</p>

            <div class="card-actions justify-end mt-4">
                <a href="{{ route('admin.customers.edit', $customer) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.customers.destroy', $customer) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
