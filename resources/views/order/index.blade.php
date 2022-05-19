@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mb-2">{{__('words.Order List')}}</h4>
                <a href="{{ route('order') }}" class="btn btn-success mb-3">{{__('words.New Order')}}</a>
            </div>
            <table class="table data-table w-100">
                <thead>
                    <tr>
                        <th>{{__('words.ID')}}</th>
                        <th>{{__('words.Supplier')}}</th>
                        <th>{{__('words.Order Date')}}</th>
                        <th>{{__('words.Total Items')}}</th>
                        <th>{{__('words.Purchase')}}</th>
                        <th>{{__('words.Action')}}</th>
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
@if (session()->has('error_insert'))
<script>
    error_function("{{ session()->get('error_insert') }}")
</script>
@endif

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
            ajax: "{{ route('order-list') }}",
            columns: [{
                    "data": 'order_id'
                },
                {
                    data: 'supplier_name'
                },
                {
                    "data": 'order_date'
                },
                {
                    "data": 'status_design'
                },
                {
                    "data": 'purchase'
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