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
            <div class="d-flex justify-content-between hop">
                <h4 class="card-title mb-2">Invoice No {{$order->order_id}}</h4>
                <div>
                    <a onclick="window.print()" class="btn btn-primary mb-3 text-white">Print</a>
                    <a href="{{url()->previous()}}" class="btn btn-success mb-3">Back</a>
                </div>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <th colspan="3">Company Logo , Address And Contact</th>
                    </tr>
                    <tr>
                        <th>To {{$order->supplier_detials->name}}</th>
                        <th>Invoice No {{$order->order_id}}</th>
                        <th>Order Date: {{$order->order_date}}</th>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Quantity</th>
                    </tr>
                    @php
                    $total=0
                    @endphp
                    @foreach($order->order_items as $key=>$ord)
                    <tr>
                        <th>{{++$key}}</th>
                        <td>{{$ord->items_details->item_name . ' ' . $ord->items_details->item_unit . ' ' . $ord->items_details->item_type_details->type}}</td>
                        <th>{{$ord->quantity}}
                            @php
                            $total+=$ord->quantity
                            @endphp
                        </th>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">Total</th>
                        <th colspan="2">{{$total}}</th>
                    </tr>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
@section('script')

@endsection
@endsection