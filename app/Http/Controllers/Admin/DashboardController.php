<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $total_users = User::query()->count();
        $total_categories = Category::query()->count();
        $total_products = Product::query()->count();
        $total_transactions = Transaction::query()->count();

        $total_stock = Product::query()->sum('stock');

        $daily_sales = Transaction::query()->whereDate('created_at', Carbon::today())
            ->sum('grand_total'); 

        // Role-based user stats for admin role grouping
        $admin_users = User::query()->where('role', 'admin')->count();
        $kasir_users = User::query()->where('role', 'kasir')->count();

        // Customer type breakdown for admin categorization
        $customer_type_stats = Transaction::query()->selectRaw("COALESCE(customer_type, 'Unknown') as customer_type, COUNT(*) as count, SUM(grand_total) as total")
            ->groupByRaw("COALESCE(customer_type, 'Unknown')")
            ->get(); 

        $customer_type_labels = $customer_type_stats->pluck('customer_type')->unique()->values()->toArray();
        $customer_type_counts = $customer_type_stats->pluck('count')->values()->toArray();
        $customer_type_totals = $customer_type_stats->pluck('total')->values()->toArray();

        $weekly_sales = Transaction::query()->whereBetween('created_at', [
            Carbon::now()->startOfWeek(),
            Carbon::now()->endOfWeek()
        ])->sum('grand_total');

        $monthly_sales = Transaction::query()->whereMonth('created_at', Carbon::now()->month)
            ->sum('grand_total');

        $top_products = TransactionDetail::query()->select('product_id', DB::raw('SUM(quantity) as sold'))
            ->groupBy('product_id')
            ->orderByDesc('sold')
            ->with('product')
            ->limit(5)
            ->get();

        $sold_product_ids = TransactionDetail::query()->select('product_id')->distinct()->pluck('product_id')->toArray();
        $unsold_products = Product::query()->whereNotIn('id', $sold_product_ids)->get();

        // Fixed daily sales with all 7 days (fill missing days) and Indonesian labels
        $startDate = Carbon::now()->subDays(6);
        $endDate = Carbon::now();
        $dateRange = collect();
        for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
            $dateRange->push($date->format('Y-m-d'));
        }

        $sales_last_7_days = Transaction::query()->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COALESCE(SUM(grand_total), 0) as total')
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $sales_labels = $dateRange->map(fn($date) => Carbon::parse($date)->translatedFormat('d M'))->toArray();
        $sales_data = $dateRange->map(fn($date) => $sales_last_7_days->get($date)?->total ?? 0)->values()->toArray();

        $sales_by_month = Transaction::query()->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                DB::raw('SUM(grand_total) as total')
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $monthly_labels = $sales_by_month
            ->pluck('month')
            ->map(fn ($month) => Carbon::createFromFormat('Y-m', $month)->translatedFormat('MMM yy'))
            ->values()
            ->toArray();
        $monthly_data = $sales_by_month->pluck('total')->toArray();

        // Improved category distribution with 'Others' for completeness
        $all_categories = Category::query()->withCount('products')->orderByDesc('products_count')->get();
        $top_categories = $all_categories->take(5);
        $others_count = $all_categories->slice(5)->sum('products_count');

        $category_labels = $top_categories->pluck('name')->push('Lainnya')->toArray();
        $category_data = $top_categories->pluck('products_count')->push($others_count)->toArray();

        // Ambil produk dengan stok menipis (< 10) atau habis
        $low_stock_products = Product::query()->where('stock', '<', 10)->orderBy('stock', 'asc')->get();

        return view('admin.dashboard', [
            'total_users' => $total_users,
            'total_categories' => $total_categories,
            'total_products' => $total_products,
            'total_transactions' => $total_transactions,
            'total_stock'   => $total_stock,
            'daily_sales'   => $daily_sales,
            'weekly_sales'  => $weekly_sales,
            'monthly_sales' => $monthly_sales,
            'top_products'  => $top_products,
            'unsold_products' => $unsold_products,
            'sales_labels'  => $sales_labels,
            'sales_data'    => $sales_data,
            'monthly_labels' => $monthly_labels,
            'monthly_data' => $monthly_data,
            'category_labels' => $category_labels,
            'category_data' => $category_data,
            'low_stock_products' => $low_stock_products,
            'admin_users' => $admin_users,
            'kasir_users' => $kasir_users,
            'customer_type_labels' => $customer_type_labels,
            'customer_type_counts' => $customer_type_counts,
            'customer_type_totals' => $customer_type_totals,
        ]);
    }
}

