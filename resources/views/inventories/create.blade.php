@extends('layouts.app') <!-- Ganti 'layouts.app' dengan nama layout yang Anda miliki -->

@section('contents')
    <div class="container">
        <h1>Create Inventory</h1>

        <form method="POST" action="{{ route('inventory.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="jenis">Jenis</label>
                <input type="text" class="form-control" id="jenis" name="jenis" required>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" class="form-control" id="jumlah" name="jumlah" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" class="form-control" id="kategori" name="kategori" required>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status_active" value="Active"
                        required>
                    <label class="form-check-label" for="status_active">Active</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="status_inactive" value="Inactive"
                        required>
                    <label class="form-check-label" for="status_inactive">Inactive</label>
                </div>
            </div>

            <div class="form-group">
                <label for="gambar">Gambar</label>
                <input type="file" class="form-control-file" id="gambar" name="gambar" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
