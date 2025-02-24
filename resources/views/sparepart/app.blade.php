<x-layout>
    <div class="card">
        <div class="card-header">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3 class="card-title">List Sparepart</h3>
                <a href={{ route('sparepart.create') }} class="btn btn-primary">Tambah Data</a>
            </div>
        </div>
        <div class="card-body">
            <table id="sparepartTable"  class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Sparepart</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($spareparts as $key => $sparepart)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $sparepart->name }}</td>
                        <td>Rp {{ number_format($sparepart->price, 0, ',', '.') }}</td>
                        <td>{{ $sparepart->stock }}</td>
                        <td>
                            <a href="{{ route('sparepart.edit', $sparepart->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <button class="btn btn-info btn-sm btn-add-stock" 
                                data-toggle="modal" data-target="#addStockModal"
                                data-id="{{ $sparepart->id }}" 
                                data-name="{{ $sparepart->name }}">
                                Tambah Stok
                            </button>
                            <form action="{{ route('sparepart.destroy', $sparepart->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->

    <div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStockModalLabel">Nama Sparepart</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addStockForm">
                        @csrf
                        <input type="hidden" id="sparepart_id" name="sparepart_id">
                        <div class="mb-3">
                            <label class="form-label">Jumlah Stok:</label>
                            <input type="number" id="stock_amount" name="stock_amount" class="form-control" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="stock_price" class="form-label">Harga Beli per Unit</label>
                            <input type="number" class="form-control" name="stock_price" required min="1">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#sparepartTable').DataTable()
            $('.btn-add-stock').on('click', function() {
                let sparepartName = $(this).data('name')
                let sparepartId = $(this).data('id');
                $('#sparepart_id').val(sparepartId);
                $('.modal-title').text(sparepartName)
            })

            $('#addStockForm').submit(function (e) {
                e.preventDefault()
                let formData = $(this).serialize()

                $.ajax({
                    url: "{{ route('sparepart.updateStock') }}",
                    method: "POST",
                    data: formData,
                    success: function (response) {
                        alert(response.message)
                        location.reload()
                    },
                    error: function (xhr) {
                        alert('Terjadi kesalahan saat memperbarui stok')
                    }
                })
            })
        })
    </script>
</x-layout>