@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<style>
    .odd>td,
    .even>td {
        text-align: center !important;
    }
</style>

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mb-2">Purchase List</h4>
                <a href="{{ route('purchase') }}" class="btn btn-success mb-3">New Purchase</a>
            </div>
            <table class="table data-table w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Supplier Name</th>
                        <th>Purchase Invoice #</th>
                        <th>Order No</th>
                        <th>Total Cartons</th>
                        <th>Stock</th>
                        <th>Purchase Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
@section('script')
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/demo.datatable-init.js') }}"></script>
@if (session()->has('success_insert'))
<script>
    success("{{ session()->get('success_insert') }}")
</script>
@endif
<script>
    $(document).on('click', '.edit', function() {
        $.get("{{ route('edititem') }}/" + $(this).attr('data-id'), function(data) {
            $('#showEditModal').html(data);
            $('#editModal').modal('show');
        });
    });
</script>

<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            "bInfo": false,
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "aaSorting": [
                [0, "desc"]
            ],
            "info": true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('purchase-list') }}",
            columns: [{
                    "data": 'purchase_id'
                },
                {
                    "data": 'supplier_name'
                },
                {
                    "data": 'purchase_invoice_no'
                },
                {
                    "data": 'order_no'
                },
                {
                    "data": 'total_carton'
                },
                {
                    "data": 'stock_name'
                },
                {
                    "data": 'purchase_date'
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