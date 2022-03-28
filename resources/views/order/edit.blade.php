@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 34px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 6px !important;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        outline: none !important;
    }
</style>

<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Edit Order</h4>
                <a href="{{ url()->previous() }}" class="btn btn-success mb-3">Back</a>
            </div>
            <form method="POST" action="{{ route('orderItemStore') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Supplier Name</label>
                        <select name="supplier" id="supplier" class="form-control" disabled>
                            <option value="{{ $supplier->supplier_id }}">{{ $supplier->name }}</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Order Date</label>
                        <input type="text" class="form-control" value="{{$order->order_date}}" name="order_date" autocomplete="off" data-date-format="yyyy-m-d" data-provide="datepicker" data-date-autoclose="true">
                    </div>
                    <div class="form-group col-md-2" style="margin-top: 34px;">
                        <a class="btn btn-primary w-100" id="add_items" style="padding: 7px 1.75rem !important;"><i class="zmdi zmdi-plus text-white" style="font-size:18px !important;"></i></a>
                    </div>
                </div>
                @foreach($order->order_items as $key=>$ord)
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Item Name</label>
                        <select name="old_item[]" class="form-control select2">
                            @foreach ($items as $item)
                            <option value="{{ $item->item_id }}" {{$item->item_id==$ord->items_details->item_id?'selected':''}}>{{ $item->item_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Item Quantity</label>
                        <input type="number" class="form-control" name="old_quantity[]" value="{{$ord->quantity}}">
                    </div>
                    <div class="col-md-2">
                        <a href="" class="btn btn-danger w-100" style="padding: 7px 1.75rem !important;margin-top:30px !important;font-size:14px !important;">
                            <i class="zmdi zmdi-close text-white"></i>
                        </a>
                    </div>
                </div>
                @endforeach
                <div class="col-md-12 p-0" id="showItems">
                </div>
            </form>
        </div>
    </div>
</div>


@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    $('#add_items').click(function() {
        $.get("{{ route('addNewItem') }}/" + $('#supplier').val(), function(response) {
            $('#showItems').append(response);
        });
    });
    $(document).on('click', '.close_btn', function() {
        $(this).closest($('.show_items')).remove();
    });

    $('.select2').select2();
</script>
@if (session()->has('success_update'))
<script>
    success("{{ session()->get('success_update') }}")
</script>
@endif
@endsection
@endsection