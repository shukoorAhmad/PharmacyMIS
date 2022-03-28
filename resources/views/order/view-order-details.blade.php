@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<style>
    .odd>td,
    .even>td {
        text-align: center !important;
    }
</style>

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mb-2">Order No {{$order->order_id}}</h4>
                <a href="{{url()->previous()}}" class="btn btn-success mb-3">Back</a>
            </div>
            <div>
                <table class="table">
                    <tr>
                        <th>Company Logo , Address And Contact</th>
                    </tr>
                    <tr>
                        <th>To {{$order->supplier_detials->name}}</th>
                        <th>Order No {{$order->order_id}}</th>
                        <th>Order Date: {{$order->order_date}}</th>
                    </tr>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
@section('script')

@endsection
@endsection