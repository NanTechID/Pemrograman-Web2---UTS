<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->startOfDay();
        
        // Today stats
        $today_transactions = \App\Models\Transaction::where('created_at', '>=', $today)->count();
        $today_sales = \App\Models\Transaction::where('created_at', '>=', $today)->sum('grand_total') ?? 0;
        
        // Recent transactions (last 5)
        $recent_transactions = \App\Models\Transaction::with(['customer'])
            ->latest()
            ->limit(5)
            ->get();
        
        // Low stock products (stock < 10)
        $low_stock_items = \App\Models\Product::where('stock', '<', 10)->orderBy('stock', 'asc')->get(['id', 'name', 'stock']);
        $low_stock = $low_stock_items->count();
        
        return view('kasir.dashboard', compact(
            'today_transactions',
            'today_sales',
            'recent_transactions',
            'low_stock',
            'low_stock_items'
        ));
    }
}

