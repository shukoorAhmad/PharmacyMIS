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
                <h6 class="card-title">Transfers List</h6>
                <a href="{{route('transfer')}}" class="btn btn-success mb-3">New Transfer</a>
            </div>

            <table class="table data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>From Stock</th>
                        <th>To Stock</th>
                        <th>Transfer Date</th>
                        <th>Comment</th>
                        <th>Total Carton</th>
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
            ajax: "{{ route('show-transfer-bills') }}",
            columns: [{
                    "data": 'transfer_id'
                },
                {
                    "data": 'source_stock'
                },
                {
                    "data": 'destination_stock'
                },
                {
                    "data": 'transfer_date'
                },
                {
                    "data": 'comment'
                },
                {
                    "data": 'total_carton'
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