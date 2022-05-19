@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<style>
    .badge {
        font-size: 12px !important;
    }
</style>

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mb-2">{{__('words.Purchase List')}}</h4>
                <a href="{{ route('purchase') }}" class="btn btn-success mb-3">{{__('words.New Purchase')}}</a>
            </div>
            <table class="table data-table w-100">
                <thead>
                    <tr>
                        <th>{{__('words.ID')}}</th>
                        <th>{{__('words.Supplier Name')}}</th>
                        <th>{{__('words.Purchase Invoice')}} #</th>
                        <th>{{__('words.Order Details')}}</th>
                        <th>{{__('words.Total Items')}}</th>
                        <th>{{__('words.Stock')}}</th>
                        <th>{{__('words.Purchase Date')}}</th>
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
@if (session()->has('suc_delete'))
<script>
    success("{{ session()->get('suc_delete') }}")
</script>
@endif
@if (session()->has('err_delete'))
<script>
    error_function("{{ session()->get('err_delete') }}")
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
    $(document).on('click', '.return_purchase', function() {
        var id = $(this).attr('data-id');
        Swal.fire({
            title: "{{__('words.Are you sure?')}}",
            text: "{{__('words.Return This Purchase')}}",
            type: "error",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then(function(result) {
            if (result.value) {
                window.location.href = "{{route('return-purchase')}}/" + id;
            }
        });
    });
</script>
@endsection
@endsection