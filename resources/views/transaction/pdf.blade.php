<!DOCTYPE html>
<html>
<head>
    <title>Laporan Transaksi</title>
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
    @if(request('start_date') && request('end_date'))
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Transaksi</h2>
            <p style="font-size: 0.7em;">{{ request('start_date') }} - {{ request('end_date') }}</p>
        </div>
    @else
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>Transaksi</h2>
            <p style="font-size: 0.7em;">Seluruh transaksi</p>
        </div>
    @endif
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tanggal</th>
                <th>Pengelola</th>
                <th>Keterangan</th>
                <th>Metode Pembayaran</th>
                <th>Jenis</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $key => $transaction)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $transaction->created_at }}</td>
                <td>{{ $transaction->user->name }}</td>
                <td>{{ $transaction->description }}</td>
                <td>{{ $transaction->payment }}</td>
                <td>{{ $transaction->type === 'income' ? 'Pemasukan' : 'Pengeluaran' }}</td>
                <td>{{ number_format($transaction->amount, 0, ',', '.') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <b>Total Keseluruhan</b>
                </td>
                <td colspan="3">Rp. {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
