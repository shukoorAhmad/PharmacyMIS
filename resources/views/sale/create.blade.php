@extends('layouts.master')

@section('content')
<<<<<<< HEAD
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }
=======
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">
    <style>
        .select2-container{
            width: 100% !important;
        }
        .select2-container .select2-selection--single {
            height: 38px !important;
        }
>>>>>>> bd4ccdfcebef50383511ba2f49450df58f4becb9

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 34px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 6px !important;
    }

<<<<<<< HEAD
    .select2-container--default .select2-search--dropdown .select2-search__field {
        outline: none !important;
    }
</style>
<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">New Sale</h4>
                <a href="{{ route('seller-list') }}" class="btn btn-success mb-3">Sales List</a>
            </div>
            <form method="POST" action="{{ route('seller-store') }}">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label>Select Sale Type</label>
                        <select name="sale_type" id="sale_type" class="form-control select2" style="width: 100% !important;" required>
                            <option value="" selected disabled>Select Sale Type</option>
                            <option value="1">Customer</option>
                            <option value="2">Seller</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label id="show-label-name" class="w-100">Select</label>
                        <select name="customer_id" id="customer_id" class="form-control select2" style="width: 100% !important;" required>
                            <option value="" selected disabled>Select Sale Type</option>
                        </select>
                    </div>
                    <div class="col-md-4 visibility-hidden" id="percentage">
                        <label>Seller Percentage</label>
                        <select name="percentage" class="form-control select2" style="width: 100% !important;" required>
                            <option value="" selected disabled>Select Percentage</option>
                            @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}%</option>
                                @endfor
                        </select>
=======
        .select2-container--default .select2-search--dropdown .select2-search__field {
            outline: none !important;
        }
    </style>
    <div class="col-12 box-margin height-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">New Sale</h4>
                    <a href="{{ route('seller-list') }}" class="btn btn-success mb-3">Sales List</a>
                </div>
                <form method="POST" action="{{ route('seller-store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>Select Sale Type</label>
                            <select name="sale_type" id="sale_type" class="form-control select2" required>
                                <option value="" selected disabled>Select Sale Type</option>
                                <option value="1">Customer</option>
                                <option value="2">Seller</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label id="show-label-name">Select</label>
                            <select name="customer_id" id="customer_id" class="form-control select2" required>
                                <option value="" selected disabled>Select Sale Type</option>
                            </select>
                        </div>
                        <div class="col-md-4 visibility-hidden" id="percentage">
                            <label>Seller Percentage</label>
                            <select name="percentage" class="form-control select2" required>
                                <option value="" selected disabled>Select Percentage</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}%</option>
                                @endfor
                            </select>
                        </div>
                        <hr style="height: 1px !important;width:100% !important;border-top: 1px solid rgba(0,0,0,.1);">
                        <div class="col-md-4">
                            <label>Select Item</label>
                            <select name="item[]" class="form-control select2" required>
                                <option value="" selected disabled>Select Item</option>
                                @foreach ($items as $item)
                                    <option value="{{$item->item_details->item_id}}">{{$item->item_details->item_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Available To Stock</label>
                            <input class="form-control" value="" placeholder="Available To Stock">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Quantity</label>
                            <input class="form-control" placeholder="Quantity" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Sale Price</label>
                            <input class="form-control" placeholder="Sale Price" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Stock</label>
                            <input class="form-control" placeholder="Stock" required>
                        </div>
>>>>>>> bd4ccdfcebef50383511ba2f49450df58f4becb9
                    </div>
                    <div class="col-md-12 form-group">
                        <hr>
                        <label class="w-100">Select Item</label>
                        <select name="item_id" id="item_id" class="form-control" style="width: 100% !important;">
                            <option value="" selected disabled>Select Item</option>
                            @foreach($items as $item)
                            <option value="{{$item->stock_item_id}}">
                                {{'Item Name : '.$item->item_details->item_name .' '.$item->item_details->dose.' '.$item->item_details->measure_details->unit .' Quantity (Carton): '.  $item->quantity .' Stock '.$item->stock_details->stock_name}}
                            </option>
                            @endforeach
                        </select>
                        <div id="show-selected-items" class="mt-4"></div>
                        <button type="submit" id="sale-btn" class="btn btn-primary d-none mt-4">Sale</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    // $('body').addClass('sidebar-icon-only');
    $('#sale_type').change(function() {
        $('#sale_type').val() == 1 ? $('#show-label-name').html('Select Customer') : $('#show-label-name').html(
            'Select Seller');
        $('#sale_type').val() == 1 ? $('#percentage').addClass('visibility-hidden') : $('#percentage')
            .removeClass('visibility-hidden');
        $.get("{{ route('show-customer') }}/" + $('#sale_type').val(), function(response) {
            $('#customer_id').empty();
            $('#customer_id').append(response);
        });
    });

    function buttonFunction(number) {
        if (number > 0) {
            $('#sale-btn').removeClass('d-none');
        } else {
            $('#sale-btn').addClass('d-none');
        }
    }
    var count = 0;
    $('#item_id').change(function() {
        $.get("{{route('show-selected-item')}}/" + $('#item_id').val(), function(response) {
            $("#show-selected-items").append(response);
            count++;
            buttonFunction(count);
        });
    });

    $('.select2').select2();
    $('#item_id').select2({
        ajax: {
            url: "{{route('filter-items')}}",
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

    $(document).on('click', '.remove', function() {
        $(this).closest($('.field')).remove();
        count--;
        buttonFunction(count);
    });
</script>
<!-- Inject JS -->
@if (session()->has('success_insert'))
<script>
    success("{{ session()->get('success_insert') }}")
</script>
@endif
@endsection
@endsection