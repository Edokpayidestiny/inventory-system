<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Receipt</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 14px;
            color: #333;
        }
        .header, .footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 12px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }
        .table th {
            background: #f2f2f2;
        }
        .total {
            margin-top: 20px;
            font-weight: bold;
        }
        .meta {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="header">
        <h2>Sales Receipt</h2>
        <p>Reference No: {{ $sale->reference }}</p>
        <p>Date: {{ $sale->created_at->format('d M, Y h:i A') }}</p>
    </div>

    <div class="meta">
        <strong>Customer:</strong> {{ $sale->user->name ?? 'Guest' }}<br>
        <strong>Payment Method:</strong> {{ ucfirst($sale->payment_method ?? 'N/A') }}<br>
        <strong>Payment Status:</strong> {{ ucfirst($sale->payment_status) }}<br>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Price (NGN)</th>
                <th>Total (NGN)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sale->saleItems as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $item->product->name ?? 'Product' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ number_format($item->price, 2) }}</td>
                    <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Grand Total: NGN{{ number_format($sale->total_amount, 2) }}</p>

    <div class="footer">
        <p>Thank you for your purchase!</p>
    </div>

</body>
</html>
