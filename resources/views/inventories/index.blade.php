@extends('layouts.app')

@section('contents')
    <div class="container">
        <h1>Inventory List</h1>

        <a class="btn btn-primary" href="{{ route('inventory.create') }}">Add Inventory</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Gambar</th>
                    <th>Kategori</th>
                    <th>Action</th>
                    <th>Barcode</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->id }}</td>
                        <td>{{ $inventory->nama }}</td>
                        <td>{{ $inventory->jenis }}</td>
                        <td>{{ $inventory->jumlah }}</td>
                        <td>{{ $inventory->status }}</td>
                        <td>
                            <img src="{{ asset('/storage/' . $inventory->gambar) }}" alt="{{ $inventory->nama }}" style="max-width: 80px;">
                        </td>
                        <td>{{ $inventory->kategori }}</td>
                        <td>
                            <a class="btn btn-primary" href="{{ route('inventory.edit', $inventory->id) }}">Edit</a>
                            <a href="{{ route('inventory.printBarcode', $inventory->id) }}" target="_blank">Print Barcode</a>
                            <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Ingin di Hapus?')">Delete</button>
                            </form>
                        </td>
                        <td>
                            <img src="{{ route('inventory.printBarcode', $inventory->id) }}" alt="Barcode" width="100" height="50">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
