<!DOCTYPE html>
<html>
<head>
    <style>
        /* Tampilan container */

        /* Gaya tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-left: -30px;
        }

        th, td {
            padding: 5px 5px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Gaya judul tabel */
        h1 {
            text-align: center;
            position: relative;
        }

        /* Gaya logo pojok kiri atas */
        .logo-left {
            position: absolute;
            top: 0;
            left: 0;
        }

        /* Gaya logo pojok kanan atas */
        .logo-right {
            position: absolute;
            top: 0;
            right: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo-left">
            <img src="{{ asset('assets/oil-clinic.png') }}" alt="logo" style="height: 3em; width: 2em;">
        </div>
        <h1>Condemning Limit</h1>

        <table>
            <thead>
                <tr>
                    <th>Value</th>
                    <th>Value</th>
                    <th>Value</th>
                    <th>Numeric/%</th>
                    <th>Keterangan</th>

                </tr>
            </thead>
            <tbody>
                @php $count = 0; @endphp
                @foreach($data as $item)
                    @foreach((array)$item as $key => $value)
                        @if($count % 5 == 0)
                            </tr><tr>
                        @endif
                        <td>{{ $value }}</td>
                        @php $count++; @endphp
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
