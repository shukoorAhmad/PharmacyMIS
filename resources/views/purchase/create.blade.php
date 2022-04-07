@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">
<style>
    .select2-container .select2-selection--single {
        height: 38px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 34px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        top: 6px !important;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        outline: none !important;
    }
</style>

<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title mb-2">New Purchase</h4>
                <a href="{{route('purchase-list')}}" class="btn btn-success mb-3">Purchase List</a>
            </div>
            <form method="POST" action="{{ route('store-purchase') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-10">
                        <label class="col-form-label">Supplier Name</label>
                        <select name="supplier_id" id="supplier" class="form-control select2">
                            <option value="" selected disabled>Please Select Company</option>
                            @foreach ($supplier as $sup)
                            <option value="{{ $sup->supplier_id }}">{{ $sup->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-2" style="margin-top: 34px;">
                        <a class="btn btn-primary w-100" id="add_items" style="padding: 7px 1.75rem !important;"><i class="zmdi zmdi-plus text-white" style="font-size:18px !important;"></i></a>
                    </div>
                    <div class="col-md-12 pr-0" id="showItems">
                    </div>
                    <hr style="height: 1px !important;width:100% !important;border-top: 1px solid rgba(0,0,0,.1);">
                    <div class="form-group col-md-4">
                        <label>To Stock</label>
                        <select name="stock_id" class="form-control select2" required>
                            <option value="">Select Stock</option>
                            @foreach($stock as $stk)
                            <option value="{{$stk->stock_id}}">{{$stk->stock_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Purchase Invoice #</label>
                        <input class="form-control" name="purchase_invoice_no" placeholder="Enter Purchase Invoice No" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Purchase Date:</label>
                        <input class="form-control" name="purchase_date" data-date-format="yyyy-m-d" value="<?php echo date('Y-m-d'); ?>" autocomplete="off" data-provide="datepicker" data-date-autoclose="true" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-2 mt-3 d-none" id="submit_btn">Save</button>
            </form>
        </div>
    </div>
</div>


@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    $('#supplier').change(function() {
        $('#showItems').empty();
        $('#submit_btn').addClass('d-none');
    });
    var counter = 0;

    function hide_btn() {
        counter > 0 ? $('#submit_btn').removeClass('d-none') : $('#submit_btn').addClass('d-none');
    }
    $(document).on('click', '.close_btn', function() {
        $(this).closest($('.show_items')).remove();
        counter--;
        hide_btn();
    });

    $('#add_items').click(function() {
        if ($('#supplier').val() == null) {
            error_function("Please Select Supplier First");
        } else {
            $.get("{{ route('add_new_item') }}", function(response) {
                $('#showItems').append(response);
                counter++;
                hide_btn();
            });
        }
    });

    $('.select2').select2();
</script>
@if (session()->has('success_insert'))
<script>
    success("{{ session()->get('success_insert') }}")
</script>
@endif
@endsection
@endsection