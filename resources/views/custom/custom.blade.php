@extends('layouts.app')

@section('title', '')

@section('contents')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <!-- DataTables JavaScript -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js">
    </script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js">
    </script>

    <!-- DataTables Select -->
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
    <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet">

    <!-- Add Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        /* Tombol CSV dan PDF */
        #exportSelected,
        #exportSelectedPdf {
            background-color: black;
            color: white;
            border: none;
        }

        /* Efek hover */
        #exportSelected:hover,
        #exportSelectedPdf:hover {
            background-color: darkgoldenrod;
            color: black;
        }

        .modal-lg {
            max-width: 70%;
            /* Adjust the percentage as needed */
        }

        .navbar-menu {
            list-style: none;
            padding: 0;
        }

        .navbar-menu li {
            display: inline;
            margin-right: 20px;
            position: relative;
            /* Required for the underline animation */
        }

        .navbar-menu a {
            text-decoration: none;
            color: goldenrod;
            /* Text color for non-active links */
        }

        /* Colored underline for active link */
        .navbar-menu a.active {
            border-bottom: 2px solid #ff5733;
            /* Colored underline for the active link */
        }

        /* Underline animation */
        .navbar-menu a::after {
            content: "";
            position: absolute;
            width: 100%;
            height: 2px;
            background: #ff5733;
            /* Color of the underline */
            left: 0;
            bottom: 0;
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }

        .navbar-menu a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }

        /* Add a margin to separate the navbar from the content */
        .navbar-menu {
            margin-bottom: 20px;
        }
    </style>
    </head>

    <body>

        <div class="container">
            <ul class="navbar-menu">
                <li><a href="{{ route('oil') }}">Condemning Limit</a></li>
                <li><a href="{{ route('custom') }}">Condemning Limit Custom</a></li>
            </ul>
            <div class="card">
                <div class="card-body">
                    <div class="dataTables_length">
                        <label>Show entries
                            <select id="pageLengthSelect"
                                class="custom-select custom-select-sm form-control form-control-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="-1">All</option>
                            </select>
                        </label>

                        <!-- Tombol CSV dengan ikon -->
                        <button type="button" id="exportSelected" class="btn btn-primary float-right ml-2">
                            <i class="fas fa-file-csv"></i> CSV
                        </button>

                        <!-- Tombol PDF dengan ikon -->
                        <button id="exportSelectedPdf" class="btn btn-primary float-right">
                            <i class="fas fa-file-pdf"></i> PDF
                        </button>

                    </div>

                    <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="selectedRows[]">
                                </th>
                                <th>Customer Name</th>
                                <th>Area Name</th>
                                <th>City Name</th>
                                <th>Equip Code</th>
                                <th>Model Type</th>
                                <th>Engine Number</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($result as $row)
                                <tr>
                                    <td>
                                        <input type="checkbox" id="selectedRow_{{ $row->conID }}" name="selectedRows[]"
                                            value="{{ $row->conID }}">
                                    </td>
                                    <td>{{ $row->customerName }}</td>
                                    <td>{{ $row->areaName }}</td>
                                    <td>{{ $row->cityName }}</td>
                                    <td>{{ $row->equipCode }}</td>
                                    <td>{{ $row->modelType }}</td>
                                    <td>{{ $row->engineNumber }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-secondary detail-button"
                                                data-condem-id="{{ $row->conID }}">Detail</button>
                                            <a href="{{ route('oil.edit', $row->conID) }}" type="button"
                                                class="btn btn-warning">Edit</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog"
                        aria-labelledby="detailModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="detailModalLabel">Condemning Limit Custom</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('.detail-button').on('click', function() {
                            var conID = $(this).data('condem-id');

                            // Debugging: Log the conID value to the browser console
                            console.log('conID:', conID);

                            if (typeof conID !== 'undefined') {
                                $.ajax({
                                    url: "{{ route('custom.showcustom', ['conID' => ':conID']) }}".replace(
                                        ':conID', conID),
                                    type: 'GET',
                                    success: function(data) {
                                        // Debugging: Log a message when the modal is shown
                                        console.log('Modal opened.');

                                        // Inject the detail content into the modal
                                        $('.modal-body').html(data);
                                        // Show the modal
                                        $('#detailModal').modal('show');
                                    },
                                    error: function() {
                                        alert(
                                            'Failed to load product detail. Check the console for more information.'
                                            );
                                    }
                                });
                            } else {
                                alert('Invalid conID.');
                            }
                        });


                        var table = $('#dataTable').DataTable({
                            dom: 'Bfrtip',

                            pageLength: 10,
                            select: {
                                style: 'multi',
                                selector: 'td:first-child'
                            },
                            language: {
                                paginate: {
                                    next: '<i class="fas fa-chevron-right"></i>',
                                    previous: '<i class="fas fa-chevron-left"></i>',
                                }
                            },
                            pagingType: 'simple_numbers',
                        });

                        // Handle page length change
                        $('#pageLengthSelect').on('change', function() {
                            var selectedValue = $(this).val();
                            table.page.len(selectedValue).draw();
                        });

                        // Check/uncheck all checkboxes
                        $('#selectAll').on('change', function() {
                            var isChecked = $(this).is(':checked');
                            $('input[name="selectedRows[]"]').prop('checked', isChecked);
                        });

                        $('.exportCsvButton').on('click', function() {
                            var exportUrl = $(this).data('export-url');
                            window.location.href = exportUrl;
                        });

                        $('#exportSelected').on('click', function() {
                            var selectedRowIds = $('input[name="selectedRows[]"]:checked')
                                .map(function() {
                                    return $(this).val();
                                })
                                .get();

                            if (selectedRowIds.length > 0) {
                                // Iterate through selected row IDs and send separate requests
                                selectedRowIds.forEach(function(rowId) {
                                    var exportUrl = "{{ route('oil.export.csv', '') }}/" + rowId;

                                    // Make an individual AJAX request for each selected row
                                    $.ajax({
                                        url: exportUrl,
                                        type: 'GET',
                                        success: function(response) {
                                            // Handle the successful response (download CSV)
                                            var blob = new Blob([response], {
                                                type: 'text/csv'
                                            });
                                            var link = document.createElement('a');
                                            link.href = window.URL.createObjectURL(blob);
                                            link.download = 'selected_row_' + rowId + '.csv';
                                            link.style.display = 'none';
                                            document.body.appendChild(link);
                                            link.click();
                                            document.body.removeChild(link);
                                        },
                                        error: function() {
                                            // Handle errors, e.g., show an error message to the user
                                            alert('Error exporting row ' + rowId + '.');
                                        },
                                    });
                                });
                            } else {
                                // Inform the user to select rows before exporting
                                alert('Please select rows to export.');
                            }
                        });

                        $('#exportSelectedPdf').on('click', function() {
                            var selectedRowIds = $('input[name="selectedRows[]"]:checked')
                                .map(function() {
                                    return $(this).val();
                                })
                                .get();

                            if (selectedRowIds.length > 0) {
                                // Mengumpulkan informasi nama dari baris yang dipilih
                                var selectedRowData = [];
                                selectedRowIds.forEach(function(rowId) {
                                    var rowData = {
                                        manufacture: $('td:eq(1)', 'tr[data-id="' + rowId + '"]').text(),
                                        component: $('td:eq(2)', 'tr[data-id="' + rowId + '"]').text(),
                                        application: $('td:eq(3)', 'tr[data-id="' + rowId + '"]').text(),
                                        model: $('td:eq(4)', 'tr[data-id="' + rowId + '"]').text()
                                    };
                                    selectedRowData.push(rowData);
                                });

                                // Membuat permintaan AJAX
                                $.ajax({
                                    url: "{{ route('oil.export.pdf', '') }}/" + selectedRowIds.join(','),
                                    type: 'GET',
                                    data: {
                                        selectedRowData: selectedRowData
                                    }, // Mengirim data nama baris yang dipilih
                                    success: function(response) {
                                        if (response.pdf_file) {
                                            // Mengambil nama file PDF dari respons
                                            var pdfFileName = response.pdf_file;

                                            // Mengunduh file PDF dengan nama yang sesuai
                                            var pdfFileUrl = "{{ route('oil.download.pdf') }}?pdf_file=" +
                                                pdfFileName;
                                            var link = document.createElement('a');
                                            link.href = pdfFileUrl;
                                            link.download = selectedRowData[0].manufacture + '_' +
                                                selectedRowData[0].application + '_' + selectedRowData[0]
                                                .component + '_' + selectedRowData[0].model + '_' +
                                                selectedRowIds[0] +
                                                '.pdf'; // Menggunakan informasi dari data pertama dalam penamaan
                                            link.style.display = 'none';
                                            document.body.appendChild(link);
                                            link.click();
                                            document.body.removeChild(link);
                                        } else {
                                            alert('No PDF file generated.');
                                        }
                                    },
                                    error: function(xhr, status, error) {
                                        console.log(xhr.responseText);
                                        alert('Error exporting data as PDF.');
                                    },
                                });
                            } else {
                                // Inform the user to select rows before exporting
                                alert('Please select rows to export as PDF.');
                            }
                        });

                        FontAwesome.init();
                    });
                </script>

            @endsection
