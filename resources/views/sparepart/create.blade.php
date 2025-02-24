<x-layout>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Sparepart</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('sparepart.store') }}" method="POST">
                @CSRF
                <div class="mb-3">
                    <label class="form-label">Nama Sparepart:</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga:</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok:</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('sparepart.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-layout>
