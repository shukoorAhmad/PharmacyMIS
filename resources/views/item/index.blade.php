@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">

    <div class="col-12 box-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-2">Site List</h4>
                <table class="table data-table w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Measure Unit</th>
                            <th>Quantity Per Carton</th>
                            <th>Supplier</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot></tfoot>
                </table>
                <div id="showEditModal"></div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

@section('script')
    <script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/demo.datatable-init.js') }}"></script>

    <script>
        $('.edit').click(function() {
            $.get("{{ route('edititem') }}/" + $(this).attr('data-id'), function(data) {
                $('#showEditModal').html(data);
                $('#editModal').modal('show');
            });
        });
    </script>
    <!-- Inject JS -->
    @if (session()->has('success_insert'))
        <script>
            success("{{ session()->get('success_insert') }}")
        </script>
    @endif
    @if (session()->has('success_update'))
        <script>
            success("{{ session()->get('success_update') }}")
        </script>
    @endif

    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                "bInfo": false,
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": false,
                "aaSorting": [
                    [0, "desc"]
                ],
                "info": true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('item-list') }}",
                columns: [{
                        "data": 'item_id'
                    },
                    {
                        "data": 'item_name'
                    },
                    {
                        "data": 'measure_name'
                    },
                    {
                        "data": 'quantity_per_carton'
                    },
                    {
                        "data": 'supplier_name'
                    },
                    {
                        "data": 'action'
                    }
                ]
            });
        });
    </script>
@endsection
@endsection
