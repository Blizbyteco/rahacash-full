<x-layout>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Transaksi</h3>
        </div>
        <div class="card-body">
        <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td>{{ $transaction->user->name }}</td>
                </tr>
                <tr>
                    <th>Total</th>
                    <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $transaction->description }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    <td>{{ $transaction->payment }}</td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>{{ $transaction->created_at }}</td>
                </tr>
            </table>
            
            <h5 class="mt-4">Detail</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction->details as $key => $detail)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ ucfirst($detail->type) }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>Rp {{ number_format($detail->amount, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
