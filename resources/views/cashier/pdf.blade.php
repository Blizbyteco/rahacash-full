<!DOCTYPE html>
<html>
<head>
    <title>Invoice#{{ $transaction->id }}</title>
    <style>
        body {
            font-family: sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #888;
        }
        th, td {
            padding: 8px;
            text-align: left;
            font-size: 0.7em;
        }
    </style>
</head>
<body>
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2>Invoice#{{ $transaction->id }}</h2>
        <p style="font-size: 0.7em;">{{ $transaction->created_at }}</p>
        <p style="font-size: 0.7em;">Nama Kustomer: {{ $transaction->customer_name }}</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $detail)
                <tr>
                    <td>{{
                        $detail->sparepart === null ? 'Service' :
                        $detail->sparepart->name 
                    }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>Rp {{ number_format($detail->amount, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" style="border: none;">
                </td>
                <td colspan="1" style="display: flex; justify-content: space-between; border: none;">
                    <b>Total Keseluruhan</b>
                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
