@extends('layouts.master')

@section('content')
<style>
    @media print {

        td,
        th {
            font-size: 14px !important;
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
                <h4 class="card-title mb-2"> {{ __('words.Purchase No') $purchase->purchase_id}}</h4>
                <div>
                    <a onclick="window.print()" class="btn btn-primary mb-3 text-white">{{__('words.Print')}}</a>
                    <a href="{{url()->previous()}}" class="btn btn-success mb-3">{{__('words.Back')}}</a>
                </div>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <th> {{__('words.From').' '.$purchase->supplier_details->name}} </th>
                        <th> {{__('words.Purchase Invoice No').' '.$purchase->purchase_invoice_no}}</th>
                        <th> {{__('words.Purchase Date').' '.$purchase->purchase_date}}</th>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <th>{{__('words.No')}}</th>
                        <th>{{__('words.Item')}}</th>
                        <th>{{__('words.Quantity')}}</th>
                        <th>{{__('words.Purchase Price')}} </th>
                        <th>{{__('words.Purchase Price (Total)')}}</th>
                        <th>{{__('words.Expiry Date')}}</th>
                    </tr>
                    @php
                    $total=0;
                    $total_price=0;
                    @endphp
                    @foreach($purchase->purchase_items as $key=>$ord)
                    <tr>
                        <th>{{++$key}}</th>
                        <td>{{$ord->items_details->item_name . ' ' . $ord->items_details->item_unit . ' ' . $ord->items_details->item_type_details->type}}</td>
                        <th>{{$ord->quantity.' '. $ord->items_details->measure_details->unit}}
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
                        <th colspan="2">{{__('words.Total')}}</th>
                        <th>{{$total}}</th>
                        <th></th>
                        <th>{{$total_price}}</th>
                    </tr>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
@endsection