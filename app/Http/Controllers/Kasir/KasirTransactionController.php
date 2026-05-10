<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirTransactionController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $transactions = Transaction::with('customer')
            ->when($search, function ($query, $search) {
                return $query->where('invoice_number', 'like', "%{$search}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('kasir.transactions.index', compact('transactions', 'search'));
    }

    public function create()
    {
        $customers = Customer::all();
        $categories = Category::with(['products' => function ($query) {
            $query->where('stock', '>', 0);
        }])->get();
        $products = Product::where('stock', '>', 0)->get();

        return view('kasir.transactions.create', compact('customers', 'categories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'customer_name' => 'nullable|string|max:255',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'customer_type' => 'required|string|in:Umum,Member,Reseller',
        ]);

        $transaction = DB::transaction(function () use ($request) {
            $total = 0;
            $items = [];

            foreach ($request->products as $item) {
                $product = Product::findOrFail($item['product_id']);

                $subtotal = $product->price * $item['quantity'];
                $total += $subtotal;

                $items[] = [
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ];

                $product->decrement('stock', $item['quantity']);
            }

            // Cek jika customer adalah member, diskon 5%
            $type = $request->customer_type;

            switch ($type) {
                case 'Member':
                    $discount = $total * 0.05;
                    break;
                default: // Umum
                    $discount = $total > 200000 ? $total * 0.02 : 0;
                    break;
            }
            $finalTotal = $total - $discount;

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'customer_id' => $request->customer_id,
                'customer_name' => $request->customer_name,
                'customer_type' => $request->customer_type,
                'invoice_number' => 'INV-'.strtoupper(uniqid()),
                'total' => $finalTotal,
                'discount' => $discount,
                'grand_total' => $finalTotal,
            ]);

            $attachData = [];
            foreach ($items as $item) {
                $attachData[$item['product_id']] = [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ];
            }

            $transaction->products()->attach($attachData);

            return $transaction;
        });

        return redirect()->route('kasir.transactions.show', $transaction)->with('success', 'Transaksi berhasil disimpan.');
    }

    public function print(Transaction $transaction)
    {
        $transaction->load('customer', 'products');

        return view('kasir.transactions.print', compact('transaction'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('customer', 'products');

        return view('kasir.transactions.show', compact('transaction'));
    }

    public function destroy(Transaction $transaction)
    {
        Transaction::destroy($transaction->id);

        return redirect()->route('kasir.transactions.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
