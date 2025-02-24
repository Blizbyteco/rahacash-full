<x-layout>
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3 class="card-title">Transaksi Pengeluaran</h3>
                <form method="GET" action="{{ route('transaction.outcome.export-pdf') }}">
                    <input type="hidden" name="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" value="{{ request('end_date') }}">
                    <button type="submit" class="btn btn-success">Download PDF</button>
                </form>
            </div>
        </div>

        <div class="card-body">

            <form method="GET" action="" class="mb-3">
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date" class="form-label">Dari Tanggal:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" class="form-label">Sampai Tanggal:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                    </div>
                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Total</th>
                        <th>Keterangan</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $key => $transaction)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $transaction->user->name }}</td>
                        <td>Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                        <td>{{ $transaction->description }}</td>
                        <td>{{ $transaction->payment }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td>
                            <a href="/transaction/outcome/{{ $transaction->id }}/detail" class="btn btn-info btn-sm">detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $transactions->links() }}
    </div>

</x-layout>