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

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-block">
                <a href="{{url()->previous()}}" class="btn btn-success mb-3 float-right">Back</a>
            </div>
            <table class="table mr-2">
                <tr>
                    <th>To {{$order->supplier_detials->name}}
                    </th>
                    <th>Invoice No {{$order->order_id}}</th>
                    <th>Order Date: {{$order->order_date}}</th>
                </tr>
            </table>
            <div>
                <form action="{{route('store-purchase')}}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{$order->order_id}}">
                    <input type="hidden" value="{{$order->supplier_detials->supplier_id}}" name="supplier_id">
                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Purchase Price (carton)</th>
                            <th>Sale Price (carton)</th>
                            <th>Expiry Date</th>
                        </tr>
                        @php
                        $total=0
                        @endphp
                        @foreach($order->order_items as $key=>$ord)
                        <tr>
                            <th>{{++$key}}
                                <input type="hidden" value="{{$ord->items_details->item_id}}" name="item_id[]">
                            </th>
                            <td><b>{{$ord->items_details->item_name}}</b> -- {{$ord->items_details->dose.' -- '.$ord->items_details->measure_details->unit}}</td>
                            <th>{{$ord->quantity}}
                                <input type="hidden" value="{{$ord->quantity}}" name="quantity[]">
                            </th>
                            <th>
                                <input type="number" class="form-control" name="purchase_price[]" required>
                            </th>
                            <th>
                                <input type="number" class="form-control" name="sale_price[]" required>
                            </th>
                            <th>
                                <input type="date" class="form-control" name="expiry_date[]" required>
                            </th>
                        </tr>
                        @endforeach
                    </table>
                    <div class="row">
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
                    <button type="submit" class="btn btn-primary mb-2 mr-2 float-right">Save</button>
                </form>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    $('.select2').select2();
</script>
@endsection
@endsection