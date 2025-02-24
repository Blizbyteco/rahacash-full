<x-layout>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Sparepart</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('sparepart.update', $sparepart->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nama Sparepart:</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $sparepart->name) }}">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga:</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $sparepart->price) }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok:</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $sparepart->stock) }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update</button>
                <a href="{{ route('sparepart.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</x-layout>
