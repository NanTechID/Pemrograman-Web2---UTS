@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Create Customer</h1>

    <form method="POST" action="{{ route('admin.customers.store') }}">
        @csrf

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Name</span></label>
            <input type="text" name="name" value="{{ old('name') }}" class="input input-bordered w-full" required />
        </div>

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Phone</span></label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="input input-bordered w-full" />
        </div>

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Email</span></label>
            <input type="email" name="email" value="{{ old('email') }}" class="input input-bordered w-full" />
        </div>

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Address</span></label>
            <textarea name="address" class="textarea textarea-bordered w-full">{{ old('address') }}</textarea>
        </div>

            <div class="form-control mb-4">
                <label class="label"><span class="label-text">Tipe Customer</span></label>
                <select name="customer_type" class="select select-bordered w-full" required>
                    <option value="Umum" @selected(old('customer_type') == 'Umum')>Umum</option>
                    <option value="Member" @selected(old('customer_type') == 'Member')>Member</option>
                </select>
            </div>

        <div class="form-control">
            <button type="submit" class="btn btn-primary">Save Customer</button>
        </div>
    </form>
@endsection
