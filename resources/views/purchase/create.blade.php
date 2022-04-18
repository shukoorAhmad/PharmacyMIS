@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">

<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mb-2">New Purchase</h4>
                <a href="{{route('purchase-list')}}" class="btn btn-success mb-3">Purchase List</a>
            </div>
            <form method="POST" action="{{ route('store-purchase') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="col-form-label">Supplier Name</label>
                        <select name="supplier_id" id="supplier" class="form-control select2" style="width: 100%;">
                            <option value="" selected disabled>Please Select Supplier</option>
                            @foreach ($supplier as $sup)
                            <option value="{{ $sup->supplier_id }}">{{ $sup->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label class="col-form-label">Items</label>
                        <select name="item_id" id="item_id" class="form-control" style="width: 100%;">
                            <option value="" selected disabled>Please Select Item</option>
                            @foreach ($items as $item)
                            <option value="{{ $item->item_id }}">{{ $item->item_name . ' ' . $item->item_unit . ' ' . $item->item_type_details->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12" id="showItems">
                    </div>
                    <hr style="height: 1px !important;width:100% !important;border-top: 1px solid rgba(0,0,0,.1);">
                    <div class="form-group col-md-4">
                        <label>To Stock</label>
                        <select name="stock_id" class="form-control select2" required>
                            <option value="">Select Stock</option>
                            @foreach($stock as $stk)
                            <option value="{{$stk->stock_id}}">{{$stk->stock_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Purchase Invoice #</label>
                        <input class="form-control" name="purchase_invoice_no" placeholder="Enter Purchase Invoice No" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Purchase Date:</label>
                        <input class="form-control" name="purchase_date" data-date-format="yyyy-m-d" value="<?php echo date('Y-m-d'); ?>" autocomplete="off" data-provide="datepicker" data-date-autoclose="true" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 mt-3 d-none" id="submit_btn">Save</button>
            </form>
        </div>
    </div>
</div>


@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    $('.select2').select2();

    $('#item_id').select2({
        ajax: {
            url: "{{ route('filter-item') }}",
            type: "get",
            dataType: 'json',
            delay: 200,
            data: function(params) {
                return {
                    search: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });

    var counter = 0;

    function hide_btn() {
        counter > 0 ? $('#submit_btn').removeClass('d-none') : $('#submit_btn').addClass('d-none');
    }
    $(document).on('click', '.close_btn', function() {
        $(this).closest($('.show_items')).remove();
        counter--;
        hide_btn();
    });

    $('#item_id').change(function() {
        $.get("{{ route('add_new_item') }}/" + $('#item_id').val(), function(response) {
            $('#showItems').append(response);
            console.log(response);
            counter++;
            hide_btn();
        });
    });
</script>

@endsection
@endsection