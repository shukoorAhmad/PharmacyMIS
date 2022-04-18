@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">

<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Edit Order</h4>
                <a href="{{ url()->previous() }}" class="btn btn-success mb-3">Back</a>
            </div>
            <form method="POST" action="{{ route('update-order-details') }}">
                @csrf
                <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Supplier Name</label>
                        <select name="supplier" class="form-control" disabled>
                            <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Order Date</label>
                        <input type="text" class="form-control" value="{{ $order->order_date }}" name="order_date" autocomplete="off" data-date-format="yyyy-m-d" data-provide="datepicker" data-date-autoclose="true">
                    </div>
                    <div class="form-group col-md-2" style="margin-top: 34px;">
                        <a class="btn btn-primary w-100" id="add_items" style="padding: 7px 1.75rem !important;"><i class="zmdi zmdi-plus text-white" style="font-size:18px !important;"></i></a>
                    </div>
                </div>
                @foreach ($order->order_items as $key => $ord)
                <input type="hidden" name="order_item_id[]" value="{{ $ord->order_item_id }}">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Item Name</label>
                        <select name="old_item[]" class="form-control select2">
                            @foreach ($items as $item)
                            <option value="{{ $item->item_id }}" {{ $item->item_id == $ord->items_details->item_id ? 'selected' : '' }}>
                                {{ $item->item_name . ' ' . $item->item_unit . ' ' . $item->item_type_details->type }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Item Quantity</label>
                        <input type="number" class="form-control" name="old_quantity[]" value="{{ $ord->quantity }}">
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('delete-order-item', $ord->order_item_id) }}" class="btn btn-danger w-100 delete-order-item" style="padding: 7px 1.75rem !important;margin-top:30px !important;font-size:14px !important;">
                            <i class="fa fa-trash text-white"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12 p-0" id="showItems">
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
</div>


@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    $('#add_items').click(function() {
        $.get("{{ route('addNewItem') }}", function(response) {
            $('#showItems').append(response);
        });
    });
    $(document).on('click', '.close_btn', function() {
        $(this).closest($('.show_items')).remove();
    });

    $('.select2').select2();
</script>

@endsection
@endsection