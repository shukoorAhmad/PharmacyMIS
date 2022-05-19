@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
    <style>
        @media print {

            td,
            th {
                font-size: 12px !important;
                margin-top: 2px !important;
                margin-bottom: 2px !important;
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
                    <h4 class="card-title mb-2">{{ __('words.Invoice No') . ' ' . $sale->sale_id }}</h4>
                    <div>
                        <a onclick="window.print()" class="btn btn-primary mb-3 text-white">{{ __('words.Print') }}</a>
                        <a href="{{ url()->previous() }}" class="btn btn-success mb-3">{{ __('words.Back') }}</a>
                    </div>
                </div>
                <div>
                    <table class="table">
                        <tr>
                            <th colspan="3">{{ __('words.Sales Bill') }}</th>
                        </tr>
                        <tr>
                            <th>To
                                @if ($sale->sale_type == 1)
                                    {{ $sale->customer_details->pharmacy_name }}
                                @endif
                                @if ($sale->sale_type == 2)
                                    {{ $sale->seller_details->seller_name }}
                                @endif
                            </th>
                            <th>{{ __('words.Invoice No') . ' ' . $sale->sale_id }}</th>
                            <th>{{ __('words.Date') . ' ' . $sale->sale_date }}</th>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <th>{{ __('words.No') }}</th>
                            <th>{{ __('words.Item') }}</th>
                            <th>{{ __('words.Quantity') }}</th>
                            <th>{{ __('words.Price') }}</th>
                            <th>{{ __('words.Discount') }}</th>
                            <th>{{ __('words.Total') }}</th>
                        </tr>
                        @php
                            $total = 0;
                            $total_money = 0;
                        @endphp
                        @foreach ($sale->sales_details as $key => $sale)
                            <tr>
                                <th>{{ ++$key }}</th>
                                <td>{{ $sale->items_details->item_name . ' ' . $sale->items_details->item_unit . ' ' . $sale->items_details->item_type_details->type }}</td>
                                <td>{{ $sale->quantity . ' ' . $sale->items_details->measure_details->unit }}
                                    @php
                                        $total += $sale->quantity;
                                        $total_money += $sale->sale_price * $sale->quantity;
                                    @endphp
                                </td>
                                <td>{{ $sale->sale_price }}</td>
                                <td>{{ $sale->discount }}</td>
                                <td>{{ $sale->sale_price * $sale->quantity }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <th colspan="2">{{__('words.Total')}}</th>
                            <th>{{ $total }}</th>
                            <th colspan="2"></th>
                            <th>{{ $total_money }}</th>
                        </tr>
                    </table>
                    <div class="col-md-4">
                        <table class="table table-bordered">
                            <tr>
                                <th colspan="2">{{__('words.Total')}}</th>
                            </tr>
                            <tr>
                                <th>{{__('words.Current Bill')}}</th>
                                <td>{{ $total_money }}</td>
                            </tr>
                            <tr>
                                <th>{{__('words.Current Bill Paid')}}</th>
                                <td>{{ $current_paid_bill }}</td>
                            </tr>
                            <tr>
                                <th>{{__('words.Previous Loan')}}</th>
                                <td>{{ $loan }}</td>
                            </tr>
                            <tr>
                                <th>{{__('words.Total Loan')}}</th>
                                <td>{{ $loan + $total_money - $current_paid_bill }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
@section('script')
@endsection
@endsection
