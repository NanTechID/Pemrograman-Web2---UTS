@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">User Details</h1>

    <div class="card w-full max-w-lg bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">{{ $user->name }}</h2>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Phone:</strong> {{ $user->phone }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
            <p><strong>Created At:</strong> {{ $user->created_at->format('d M Y') }}</p>
            <p><strong>Updated At:</strong> {{ $user->updated_at->format('d M Y') }}</p>

            <div class="card-actions justify-end mt-4">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-error">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
