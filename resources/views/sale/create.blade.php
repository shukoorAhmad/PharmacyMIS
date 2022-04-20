@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">
<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">New Sale</h4>
                <a href="" class="btn btn-success mb-3">Sales List</a>
            </div>
            <form method="POST" action="{{ route('sale-store') }}">
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
                        <select name="percentage" class="form-control select2" style="width: 100% !important;">
                            <option value="" selected disabled>Select Percentage</option>
                            @for ($i = 1; $i <= 10; $i++) <option value="{{ $i }}">{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}%</option>
                                @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-12 form-group p-0">
                    <hr>
                    <label class="w-100">Select Item</label>
                    <select name="item_id" id="item_id" class="form-control" style="width: 100% !important;">
                        <option value="" selected disabled>Select Item</option>
                    </select>
                </div>
                <div class="mt-4" id="show-selected-items">

                </div>
                <div class="p-0 m-0 d-none" id="sale-div">
                    <div class="row">
                        <div class="form-group col-md-2">
                            <label>Sale Date</label>
                            <input type="date" class="form-control" name="sale_date" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Total Bill (AFG)</label>
                            <input type="text" class="form-control" id="total_bill" value="0" name="total">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Pay Amount (AFG)</label>
                            <input type="text" class="form-control" name="paid_amount" value="0">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Comment</label>
                            <input type="text" class="form-control" name="comment" placeholder="Write Any Comment...">
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Sale</button>
                </div>
                <!-- </div> -->
            </form>
        </div>
    </div>
</div>
<input type="hidden" id="i-value" value="0">

@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
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
        number > 0 ? $('#sale-div').removeClass('d-none') : $('#sale-div').addClass('d-none');
    }
    var total_amount_array = [];
    var count = 0;
    $('#item_id').change(function() {
        $.get("{{ route('show-selected-item') }}/" + $('#item_id').val() + "/" + $('#i-value').val(), function(response) {
            $("#show-selected-items").append(response);
            count++;
            buttonFunction(count);

            var inputs = $(".total-every-row");
            total_amount_array = [];
            for (var i = 0; i < inputs.length; i++) {
                total_amount_array.push($(inputs[i]).val());
            }
            $('#total_bill').val(eval(total_amount_array.join("+")));
        });
    });

    $(document).on('change', '.sale-amount', function() {
        var x = $(this).attr('sp-id');
        var value = parseFloat($(this).val());

        var qty = $('#qty_const' + x).val();
        $('#qty_' + x).val(qty - value);

        var y = parseFloat($('#sale-price' + x).val());
        // alert(y);
        $('#total-value' + x).val(value * y);

        var inputs = $(".total-every-row");
        total_amount_array = [];
        for (var i = 0; i < inputs.length; i++) {
            total_amount_array.push($(inputs[i]).val());
        }
        $('#total_bill').val(eval(total_amount_array.join("+")));
    });

    $('.select2').select2();
    $('#item_id').select2({
        ajax: {
            url: "{{ route('filter-items') }}",
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
        $('#total_bill').val(parseFloat($('#total_bill').val()) - parseFloat($('#total-value' + $(this).attr('id')).val()));
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