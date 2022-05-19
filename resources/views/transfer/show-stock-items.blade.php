<hr>
@if ($items->isEmpty())
    <div class="alert alert-info" role="alert">
        <i class="dripicons-information mr-2"></i> {{ __('words.This Stock is Empty') }}
    </div>
@else
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
    <table class="table data-table">
        <thead>
            <tr>
                <th>{{ __('words.Item') }}</th>
                <th>{{ __('words.Available Carton(s)') }}</th>
                <th>{{ __('words.Quantity To Transfer') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <th><b>{{ $item->item_details->item_name }}</b> -- {{ $item->item_details->dose . ' -- ' . $item->item_details->measure_details->unit }}
                        <input type="hidden" value="{{ $item->item_details->item_id }}" name="item_id[]">
                        <input type="hidden" value="{{ $item->stock_item_id }}" name="stock_item_id[]">
                        <input type="hidden" value="{{ $item->purchase_id }}" name="purchase_id[]">
                    </th>
                    <th>{{ $item->quantity }}
                        <input type="hidden" value="{{ $item->quantity }}" name="item_qty[]">
                        <input type="hidden" value="{{ $item->purchase_price }}" name="purchase_price[]">
                        <input type="hidden" value="{{ $item->sale_price }}" name="sale_price[]">
                        <input type="hidden" value="{{ $item->expiry_date }}" name="expiry_date[]">
                    </th>
                    <th><input type="number" class="form-control" max="{{ $item->quantity }}" name="transfer_qty[]" value="0"></th>
                </tr>
            @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>
    <button type="submit" class="btn btn-primary mb-2 mr-2">{{ __('words.Transfer') }}</button>
    <script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(function() {
            var table = $('.data-table').DataTable({
                "bInfo": false,
                "paging": false,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "aaSorting": [
                    [0, "desc"]
                ],
                "info": true,
            });
        });
    </script>
@endif
