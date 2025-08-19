<!DOCTYPE html>
<html>
<head>
    <title>Print Sale #{{ $sale->uuid }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        h1 { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 30px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body onload="window.print()">

    <h1>Sale Receipt</h1>
    <p><strong>Reference:</strong> {{ $sale->reference }}</p>
    <p><strong>Date:</strong> {{ $sale->created_at->format('d M Y, h:i A') }}</p>
    <p><strong>Customer:</strong> {{ $sale->user->name ?? 'Guest' }}</p>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sale->saleItems as $item)
                <tr>
                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₦{{ number_format($item->price, 2) }}</td>
                    <td>₦{{ number_format($item->quantity * $item->price, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="text-align: right;">Total: ₦{{ number_format($sale->total_amount, 2) }}</h3>

</body>
</html>
