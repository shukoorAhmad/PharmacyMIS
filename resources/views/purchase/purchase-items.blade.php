@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">

    <div class="col-12 box-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-block">
                    <a href="{{ url()->previous() }}" class="btn btn-success mb-3 float-right">{{ __('words.Back') }}</a>
                </div>
                <table class="table mr-2">
                    <tr>
                        <th>{{ __('words.From') }} {{ $order->supplier_detials->name }}
                        </th>
                        <th>{{ __('words.Invoice No') }} {{ $order->order_id }}</th>
                        <th>{{ __('words.Order Date') }} {{ $order->order_date }}</th>
                    </tr>
                </table>
                <div>
                    <form action="{{ route('store-purchase') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                        <input type="hidden" value="{{ $order->supplier_detials->supplier_id }}" name="supplier_id">
                        <table class="table table-bordered">
                            <tr>
                                <th>{{ __('words.No') }}</th>
                                <th>{{ __('words.Item') }}</th>
                                <th>{{ __('words.Quantity') }}</th>
                                <th>{{ __('words.Purchase Price') }}</th>
                                <th>{{ __('words.Sale Price') }}</th>
                                <th>{{ __('words.Sale Price (Total)') }}</th>
                                <th>{{ __('words.Expiry Date') }}</th>
                            </tr>
                            @php
                                $total_qty = 0;
                                $total_purchase = 0;
                                $total_sale = 0;
                            @endphp
                            @foreach ($order->order_items as $key => $ord)
                                <tr>
                                    <th>{{ ++$key }}
                                        <input type="hidden" value="{{ $ord->items_details->item_id }}" name="item_id[]">
                                    </th>
                                    <td>{{ $ord->items_details->item_name . ' ' . $ord->items_details->item_unit . ' ' . $ord->items_details->item_type_details->type }}</td>
                                    <th>{{ $ord->quantity . ' ' . $ord->items_details->measure_details->unit }}
                                        <input type="hidden" value="{{ $ord->quantity }}" name="quantity[]">
                                        @php
                                            $total_qty += $ord->quantity;
                                            $total_purchase += $ord->items_details->purchase_price * $ord->quantity;
                                            $total_sale += $ord->items_details->sale_price * $ord->quantity;
                                        @endphp
                                    </th>
                                    <th>
                                        <input class="form-control" value="{{ $ord->items_details->purchase_price }}" name="purchase_price[]" required>
                                    </th>
                                    <th>
                                        <input class="form-control" value="{{ $ord->items_details->sale_price }}" name="sale_price[]" required>
                                    </th>
                                    <th>
                                        <input class="form-control" value="{{ $ord->items_details->sale_price * $ord->quantity }}" name="sale_price[]" required>
                                    </th>
                                    <th>
                                        <input type="date" class="form-control" name="expiry_date[]" required>
                                    </th>
                                </tr>
                            @endforeach
                            <tr>
                                <th colspan="2">{{ __('words.Total') }}</th>
                                <th>{{ $total_qty }}</th>
                                <th>{{ $total_purchase }}</th>
                                <th></th>
                                <th>{{ $total_sale }}</th>
                                <th></th>
                            </tr>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="">{{ __('words.USD TO AFG') }}</label>
                                        <input type="text" class="form-control" value="{{ $ex_rate->usd_afg }}" name="usd_afg" id="usd_afg" required>
                                        <input type="hidden" value="{{ $ex_rate->exchange_rate_id }}" name="exchange_rate_id">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">{{ __('words.USD TO KAL') }}</label>
                                        <input type="text" class="form-control" value="{{ $ex_rate->usd_kal }}" name="usd_kal" id="usd_kal" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">{{ __('words.Purchase In') }}</label>
                                        <select name="purchase_currency" id="purchase_currency" class="form-control select2" required>
                                            @foreach ($currencies as $currency)
                                                <option value="{{ $currency->currency_id }}" {{ $currency->currency_id == 1 ? 'selected' : '' }}>{{ $currency->currency }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label>{{ __('words.Bill Total') }}</label>
                                        <input type="text" class="form-control" id="total_bill" name="total" value="{{ $total_purchase }}">
                                        <input type="hidden" id="total_bill_usd" value="{{ $total_purchase }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="">{{ __('words.Pay Amount') }}</label>
                                <input type="text" name="paid_amount" value="0" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>{{ __('words.To Stock') }}</label>
                                <select name="stock_id" class="form-control select2" required>
                                    <option value="">{{ __('words.Select Stock') }}</option>
                                    @foreach ($stock as $stk)
                                        <option value="{{ $stk->stock_id }}">{{ $stk->stock_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{ __('words.Purchase Invoice') }} #</label>
                                <input class="form-control" name="purchase_invoice_no" placeholder="{{ __('words.Enter Purchase Invoice No') }}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label>{{ __('words.Purchase Date') }}</label>
                                <input class="form-control" name="purchase_date" data-date-format="yyyy-m-d" value="<?php echo date('Y-m-d'); ?>" autocomplete="off" data-provide="datepicker" data-date-autoclose="true" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 mr-2 float-right">{{ __('words.Save') }}</button>
                    </form>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
@section('script')
    <script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
    <script>
        $('#purchase_currency').change(function() {
            var purchase = $('#purchase_currency').val();
            if (purchase == 1) {
                $('#total_bill').val($('#total_bill_usd').val());
            } else if (purchase == 2) {
                $('#total_bill').val($('#total_bill_usd').val() * $('#usd_afg').val());
            } else if (purchase == 3) {
                $('#total_bill').val($('#total_bill_usd').val() * $('#usd_kal').val());
            }
        });
        $('.select2').select2();
    </script>
@endsection
@endsection
