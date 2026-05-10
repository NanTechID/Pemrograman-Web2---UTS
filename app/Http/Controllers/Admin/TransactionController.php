<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\Product;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('customer')->paginate(10);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.transactions.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        DB::transaction(function() use ($request) {
            $transaction = Transaction::create([
                'user_id' => Auth::user()->id,
                'customer_id' => $request->customer_id,
                'grand_total' => 0,
                'discount' => 0,
                'total' => 0,
                'invoice_number' => 'INV-' . strtoupper(uniqid()),
            ]);

            $grandTotal = 0;
            foreach ($request->products as $product_id => $quantity) {
                $product = Product::find($product_id);
                if ($quantity > 0 && $product) {
                    TransactionDetail::create([
                        'transaction_id' => $transaction->id,
                        'product_id' => $product_id,
                        'quantity' => $quantity,
                        'price' => $product->price,
                    ]);
                    $grandTotal += $quantity * $product->price;

                    $product->decrement('stock', $quantity);
                }
            }

            $discount = 0;
            if ($grandTotal >= 200000) {
                $discount = $grandTotal * 0.02;
            }

            $transaction->update([
                'grand_total' => $grandTotal - $discount,
                'discount' => $discount,
                'total' => $grandTotal,
            ]);
        });

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('admin.transactions.edit', compact('transaction', 'customers', 'products'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
        ]);

        $transaction->update([
            'customer_id' => $request->customer_id,
        ]);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
