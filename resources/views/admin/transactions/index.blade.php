@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-semibold">Transactions</h1>
        <a href="{{ route('admin.transactions.create') }}" class="btn btn-primary">New Transaction</a>
    </div>

    <div class="overflow-x-auto">
        <table class="table table-zebra w-full">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Discount</th>
                    <th>Grand Total</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->customer?->name ?? 'Walk-in' }}</td>
                        <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($transaction->discount, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</td>
                        <td>{{ $transaction->created_at->format('d M Y') }}</td>
                        <td class="space-x-2">
                            <a href="{{ route('admin.transactions.show', $transaction) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.transactions.edit', $transaction) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.transactions.destroy', $transaction) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $transactions->links() }}
@endsection
