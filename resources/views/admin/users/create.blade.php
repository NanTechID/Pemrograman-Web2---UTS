@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Create New User</h1>

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf
        <div class="form-control mb-4">
            <label for="name" class="label">
                <span class="label-text">Name</span>
            </label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label for="username" class="label">
                <span class="label-text">Username</span>
            </label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label for="email" class="label">
                <span class="label-text">Email</span>
            </label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label for="phone" class="label">
                <span class="label-text">Phone</span>
            </label>
            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label for="password" class="label">
                <span class="label-text">Password</span>
            </label>
            <input type="password" id="password" name="password" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label for="role" class="label">
                <span class="label-text">Role</span>
            </label>
            <select name="role" id="role" class="select select-bordered w-full">
                <option value="admin">Admin</option>
                <option value="kasir" selected>Kasir</option>
            </select>
        </div>

        <div class="form-control mb-4">
            <button type="submit" class="btn btn-primary w-full">Create User</button>
        </div>
    </form>
@endsection
