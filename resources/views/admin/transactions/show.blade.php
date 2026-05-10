@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-semibold mb-4">Transaction Details</h1>

    <div class="card bg-base-100 shadow-xl">
        <div class="card-body">
            <h2 class="card-title">Invoice #{{ $transaction->invoice_number }}</h2>
            <p><strong>Customer:</strong>
                @if ($transaction->customer_id)
                    {{ $transaction->customer?->name ?? '-' }}
                @else
                    {{ $transaction->customer_name ?? 'Walk-in' }}
                @endif
            </p>
            <p><strong>Total:</strong> Rp {{ number_format($transaction->total, 0, ',', '.') }}</p>
            <p><strong>Discount:</strong> Rp {{ number_format($transaction->discount, 0, ',', '.') }}</p>
            <p><strong>Grand Total:</strong> Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</p>
            <p><strong>Date:</strong> {{ $transaction->created_at->format('d M Y') }}</p>

            <div class="card-actions justify-end mt-4">
                <a href="{{ route('admin.transactions.edit', $transaction) }}" class="btn btn-warning">Edit</a>
                <a href="{{ route('admin.transactions.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
@endsection
