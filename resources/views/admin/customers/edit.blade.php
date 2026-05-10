@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Edit Customer</h1>

    <form method="POST" action="{{ route('admin.customers.update', $customer) }}">
        @csrf
        @method('PUT')

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Name</span></label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Phone</span></label>
            <input type="text" name="phone" value="{{ old('phone', $customer->phone) }}" class="input input-bordered w-full" />
        </div>

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Email</span></label>
            <input type="email" name="email" value="{{ old('email', $customer->email) }}" class="input input-bordered w-full" />
        </div>

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Address</span></label>
            <textarea name="address" class="textarea textarea-bordered w-full">{{ old('address', $customer->address) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Customer</button>
    </form>
@endsection
