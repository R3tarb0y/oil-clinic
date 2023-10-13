@extends('layouts.app')

@section('title', 'Edit Condemning Details')

@section('contents')

    <div class="container mt-4">
        <hr>

        <form action="{{ route('oil.update', $oil) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <input type="hidden" name="id" value="{{ $oil->id }}">
                @foreach ($columns as $column)
                    <div class="col-md-2 mb-3">
                        <label for="{{ $column['name'] }}" class="form-label">{{ $column['name'] }}</label>
                        @if ($column['type'] == "string")
                            <input type="text" name="{{ $column['name'] }}" value="{{ $oil->{$column['name']} }}"
                                   class="form-control">
                        @else
                            <input type="number" name="{{ $column['name'] }}" value="{{ $oil->{$column['name']} }}"
                                   class="form-control" step="0.1">
                        @endif
                    </div>
                    @if ($loop->iteration % 5 == 0)
            </div>
            <div class="row">
                @endif
                @endforeach
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
            {{-- <a href="{{ route('oil.index') }}" class="btn btn-secondary">Back to Index</a> --}}
        </form>


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>

@endsection
