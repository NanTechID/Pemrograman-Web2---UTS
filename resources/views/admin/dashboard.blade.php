@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    {{-- Low Stock Notification --}}
    @if(isset($low_stock_products) && $low_stock_products->count())
        <div class="mb-4">
            <div class="rounded-xl bg-red-100 border border-red-300 p-4 text-red-800">
                <strong>Notifikasi Stok Menipis/Habis:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach($low_stock_products as $product)
                        <li>
                            <span class="font-semibold">{{ $product->name }}</span>:
                            @if($product->stock == 0)
                                <span class="text-red-600 font-bold">Stok Habis!</span>
                            @else
                                <span class="text-orange-600 font-semibold">Sisa {{ $product->stock }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Welcome --}}
    <div class="content-panel">
        <h1 class="text-3xl font-semibold">Welcome back, Admin!</h1>
        <p class="mt-2 text-slate-500">Kelola data master, pengguna, transaksi, dan laporan.</p>
    </div>

    {{-- Navigation Cards --}}
    <div class="grid gap-4 lg:grid-cols-5">
        <a href="{{ route('admin.users.index') }}" class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm hover:shadow-md transition-all">
            <div class="text-3xl font-bold text-primary mb-2">👥 {{ number_format($total_users) }}</div>
            <p class="text-sm text-slate-600">Users</p>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm hover:shadow-md transition-all">
            <div class="text-3xl font-bold text-secondary mb-2">📂 {{ number_format($total_categories) }}</div>
            <p class="text-sm text-slate-600">Categories</p>
        </a>
        <a href="{{ route('admin.products.index') }}" class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm hover:shadow-md transition-all">
            <div class="text-3xl font-bold text-accent mb-2">📦 {{ number_format($total_products) }}</div>
            <p class="text-sm text-slate-600">Products</p>
        </a>
        <a href="{{ route('admin.transactions.index') }}" class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm hover:shadow-md transition-all">
            <div class="text-3xl font-bold text-info mb-2">💰 {{ number_format($total_transactions) }}</div>
            <p class="text-sm text-slate-600">Transactions</p>
        </a>
        <a href="{{ route('admin.reports.index') }}" class="rounded-2xl border border-slate-200 bg-white p-6 text-center shadow-sm hover:shadow-md transition-all">
            <div class="text-3xl font-bold text-warning mb-2">📊</div>
            <p class="text-sm text-slate-600">Reports</p>
        </a>
    </div>

    {{-- Stats Cards --}}
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="stat bg-primary text-primary-content rounded-2xl shadow-lg">
            <div class="stat-figure text-2xl">👥</div>
            <div class="stat-title">Total Users</div>
            <div class="stat-value">{{ number_format($total_users) }}</div>
        </div>
        <div class="stat bg-secondary text-secondary-content rounded-2xl shadow-lg">
            <div class="stat-figure text-2xl">📂</div>
            <div class="stat-title">Categories</div>
            <div class="stat-value">{{ number_format($total_categories) }}</div>
        </div>
        <div class="stat bg-accent text-accent-content rounded-2xl shadow-lg">
            <div class="stat-figure text-2xl">📦</div>
            <div class="stat-title">Products</div>
            <div class="stat-value">{{ number_format($total_products) }}</div>
        </div>
        <div class="stat bg-info text-info-content rounded-2xl shadow-lg">
            <div class="stat-figure text-2xl">💰</div>
            <div class="stat-title">Transactions</div>
            <div class="stat-value">{{ number_format($total_transactions) }}</div>
        </div>
    </div>

    {{-- Key Metrics --}}
    <div class="grid gap-4 md:grid-cols-3">
        <div class="stat bg-success text-success-content rounded-2xl shadow-lg">
            <div class="stat-title">Total Stock</div>
            <div class="stat-value">{{ number_format($total_stock) }}</div>
        </div>
        <div class="stat bg-warning text-warning-content rounded-2xl shadow-lg">
            <div class="stat-title">Daily Sales</div>
            <div class="stat-value">Rp {{ number_format($daily_sales, 0, ',', '.') }}</div>
        </div>
        <div class="stat bg-error text-error-content rounded-2xl shadow-lg">
            <div class="stat-title">Monthly Sales</div>
            <div class="stat-value">Rp {{ number_format($monthly_sales, 0, ',', '.') }}</div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid gap-6 lg:grid-cols-2">
        <div class="content-panel">
            <h2 class="text-xl font-semibold mb-4">Distribusi Kategori</h2>
            <div class="h-64">
                <canvas id="categoryChart"></canvas>
            </div>
        </div>
        <div class="content-panel">
            <h2 class="text-xl font-semibold mb-4">Penjualan 7 Hari Terakhir</h2>
            <div class="h-64">
                <canvas id="dailySalesChart"></canvas>
            </div>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="content-panel">
            <h2 class="text-xl font-semibold mb-4">Top Products & New</h2>
            <div class="grid gap-4 md:grid-cols-2 h-64 overflow-y-auto">
                <div>
                    <h3 class="font-semibold mb-2">Top Sold</h3>
                    <ul class="space-y-1 text-sm">
                        @forelse($top_products as $item)
                            <li>{{ $item->product?->name ?? 'N/A' }} ({{ $item->sold }})</li>
                        @empty
                            <li>Tidak ada penjualan</li>
                        @endforelse
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold mb-2">Belum Terjual</h3>
                    <p class="text-sm text-slate-500">{{ $unsold_products->count() }} items</p>
                </div>
            </div>
        </div>
        <div class="content-panel">
            <h2 class="text-xl font-semibold mb-4">Trend Penjualan Toko</h2>
            <div class="h-64">
                <canvas id="salesTrendChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data from controller
    const categoryLabels = @json($category_labels);
    const categoryData = @json($category_data);
    const dailyLabels = @json($sales_labels);
    const dailyData = @json($sales_data);

    // Simple chart config
    const simpleOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom'
            }
        },
        scales: {
            x: {
                ticks: {
                    autoSkip: false,
                    maxRotation: 90,
                    minRotation: 45,
                    align: 'start',
                    padding: 10,
                    callback: function(value, index, values) {
                        const maxLabels = 6;
                        const step = Math.max(1, Math.ceil(values.length / maxLabels));
                        return index % step === 0 ? this.getLabelForValue(value) : '';
                    }
                },
                grid: {
                    display: false
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    drawBorder: false
                }
            }
        }
    };

    // Category Doughnut - Simple
    new Chart(document.getElementById('categoryChart'), {
        type: 'doughnut',
        data: {
            labels: categoryLabels,
            datasets: [{
                data: categoryData,
                backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#06B6D4']
            }]
        },
        options: simpleOptions
    });

    // Daily Bar - Simple
    new Chart(document.getElementById('dailySalesChart'), {
        type: 'bar',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Harian',
                data: dailyData,
                backgroundColor: '#10B981' // success
            }]
        },
        options: simpleOptions
    });

    // Sales Trend - Line chart
    new Chart(document.getElementById('salesTrendChart'), {
        type: 'line',
        data: {
            labels: dailyLabels,
            datasets: [{
                label: 'Trend Penjualan',
                data: dailyData,
                borderColor: '#2563EB',
                backgroundColor: 'rgba(37, 99, 235, 0.12)',
                fill: true,
                tension: 0.3,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: simpleOptions
    });
</script>
@endsection

