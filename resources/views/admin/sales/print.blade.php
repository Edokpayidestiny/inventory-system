<!DOCTYPE html>
<html>
<head>
    <title>Sales Print View</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body onload="window.print()">

    <h2>Sales History</h2>

    <table>
        <thead>
            <tr>
                <th>Reference</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->reference }}</td>
                    <td>{{ $sale->user->name ?? 'N/A' }}</td>
                    <td>{{ $sale->created_at->format('Y-m-d') }}</td>
                    <td>₦{{ number_format($sale->total_amount, 2) }}</td>
                    <td>{{ ucfirst($sale->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
