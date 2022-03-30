@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<style>
    .odd>td,
    .even>td {
        text-align: center !important;
    }

    th {
        font-weight: bolder !important;
    }

    @media print {

        td,
        th {
            font-size: 16px !important;
        }

        th {
            font-weight: bolder !important;
        }
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
                    <th>To {{$order->supplier_detials->name}}</th>
                    <th>Invoice No {{$order->order_id}}</th>
                    <th>Order Date: {{$order->order_date}}</th>
                </tr>
            </table>
            <div>

                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                        <th>Expiry Date</th>
                    </tr>
                    @php
                    $total=0
                    @endphp
                    @foreach($order->order_items as $key=>$ord)
                    <tr>
                        <th>{{++$key}}</th>
                        <td><b>{{$ord->items_details->item_name}}</b> -- {{$ord->items_details->dose.' -- '.$ord->items_details->measure_details->unit}}</td>
                        <th>{{$ord->quantity}}</th>
                        <th>
                            <input type="text" class="form-control" name="purchase_price[]" required>
                        </th>
                        <th>
                            <input type="text" class="form-control" name="sale_price[]" required>
                        </th>
                        <th>
                            <input class="form-control" name="expiry_date[]" data-date-format="yyyy-m-d" autocomplete="off" data-provide="datepicker" data-date-autoclose="true" required>
                        </th>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
@section('script')

@endsection
@endsection