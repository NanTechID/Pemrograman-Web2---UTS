@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Create Transaction</h1>

    <form method="POST" action="{{ route('admin.transactions.store') }}">
        @csrf

        <div class="form-control mb-4">
            <label class="label"><span class="label-text">Customer</span></label>
            <select name="customer_id" class="select select-bordered w-full">
                <option value="">Walk-in Customer</option>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="overflow-x-auto mb-4">
            <table class="table w-full">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <input type="number" name="products[{{ $product->id }}]" min="0" value="0" class="input input-bordered w-24" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button type="submit" class="btn btn-primary">Save Transaction</button>
    </form>
@endsection
