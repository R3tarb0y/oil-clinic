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
                    <th>Kategori</th>
                    <th>Gambar</th>
                    <th>Barcode</th>
                    <th>Action</th>
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

                        <td>{{ $inventory->kategori }}</td>
                        <td>
                            <img src="{{ asset('storage/' . $inventory->gambar) }}" alt="{{ $inventory->nama }}" style="max-width: 80px;">

                        </td>

                        <td>{!! DNS1D::getBarcodeHTML("$inventory->barcode",'C128',2,40) !!}
                            {{ $inventory->barcode }}
                           </td>

                        <td>
                            <a class="btn btn-primary" href="{{ route('inventory.edit', $inventory->id) }}">Edit</a>
                            <a class="btn btn-primary" href="{{ route('inventory.printBarcode', $inventory->id) }}" target="_blank">Print Barcode</a>
                            <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Ingin di Hapus?')">Delete</button>
                            </form>
                        </td>
                        <td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
