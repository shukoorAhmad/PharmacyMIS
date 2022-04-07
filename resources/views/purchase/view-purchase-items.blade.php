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
                <h4 class="card-title mb-2">Purchase No {{$purchase->purchase_id}}</h4>
                <div>
                    <a onclick="window.print()" class="btn btn-primary mb-3 text-white">Print</a>
                    <a href="{{url()->previous()}}" class="btn btn-success mb-3">Back</a>
                </div>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <th>From {{$purchase->supplier_details->name}} </th>
                        <th>Purchase Invoice No: {{$purchase->purchase_invoice_no}}</th>
                        <th>Purchase Date: {{$purchase->purchase_date}}</th>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Quantity(Carton)</th>
                        <th>Price (Carton)</th>
                        <th>Price (Total)</th>
                        <th>Expiry Date</th>
                    </tr>
                    @php
                    $total=0;
                    $total_price=0;
                    @endphp
                    @foreach($purchase->purchase_items as $key=>$ord)
                    <tr>
                        <th>{{++$key}}</th>
                        <td><b>{{$ord->items_details->item_name}}</b> -- {{$ord->items_details->dose.' -- '.$ord->items_details->measure_details->unit}}</td>
                        <th>{{$ord->quantity}}
                            @php
                            $total+=$ord->quantity;
                            $total_price+=$ord->purchase_price*$ord->quantity;
                            @endphp
                        </th>
                        <th>{{$ord->purchase_price}}</th>
                        <th>{{$ord->purchase_price*$ord->quantity}}</th>
                        <th>{{$ord->expiry_date}}</th>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">Total</th>
                        <th>{{$total}}</th>
                        <th></th>
                        <th>{{$total_price}}</th>
                    </tr>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
@section('script')

@endsection
@endsection