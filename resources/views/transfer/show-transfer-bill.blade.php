@extends('layouts.master')

@section('content')

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
                <h4 class="card-title mb-2">Invoice No {{$transfer->transfer_id}}</h4>
                <div>
                    <a onclick="window.print()" class="btn btn-primary mb-3 text-white">Print</a>
                    <a href="{{url()->previous()}}" class="btn btn-success mb-3">Back</a>
                </div>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <th colspan="4">Company Logo , Address And Contact</th>
                    </tr>
                    <tr>
                        <th>Bill No {{$transfer->transfer_id}}</th>
                        <th>From Stock: {{$transfer->src_stock_details->stock_name}} </th>
                        <th>To Stock: {{$transfer->dest_stock_details->stock_name}}</th>
                        <th>Transfer Date: {{$transfer->transfer_date}}</th>
                    </tr>
                </table>
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Quantity(Carton)</th>
                    </tr>
                    @php
                    $total=0;
                    @endphp
                    @foreach($transfer->transfer_items as $key=>$ord)
                    <tr>
                        <th>{{++$key}}</th>
                        <td><b>{{$ord->items_details->item_name}}</b> -- {{$ord->items_details->dose.' -- '.$ord->items_details->measure_details->unit}}</td>
                        <th>{{$ord->quantity}}
                            @php
                            $total+=$ord->quantity;
                            @endphp
                        </th>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="2">Total</th>
                        <th>{{$total}}</th>
                    </tr>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
@section('script')
@if (session()->has('success_transfer'))
<script>
    success("{{ session()->get('success_transfer') }}")
</script>
@endif
@endsection
@endsection