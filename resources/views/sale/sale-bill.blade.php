@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<style>
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
                <h4 class="card-title mb-2">Invoice No {{$sale->sale_id}}</h4>
                <div>
                    <a onclick="window.print()" class="btn btn-primary mb-3 text-white">Print</a>
                    <a href="{{url()->previous()}}" class="btn btn-success mb-3">Back</a>
                </div>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <th colspan="3">Sales Bill</th>
                    </tr>
                    <tr>
                        <th>To
                            @if($sale->sale_type==1)
                            {{$sale->customer_details->pharmacy_name}}
                            @endif
                            @if($sale->sale_type==2)
                            {{$sale->seller_details->seller_name}}
                            @endif
                        </th>
                        <th>Invoice No {{$sale->sale_id}}</th>
                        <th>Date: {{$sale->sale_date}}</th>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>Total</th>
                    </tr>
                    @php
                    $total=0;
                    $total_money=0;
                    @endphp
                    @foreach($sale->sales_details as $key=>$sale)
                    <tr>
                        <th>{{++$key}}</th>
                        <td>{{$sale->items_details->item_name . ' ' . $sale->items_details->item_unit . ' ' . $sale->items_details->item_type_details->type}}</td>
                        <td>{{$sale->quantity.' '. $sale->items_details->measure_details->unit}}
                            @php
                            $total+=$sale->quantity;
                            $total_money+=$sale->sale_price*$sale->quantity;
                            @endphp
                        </td>
                        <td>{{$sale->sale_price}}</td>
                        <td>{{$sale->discount}}</td>
                        <td>{{$sale->sale_price*$sale->quantity}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">Total</th>
                        <th>{{$total}}</th>
                        <th colspan="2"></th>
                        <th>{{$total_money}}</th>
                    </tr>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
@section('script')

@endsection
@endsection