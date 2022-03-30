@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<style>
    .odd>td, .even>td{
        text-align: center !important;
    }
</style>
<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="card-title">Customers List</h6>
                <a href="{{route('customer')}}" class="btn btn-success mb-3">New Customer</a>
            </div>

            <table class="table data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Pharmacy Name</th>
                        <th>Customer Full Name</th>
                        <th>Contact No 1</th>
                        <th>Contact No 2</th>
                        <th>Site</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
    <div id="showEditModal"></div>
</div>

@section('script')
<script>
    $(document).on('click', '.edit', function() {
        $.get("{{ route('edit-customer') }}/" + $(this).attr('data-id'), function(data) {
            $('#showEditModal').html(data);
            $('#editModal').modal('show');
        });
    });
</script>
<!-- Inject JS -->
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/demo.datatable-init.js') }}"></script>
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
            ajax: "{{ route('show-customers') }}",
            columns: [{
                    "data": 'customer_id'
                },
                {
                    "data": 'pharmacy_name'
                },
                {
                    "data": 'full_name'
                },
                {
                    "data": 'contact_no'
                },
                {
                    "data": 'contact_no_2'
                },
                {
                    "data": 'site'
                },
                {
                    "data": 'action'
                }
            ]
        });
    });
</script>
@if (session()->has('success_update'))
<script>
    success("{{session()->get('success_update')}}")
</script>
@endif
@endsection
@endsection