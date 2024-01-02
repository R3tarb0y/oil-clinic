<!DOCTYPE html>
<html>
<head>

    <!-- Add your CSS and other head elements here -->
</head>
<body>
    <div class="container mt-4">
        <hr>
        @foreach ($categories as $category => $dataCount)
            <hr>
            <h2>{{ $category }}</h2>
            <div class="row">
                @for ($i = 0; $i < $dataCount; $i++)
                    @php $index = ($loop->index * $dataCount) + $i @endphp
                    @if ($index < count($columns))
                        <div class="col-md-2">
                            <label for="{{ Str::slug($columns[$index]) }}"
                                class="form-label">{{ $columns[$index] }}</label>
                            <input type="text" id="{{ Str::slug($columns[$index]) }}" class="form-control"
                                value="{{ $custom[$columns[$index]] }}" readonly>
                        </div>
                    @endif
                @endfor
            </div>
            <br>
        @endforeach
    </div>

    <!-- Add your JavaScript and other script elements here -->
</body>
</html>

@php
    function getPrefix($name)
    {
        $prefixes = ['min', 'max', 'border', 'per', ];

        foreach ($prefixes as $prefix) {
            if (strpos($name, $prefix) === 0) {
                return $prefix;
            }
        }

        return $name;
    }

    function getLastWord($str)
{
    $words = explode(' ', $str);
    $lastWord = end($words);

    // Membuat huruf pertama dari kata menjadi huruf kapital
    $capitalizedLastWord = ucfirst($lastWord);

    return $capitalizedLastWord;
}
@endphp
