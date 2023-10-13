@extends('layouts.app')

@section('title', 'Condemning Limit')

@section('contents')
 <!-- jQuery -->
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <!-- Bootstrap CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

 <!-- DataTables CSS -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

 <!-- DataTables JavaScript -->
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>



 <!-- DataTables Select -->
 <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
 <script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>

 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" rel="stylesheet">


 <!-- Add Font Awesome -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


 <style>

    /* Tombol CSV dan PDF */
#exportSelected, #exportSelectedPdf {
    background-color: black;
    color: white;
    border: none;
}

/* Efek hover */
#exportSelected:hover, #exportSelectedPdf:hover {
    background-color: darkgoldenrod;
    color: black;
}

     .modal-lg {
        max-width: 70%; /* Adjust the percentage as needed */
    }



 </style>
</head>
<body>
<div class="container">
 {{-- <h1 class="text-center text-success mb-5"><b>List Product</b></h1> --}}
 <div class="card">
     <div class="card-body">


         <div class="dataTables_length">
             <label>Show entries
                 <select id="pageLengthSelect" class="custom-select custom-select-sm form-control form-control-sm">
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
                    <th >
                        <input type="checkbox" name="selectedRows[]">
                    </th>
                    <th>Manufacture</th>
                    <th>Component Name</th>
                    <th>Application Name</th>
                    <th>Model Type</th>
                    <th>Actions</th>
                </tr>
             </thead>
    <tbody>
        @foreach($result as $row)
        <tr>
            <td >
                <input type="checkbox" id="selectedRow_{{ $row->condemID }}" name="selectedRows[]" value="{{ $row->condemID }}">
            </td>
            <td>{{ $row->manufac }}</td>
            <td>{{ $row->compoName }}</td>
            <td>{{ $row->applicationName }}</td>
            <td>{{ $row->modelType }}</td>
            <td class="align-middle">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary detail-button" data-condem-id="{{ $row->condemID }}">Detail</button>
                    <a href="{{ route('oil.edit', $row->condemID)}}" type="button" class="btn btn-warning">Edit</a>
                    <form action="{{ route('oil.destroy', $row->manufac) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger m-0">Delete</button>
                    </form>
                </div>
            </td>
        </tr>

        @endforeach
    </tbody>
         </table>
     </div>
 </div>
 <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Product Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Detail product content will be loaded here using AJAX -->
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
    var condemId = $(this).data('condem-id');
    // Make an AJAX request to get the detail content
    $.ajax({
        url: "{{ route('oil.show', ':id') }}".replace(':id', condemId), // Mengganti :id dengan condemId
        type: 'GET',
        success: function(data) {
            // Inject the detail content into the modal
            $('.modal-body').html(data);
            // Show the modal
            $('#detailModal').modal('show');
        },
        error: function() {
            alert('Failed to load product detail.');
        }
    });
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

    $('#exportSelected').on('click', function () {
    var selectedRowIds = $('input[name="selectedRows[]"]:checked')
        .map(function () {
            return $(this).val();
        })
        .get();

    if (selectedRowIds.length > 0) {
        // Iterate through selected row IDs and send separate requests
        selectedRowIds.forEach(function (rowId) {
            var exportUrl = "{{ route('oil.export.csv', '') }}/" + rowId;

            // Make an individual AJAX request for each selected row
            $.ajax({
                url: exportUrl,
                type: 'GET',
                success: function (response) {
                    // Handle the successful response (download CSV)
                    var blob = new Blob([response], { type: 'text/csv' });
                    var link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'selected_row_' + rowId + '.csv';
                    link.style.display = 'none';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                },
                error: function () {
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

    $('#exportSelectedPdf').on('click', function () {
    var selectedRowIds = $('input[name="selectedRows[]"]:checked')
        .map(function () {
            return $(this).val();
        })
        .get();

    if (selectedRowIds.length > 0) {
        // Mengumpulkan informasi nama dari baris yang dipilih
        var selectedRowData = [];
        selectedRowIds.forEach(function (rowId) {
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
            data: { selectedRowData: selectedRowData }, // Mengirim data nama baris yang dipilih
            success: function (response) {
                if (response.pdf_file) {
                    // Mengambil nama file PDF dari respons
                    var pdfFileName = response.pdf_file;

                    // Mengunduh file PDF dengan nama yang sesuai
                    var pdfFileUrl = "{{ route('oil.download.pdf') }}?pdf_file=" + pdfFileName;
                    var link = document.createElement('a');
                    link.href = pdfFileUrl;
                    link.download = selectedRowData[0].manufacture + '_' + selectedRowData[0].application + '_' + selectedRowData[0].component + '_' + selectedRowData[0].model + '_' + selectedRowIds[0] + '.pdf'; // Menggunakan informasi dari data pertama dalam penamaan
                    link.style.display = 'none';
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                } else {
                    alert('No PDF file generated.');
                }
            },
            error: function (xhr, status, error) {
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
