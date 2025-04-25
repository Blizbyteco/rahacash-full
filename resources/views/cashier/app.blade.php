<x-layout>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Kasir - Transaksi Baru</h3>
        </div>
        <div class="card-body">
            <form action="/cashier" method="POST">
                @csrf
                <!-- Input Harga Service -->
                <div class="mb-3">
                    <label class="form-label">Harga Service:</label>
                    <input type="number" name="service_price" id="service-price" class="form-control" placeholder="Masukkan harga service">
                </div>

                <!-- Input Deskripsi Service -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi Service:</label>
                    <textarea name="service_description" class="form-control" rows="3" placeholder="Contoh: Servis ganti oli"></textarea>
                </div>

                <!-- Pilih Sparepart -->
                <div class="mb-3">
                    <label class="form-label">Pilih Sparepart:</label>
                    <select id="sparepart-select" class="form-control select2">
                        <option value="">-- Pilih Sparepart --</option>
                        @foreach ($spareparts as $sparepart)
                            <option value="{{ $sparepart->id }}" data-price="{{ $sparepart->price }}">
                                {{ $sparepart->name }} - Stok: {{ $sparepart->stock }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Daftar Sparepart yang Dipilih -->
                <div class="mb-3">
                    <table class="table table-bordered" id="sparepart-list">
                        <thead>
                            <tr>
                                <th>Nama Sparepart</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                <!-- Metode Pembayaran -->
                <div class="mb-3">
                    <label class="form-label">Metode Pembayaran:</label>
                    <select name="payment_method" class="form-control">
                        <option value="Cash">Cash</option>
                        <option value="Transfer">Transfer</option>
                        <option value="QRIS">QRIS</option>
                    </select>
                </div>

                <!-- Input Nama -->
                <div class="mb-3">
                    <label class="form-label">Nama Kustomer:</label>
                    <input type="number" name="customer_name" id="customer-name" class="form-control @error('customer-name') is-invalid @enderror" placeholder="Masukkan nama kustomer">
                    @error('customer-name')
                    <div class="invalid-feedback">
                        {{  $message }}
                    </div>                    
                    @enderror
                </div>

                <!-- Total Harga -->
                <div class="mb-3">
                    <h4>Total: Rp <span id="total-price">0</span></h4>
                    <input type="hidden" name="total_amount" id="total-amount">
                </div>

                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
                <a href="   " class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-layout>

<script>
    $(document).ready(function () {
        let totalAmount = 0;

        function updateTotal() {
            totalAmount = 0;

            let servicePrice = parseInt($('#service-price').val()) || 0;
            totalAmount += servicePrice;

            $('#sparepart-list tbody tr').each(function () {
                let total = parseInt($(this).find('.total-price').text());
                totalAmount += total;
            });

            $('#total-price').text(totalAmount.toLocaleString('id-ID'));
            $('#total-amount').val(totalAmount);
        }

        $('#sparepart-select').change(function () {
            let sparepartId = $(this).val();
            let sparepartName = $(this).find('option:selected').text();
            let sparepartPrice = $(this).find('option:selected').data('price');

            if (sparepartId) {
                let row = `
                    <tr data-id="${sparepartId}">
                        <td>${sparepartName}</td>
                        <td><input type="number" name="sparepart_qtys[${sparepartId}]" class="form-control qty" value="1" min="1"></td>
                        <td>Rp${sparepartPrice.toLocaleString('id-ID')}</td>
                        <td class="total-price">${sparepartPrice}</td>
                        <td><button type="button" class="btn btn-danger btn-sm remove-sparepart">Hapus</button></td>
                    </tr>
                `;
                $('#sparepart-list tbody').append(row);
                updateTotal();
            }
        });

        $(document).on('input', '.qty', function () {
            let row = $(this).closest('tr');
            let qty = parseInt($(this).val());
            let price = parseInt(row.find('td:eq(2)').text().replace(/\D/g, ''));
            let total = qty * price;

            row.find('.total-price').text(total);
            updateTotal();
        });

        $(document).on('click', '.remove-sparepart', function () {
            $(this).closest('tr').remove();
            updateTotal();
        });

        $('#service-price').on('input', updateTotal);
    });
</script>
