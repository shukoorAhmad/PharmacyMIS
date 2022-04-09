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
<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="card-title">Sellers List</h6>
                <a href="{{route('seller')}}" class="btn btn-success mb-3">New Seller</a>
            </div>

            <table class="table data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Seller Name</th>
                        <th>Seller Last Name</th>
                        <th>Contact No 1</th>
                        <th>Contact No 2</th>
                        <th>Address</th>
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
        $.get("{{ route('edit-seller') }}/" + $(this).attr('data-id'), function(data) {
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
            ajax: "{{ route('show-seller') }}",
            columns: [{
                    "data": 'seller_id'
                },
                {
                    "data": 'seller_name'
                },
                {
                    "data": 'seller_last_name'
                },
                {
                    "data": 'contact_no'
                },
                {
                    "data": 'contact_no_2'
                },
                {
                    "data": 'address'
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