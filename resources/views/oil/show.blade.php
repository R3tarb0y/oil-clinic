
<div class="container mt-4">
    <hr>

    <div class="row" style="margin-left: 7em;">
        @foreach ($columns as $column)
        <div class="col-md-2 mb-3">
            <label for="{{ Str::slug($column) }}" class="form-label">{{ $column }}</label>
            <input type="text" id="{{ Str::slug($column) }}" class="form-control" value="{{ $oil[$column] }}" readonly>
        </div>
        @if ($loop->iteration % 5 == 0)
        </div><div class="row" style="margin-left: 7em;">
        @endif
        @endforeach
    </div>


</div>

