<x-layout>
    <div class="row">
        <div class="col-sm-4">
            <div class="card bg-success p-4">
                <h1 class="text-xl">Rp. {{ number_format($income, 0, ',', '.') }}</h1>
                <p class="text-sm">Income</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-danger p-4">
                <h1 class="text-xl">Rp. {{ number_format($outcome, 0, ',', '.') }}</h1>
                <p class="text-sm">Outcome</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-primary p-4">
                <h1 class="text-xl">Rp. {{ number_format($income - $outcome, 0, ',', '.') }}</h1>
                <p class="text-sm">Keuntungan</p>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h2 class="text-md text-center py-4">Grafik Transaksi Berdasarkan Bulan</h2>

            <div class="row">
                <div class="col-6">
                    <select id="month" class="form-control">
                        <option value="">Pilih Bulan</option>
                        @foreach ([
                            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret', '04' => 'April', 
                            '05' => 'Mei', '06' => 'Juni', '07' => 'Juli', '08' => 'Agustus', 
                            '09' => 'September', '10' => 'Oktober', '11' => 'November', '12' => 'Desember'
                        ] as $key => $monthName)
                            <option value="{{ $key }}" {{ $selectedMonth == $key ? 'selected' : '' }}>
                                {{ $monthName }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6">
                    <select id="year" class="form-control">
                        <option value="">Pilih Tahun</option>
                    </select>
                    
                    <script>
                        const yearSelect = document.getElementById('year');
                        const currentYear = new Date().getFullYear();
                        
                        for (let year = currentYear; year >= currentYear - 10; year--) {
                            let option = document.createElement('option');
                            option.value = year;
                            option.textContent = year;
                            if (year == "{{ $selectedYear }}") {
                                option.selected = true;
                            }
                            yearSelect.appendChild(option);
                        }
                    </script>
                    
                </div>
            </div>

            <canvas id="transactionChart"></canvas>
        </div>
    </div>

    <script>
        document.getElementById('month').addEventListener('change', updateURL);
        document.getElementById('year').addEventListener('change', updateURL);

        function updateURL() {
            const month = document.getElementById('month').value;
            const year = document.getElementById('year').value;
            const params = new URLSearchParams(window.location.search);

            if (month) {
                params.set('month', month);
            } else {
                params.delete('month');
            }

            if (year) {
                params.set('year', year);
            } else {
                params.delete('year');
            }

            window.location.href = '?' + params.toString();
        }

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

        document.getElementById('month').addEventListener('change', updateFilter);
document.getElementById('year').addEventListener('change', updateFilter);

function updateFilter() {
    const month = document.getElementById('month').value;
    const year = document.getElementById('year').value;
    
    if (month && year) {
        window.location.href = `?month=${month}&year=${year}`;
    }
}

    </script>
</x-layout>
