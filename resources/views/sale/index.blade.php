@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="card-title">Sale List</h6>
                <a href="{{route('sale')}}" class="btn btn-primary mb-4"> New Sale </a>
            </div>
            <div class="table-responsive">
                <table class="table data-table table-striped w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer Name</th>
                            <th>Customer Type</th>
                            <th>Total Items</th>
                            <th>Sale Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->

@section('script')
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
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
<!-- Inject JS -->
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
            ajax: "{{ route('sale-list') }}",
            columns: [{
                    "data": 'sale_id'
                },
                {
                    "data": 'customer_name'
                },
                {
                    "data": 'customer_type'
                },
                {
                    "data": 'total_carton'
                },
                {
                    "data": 'sale_date'
                },
                {
                    "data": 'action'
                }
            ]
        });
    });

    $(document).on('click', '.return_sale', function() {
        var id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "Return This Sale",
            type: "error",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
        }).then(function(result) {
            if (result.value) {
                window.location.href = "{{route('return-sale')}}/" + id;
            }
        });
    });
</script>
@endsection
@endsection