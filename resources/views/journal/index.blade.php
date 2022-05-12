@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">
<link rel="stylesheet" href="{{asset('public/radio-button/index.css')}}">

<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-bordered nav-justified">
                <li class="nav-item">
                    <a href="#cash-tab" data-toggle="tab" aria-expanded="false" class="nav-link active set_radio_value_0">
                        Cash
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#expense-tab" data-toggle="tab" aria-expanded="true" class="nav-link set_radio_value_0">
                        Expense
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#customer-tab" data-toggle="tab" aria-expanded="false" class="nav-link set_radio_value_0">
                        Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#seller-tab" data-toggle="tab" aria-expanded="false" class="nav-link set_radio_value_0">
                        Sellers
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#supplier-tab" data-toggle="tab" aria-expanded="false" class="nav-link set_radio_value_0">
                        Suppliers
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="cash-tab">
                    <form action="{{route('cash-store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-2" style="margin-top: 30px !important;">
                                <div id="div1" class="selectGroup">
                                </div>
                                <input type="hidden" name="in_out" class="radio-value" value="0">
                            </div>
                            <div class="form-group col-md-2">
                                <label>USD</label>
                                <input name="usd" class="form-control inputNumeral check usd" value="0">
                                <label class="text-danger usd_error"></label>
                            </div>
                            <div class="form-group col-md-2">
                                <label>AFG</label>
                                <input name="afg" class="form-control inputNumeral check afg" value="0">
                                <div class="text-danger afg_error"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label>KAL</label>
                                <input name="kal" class="form-control inputNumeral check kal" value="0">
                                <div class="text-danger kal_error"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label>USD to AFG</label>
                                <input name="usd_afg" class="form-control inputNumeral" value="{{$exchange_rate->usd_afg}}">
                                <input type="hidden" name="exchange_rate_id" class="form-control inputNumeral" value="{{$exchange_rate->exchange_rate_id}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>USD to Kal</label>
                                <input name="usd_kal" class="form-control inputNumeral" value="{{$exchange_rate->usd_kal}}">
                            </div>
                            <div class="form-group col-md-10">
                                <label>Comment</label>
                                <input name="comment" class="form-control" placeholder="Write your comments here...">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mr-2 w-100 submit" style="margin-top:28px !important;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="expense-tab">
                    <form action="{{route('expense-store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>USD</label>
                                        <input name="usd" class="form-control inputNumeral check-expense usd_expense" value="0">
                                        <label class="text-danger usd_expense_error"></label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>AFG</label>
                                        <input name="afg" class="form-control inputNumeral check-expense afg_expense" value="0">
                                        <div class="text-danger afg_expense_error"></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>KAL</label>
                                        <input name="kal" class="form-control inputNumeral check-expense kal_expense" value="0">
                                        <div class="text-danger kal_expense_error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label>USD to AFG</label>
                                <input name="usd_afg" class="form-control inputNumeral" value="{{$exchange_rate->usd_afg}}">
                                <input type="hidden" name="exchange_rate_id" class="form-control inputNumeral" value="{{$exchange_rate->exchange_rate_id}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label>USD to Kal</label>
                                <input name="usd_kal" class="form-control inputNumeral" value="{{$exchange_rate->usd_kal}}">
                            </div>
                            <input type="hidden" name="in_out" class="expense-radio-value" value="1">
                            <div class="form-group col-md-10">
                                <label>Comment</label>
                                <input name="comment" class="form-control" placeholder="Write your comments here...">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mr-2 w-100 submit_expense" style="margin-top:28px !important;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="customer-tab">
                    <form action="{{route('customer-store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-2" style="margin-top: 30px !important;">
                                <div id="div2" class="selectGroup">
                                </div>
                                <input type="hidden" name="in_out" class="radio-value" value="0">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Customer</label>
                                <select class="form-control select2" style="width: 100% !important;" name="customer" id="customer" required>
                                    <option value="" selected disabled>Select Customer</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>USD</label>
                                <input name="usd" class="form-control inputNumeral check-customer usd_customer" value="0">
                                <label class="text-danger usd_customer_error"></label>
                            </div>
                            <div class="form-group col-md-2">
                                <label>AFG</label>
                                <input name="afg" class="form-control inputNumeral check-customer afg_customer" value="0">
                                <div class="text-danger afg_customer_error"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label>KAL</label>
                                <input name="kal" class="form-control inputNumeral check-customer kal_customer" value="0">
                                <div class="text-danger kal_customer_error"></div>
                            </div>
                            <div class="form-group col-md-7">
                                <label>Comment</label>
                                <input name="comment" class="form-control" placeholder="Write your comments here...">
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>USD to AFG</label>
                                        <input id="" name="usd_afg" class="form-control inputNumeral" value="{{$exchange_rate->usd_afg}}">
                                        <input type="hidden" name="exchange_rate_id" class="form-control inputNumeral" value="{{$exchange_rate->exchange_rate_id}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>USD to Kal</label>
                                        <input id="" name="usd_kal" class="form-control inputNumeral" value="{{$exchange_rate->usd_kal}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mr-2 w-100 submit_customer" style="margin-top:28px !important;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="seller-tab">
                    <form action="{{route('seller-store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-2" style="margin-top: 30px !important;">
                                <div id="div3" class="selectGroup">
                                </div>
                                <input type="hidden" name="in_out" class="radio-value" value="0">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Seller</label>
                                <select class="form-control select2" style="width: 100% !important;" name="seller" id="seller" required>
                                    <option value="" selected disabled>Select Seller</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>USD</label>
                                <input name="usd" class="form-control inputNumeral check-seller usd_seller" value="0">
                                <label class="text-danger usd_seller_error"></label>
                            </div>
                            <div class="form-group col-md-2">
                                <label>AFG</label>
                                <input name="afg" class="form-control inputNumeral check-seller afg_seller" value="0">
                                <div class="text-danger afg_seller_error"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label>KAL</label>
                                <input name="kal" class="form-control inputNumeral check-seller kal_seller" value="0">
                                <div class="text-danger kal_seller_error"></div>
                            </div>
                            <div class="form-group col-md-7">
                                <label>Comment</label>
                                <input name="comment" class="form-control" placeholder="Write your comments here...">
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>USD to AFG</label>
                                        <input id="" name="usd_afg" class="form-control inputNumeral" value="{{$exchange_rate->usd_afg}}">
                                        <input type="hidden" name="exchange_rate_id" class="form-control inputNumeral" value="{{$exchange_rate->exchange_rate_id}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>USD to Kal</label>
                                        <input id="" name="usd_kal" class="form-control inputNumeral" value="{{$exchange_rate->usd_kal}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mr-2 w-100 submit_seller" style="margin-top:28px !important;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="supplier-tab">
                    <form action="{{route('supplier-store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-2" style="margin-top: 30px !important;">
                                <div id="div4" class="selectGroup">
                                </div>
                                <input type="hidden" name="in_out" class="radio-value" value="0">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Supplier</label>
                                <select class="form-control select2" style="width: 100% !important;" name="supplier" id="supplier" required>
                                    <option value="" selected disabled>Select Supplier</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label>USD</label>
                                <input name="usd" class="form-control inputNumeral check-supplier usd_supplier" value="0">
                                <label class="text-danger usd_supplier_error"></label>
                            </div>
                            <div class="form-group col-md-2">
                                <label>AFG</label>
                                <input name="afg" class="form-control inputNumeral check-supplier afg_supplier" value="0">
                                <div class="text-danger afg_supplier_error"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label>KAL</label>
                                <input name="kal" class="form-control inputNumeral check-supplier kal_supplier" value="0">
                                <div class="text-danger kal_supplier_error"></div>
                            </div>
                            <div class="form-group col-md-7">
                                <label>Comment</label>
                                <input name="comment" class="form-control" placeholder="Write your comments here...">
                            </div>
                            <div class="col-md-3">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>USD to AFG</label>
                                        <input id="" name="usd_afg" class="form-control inputNumeral" value="{{$exchange_rate->usd_afg}}">
                                        <input type="hidden" name="exchange_rate_id" class="form-control inputNumeral" value="{{$exchange_rate->exchange_rate_id}}">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>USD to Kal</label>
                                        <input id="" name="usd_kal" class="form-control inputNumeral" value="{{$exchange_rate->usd_kal}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mr-2 w-100 submit_seller" style="margin-top:28px !important;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<!-- Inject JS -->
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script src="{{ asset('public/radio-button/toggle.js') }}"></script>
<script src="{{asset('public/js/default-assets/cleave.min.js')}}"></script>
@if(session()->has('success_insert'))
<script>
    success("{{session()->get('success_insert')}}");
</script>
@endif
@if(session()->has('error_transaction'))
<script>
    error_function("{{session()->get('error_transaction')}}");
</script>
@endif
<script>
    // to set radio values to zero
    $(document).on('click', '.set_radio_value_0', function() {
        $('.selectItem[value=0]').addClass('selected');
        $('.selectItem[value=1]').removeClass('selected');
        $('.radio-value').val(0);
    });
    // to initialize select 2
    $('.select2').select2();
    // to check for all zero values
    $(document).on('click', '.submit', function() {
        if ($('.usd').val() == 0 && $('.afg').val() == 0 && $('.kal').val() == 0) {
            error_function('please enter value');
            return false;
        } else {
            return true;
        }
    });
    // input number validations
    $('.inputNumeral').toArray().forEach(function(field) {
        new Cleave(field, {
            numeral: !0,
            numeralThousandsGroupStyle: "false"
        });
    });
    // to initialize cash tab in_out radio buttons
    $("#div1").setupToggles();
    // to change radio type value of cash tab
    $(document).on('click', '.zero', function() {
        $(this).attr('value') == '0' ? $('.radio-value').val(0) : $('.radio-value').val(1);
    });
    // to check available cash
    $(document).on('keyup', '.check', function() {
        if ($('.radio-value').val() == 1) {
            var name = $(this).attr('name');
            $.get("{{route('check-money')}}/" + $(this).val() + "/" + name, function(response) {
                if (response != 1) {
                    $('.' + name + '_error').html('You Have ' + response + ' ' + name);
                    $('.' + name).css('border-color', '#dc3545');
                    $('.submit').attr('disabled', 'disabled');
                    $('.submit').css('cursor', 'not-allowed');
                } else {
                    $('.' + name).css('border-color', '#5867dd');
                    $('.' + name + '_error').html('');
                    $('.' + name + '_error').focus();
                    $('.submit').removeAttr('disabled');
                }
            });
        } else {
            $('.' + name).css('border-color', '#5867dd');
            $('.' + name + '_error').html('');
            $('.' + name + '_error').focus();
            $('.submit').removeAttr('disabled');
        }
    });
    // to check available cash in expense tab
    $(document).on('keyup', '.check-expense', function() {
        var name = $(this).attr('name');
        $.get("{{route('check-money')}}/" + $(this).val() + "/" + name, function(response) {
            if (response != 1) {
                $('.' + name + '_expense_error').html('You Have ' + response + ' ' + name);
                $('.' + name + '_expense').css('border-color', '#dc3545');
                $('.submit_expense').attr('disabled', 'disabled');
                $('.submit_expense').css('cursor', 'not-allowed');
            } else {
                $('.' + name + '_expense').css('border-color', '#5867dd');
                $('.' + name + '_expense_error').html('');
                $('.' + name + '_expense_error').focus();
                $('.submit_expense').removeAttr('disabled');
            }
        });
    });
    // to initialize customer tab in_out radio buttons
    $("#div2").setupToggles();
    // customer list server side
    $('#customer').select2({
        ajax: {
            url: "{{ route('filter-customer') }}",
            type: "get",
            dataType: 'json',
            delay: 200,
            data: function(params) {
                return {
                    search: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
    // to check available cash in customer tab
    $(document).on('keyup', '.check-customer', function() {
        var name = $(this).attr('name');
        if ($('.radio-value').val() == 1) {
            $.get("{{route('check-money')}}/" + $(this).val() + "/" + name, function(response) {
                if (response != 1) {
                    $('.' + name + '_customer_error').html('You Have ' + response + ' ' + name);
                    $('.' + name + '_customer').css('border-color', '#dc3545');
                    $('.submit_customer').attr('disabled', 'disabled');
                    $('.submit_customer').css('cursor', 'not-allowed');
                } else {
                    $('.' + name + '_customer').css('border-color', '#5867dd');
                    $('.' + name + '_customer_error').html('');
                    $('.' + name + '_customer_error').focus();
                    $('.submit_customer').removeAttr('disabled');
                }
            });
        } else {
            $('.' + name + '_customer').css('border-color', '#5867dd');
            $('.' + name + '_customer_error').html('');
            $('.' + name + '_customer_error').focus();
            $('.submit_customer').removeAttr('disabled');
        }
    });
    // to initialize seller tab in_out radio buttons
    $("#div3").setupToggles();
    // seller list server side
    $('#seller').select2({
        ajax: {
            url: "{{ route('filter-seller') }}",
            type: "get",
            dataType: 'json',
            delay: 200,
            data: function(params) {
                return {
                    search: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
    // to check available cash in seller tab
    $(document).on('keyup', '.check-seller', function() {
        var name = $(this).attr('name');
        if ($('.radio-value').val() == 1) {
            $.get("{{route('check-money')}}/" + $(this).val() + "/" + name, function(response) {
                if (response != 1) {
                    $('.' + name + '_seller_error').html('You Have ' + response + ' ' + name);
                    $('.' + name + '_seller').css('border-color', '#dc3545');
                    $('.submit_seller').attr('disabled', 'disabled');
                    $('.submit_seller').css('cursor', 'not-allowed');
                } else {
                    $('.' + name + '_seller').css('border-color', '#5867dd');
                    $('.' + name + '_seller_error').html('');
                    $('.' + name + '_seller_error').focus();
                    $('.submit_seller').removeAttr('disabled');
                }
            });
        } else {
            $('.' + name + '_seller').css('border-color', '#5867dd');
            $('.' + name + '_seller_error').html('');
            $('.' + name + '_seller_error').focus();
            $('.submit_seller').removeAttr('disabled');
        }
    });
    // to initialize supplier tab in_out radio buttons
    $("#div4").setupToggles();
    // seller list server side
    $('#supplier').select2({
        ajax: {
            url: "{{ route('filter-supplier') }}",
            type: "get",
            dataType: 'json',
            delay: 200,
            data: function(params) {
                return {
                    search: params.term // search term
                };
            },
            processResults: function(response) {
                return {
                    results: response
                };
            },
            cache: true
        }
    });
    // to check available cash in seller tab
    $(document).on('keyup', '.check-supplier', function() {
        var name = $(this).attr('name');
        if ($('.radio-value').val() == 1) {
            $.get("{{route('check-money')}}/" + $(this).val() + "/" + name, function(response) {
                if (response != 1) {
                    $('.' + name + '_supplier_error').html('You Have ' + response + ' ' + name);
                    $('.' + name + '_supplier').css('border-color', '#dc3545');
                    $('.submit_supplier').attr('disabled', 'disabled');
                    $('.submit_supplier').css('cursor', 'not-allowed');
                } else {
                    $('.' + name + '_supplier').css('border-color', '#5867dd');
                    $('.' + name + '_supplier_error').html('');
                    $('.' + name + '_supplier_error').focus();
                    $('.submit_supplier').removeAttr('disabled');
                }
            });
        } else {
            $('.' + name + '_supplier').css('border-color', '#5867dd');
            $('.' + name + '_supplier_error').html('');
            $('.' + name + '_supplier_error').focus();
            $('.submit_supplier').removeAttr('disabled');
        }
    });
</script>
@endsection
@endsection