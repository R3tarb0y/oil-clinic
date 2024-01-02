@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add Inventory</h1>

        <form action="{{ route('inventories.store') }}" method="POST">
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
                <label for="status">Status</label>
                <input type="text" class="form-control" id="status" name="status" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
