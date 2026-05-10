<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembelian - {{ $transaction->invoice_number ?? 'INV-' . $transaction->id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            color: #111827;
            background: #fff;
        }
        .receipt {
            max-width: 420px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 1.2rem;
        }
        .header p {
            margin: 4px 0;
            font-size: 0.9rem;
            color: #6b7280;
        }
        .details,
        .totals {
            width: 100%;
            margin-bottom: 16px;
            border-collapse: collapse;
        }
        .details td,
        .details th,
        .totals td,
        .totals th {
            padding: 6px 4px;
            font-size: 0.9rem;
            border-bottom: 1px solid #e5e7eb;
        }
        .details th {
            text-align: left;
            font-weight: 700;
        }
        .totals td {
            font-weight: 700;
        }
        .item-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
        }
        .item-table th,
        .item-table td {
            padding: 8px 4px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            font-size: 0.9rem;
        }
        .item-table th {
            font-weight: 700;
        }
        .total-row td {
            font-weight: 700;
            border-top: 2px solid #111827;
        }
        .thanks {
            margin-top: 16px;
            text-align: center;
            font-size: 0.9rem;
            color: #6b7280;
        }
        @media print {
            body {
                padding: 0;
            }
            .receipt {
                border: none;
                border-radius: 0;
                box-shadow: none;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>Struk Pembelian</h1>
            <p>Toko Laravel</p>
            <p>{{ $transaction->created_at->format('d M Y H:i') }}</p>
        </div>

        <table class="details">
            <tr>
                <th>Invoice</th>
                <td>{{ $transaction->invoice_number ?? 'INV-' . $transaction->id }}</td>
            </tr>
            <tr>
                <th>Pelanggan</th>
                <td>{{ $transaction->customer?->name ?? $transaction->customer_name ?? 'Walk-in' }}</td>
            </tr>
            <tr>
                <th>Jenis</th>
                <td>{{ $transaction->customer_type ?? 'Umum' }}</td>
            </tr>
        </table>

        <table class="item-table">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Qty</th>
                    <th>Sub</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction->products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->pivot->quantity }}</td>
                    <td>Rp {{ number_format($product->pivot->quantity * $product->pivot->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals">
            <tr>
                <td>Total</td>
                <td>Rp {{ number_format($transaction->total, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Diskon</td>
                <td>Rp {{ number_format($transaction->discount, 0, ',', '.') }}</td>
            </tr>
            <tr class="total-row">
                <td>Grand Total</td>
                <td>Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="thanks">
            Terima kasih telah berbelanja!
        </div>
    </div>

    <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>
</html>
