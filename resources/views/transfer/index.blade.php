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
                    <h6 class="card-title">{{ __('words.Transfers List') }}</h6>
                    <a href="{{ route('transfer') }}" class="btn btn-success mb-3">{{ __('words.New Transfer') }}</a>
                </div>

                <table class="table data-table">
                    <thead>
                        <tr>
                            <th>{{ __('words.ID') }}</th>
                            <th>{{ __('words.From Stock') }}</th>
                            <th>{{ __('words.To Stock') }}</th>
                            <th>{{ __('words.Transfer Date') }}</th>
                            <th>{{ __('words.Comment') }}</th>
                            <th>{{ __('words.Total Carton') }}</th>
                            <th>{{ __('words.Action') }}</th>
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
            success("{{ session()->get('success_update') }}")
        </script>
    @endif
@endsection
@endsection
