@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Edit User</h1>

    <form method="POST" action="{{ route('admin.users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-control mb-4">
            <label for="name" class="label">
                <span class="label-text">Name</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label for="username" class="label">
                <span class="label-text">Username</span>
            </label>
            <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label for="email" class="label">
                <span class="label-text">Email</span>
            </label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label for="phone" class="label">
                <span class="label-text">Phone</span>
            </label>
            <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label for="password" class="label">
                <span class="label-text">Password</span>
            </label>
            <input type="password" id="password" name="password" class="input input-bordered w-full" />
            <span class="text-sm text-gray-500">Leave blank to keep current password.</span>
        </div>

        <div class="form-control mb-4">
            <label for="role" class="label">
                <span class="label-text">Role</span>
            </label>
            <select name="role" id="role" class="select select-bordered w-full">
                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="kasir" {{ $user->role === 'kasir' ? 'selected' : '' }}>Kasir</option>
            </select>
        </div>

        <div class="form-control mb-4">
            <button type="submit" class="btn btn-primary w-full">Update User</button>
        </div>
    </form>
@endsection
