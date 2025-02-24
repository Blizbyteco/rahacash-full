<x-layout>
    <div class="row">
        <div class="col-sm-4">
            <div class="card bg-success p-4">
                <h1 class="text-xl">RP. {{ number_format($income, 0, ',', '.') }}</h1>
                <p class="text-sm">Income</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-danger p-4">
                <h1 class="text-xl">RP. {{ number_format($outcome, 0, ',', '.') }}</h1>
                <p class="text-sm">Outcome</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-primary p-4">
                <h1 class="text-xl">{{ $employee }}</h1>
                <p class="text-sm">Karyawan</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2 class="text-md text-center py-4">Grafik Transaksi Dalam Sebulan</h2>
            <canvas id="transactionChart"></canvas>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('transactionChart').getContext('2d');
        const transactionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! $dates !!},
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: {!! $incomes !!},
                        borderColor: 'green',
                        backgroundColor: 'rgba(0, 255, 0, 0.2)',
                        fill: true,
                        tension: 0.3
                    },
                    {
                        label: 'Pengeluaran',
                        data: {!! $outcomes !!},
                        borderColor: 'red',
                        backgroundColor: 'rgba(255, 0, 0, 0.2)',
                        fill: true,
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tanggal'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah (Rp)'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-layout>