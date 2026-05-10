@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Edit Transaction</h1>

    <form method="POST" action="{{ route('admin.transactions.update', $transaction) }}">
        @csrf
        @method('PUT')

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Customer</span></label>
            <select name="customer_id" class="select select-bordered w-full">
                <option value="">Walk-in Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" {{ $transaction->customer_id === $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Transaction</button>
    </form>
@endsection
