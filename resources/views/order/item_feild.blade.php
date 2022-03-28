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
<div class="row show_items">
    <div class="form-group col-md-6">
        <label class="col-form-label">Item Name</label>
        <select name="item[]" class="form-control select2">
            <option value="" selected disabled>Please Select Item</option>
            @foreach ($items as $item)
                <option value="{{ $item->item_id }}">{{ $item->item_name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label>Item Quantity</label>
        <input type="number" class="form-control" name="quantity[]">
    </div>
    <div class="col-md-2">
        <a class="btn btn-danger w-100 close_btn"
            style="padding: 7px 1.75rem !important;margin-left:-12px !important;margin-top:30px !important;font-size:14px !important;">
            <i class="zmdi zmdi-close text-white"></i>
        </a>
    </div>
</div>
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    $('.select2').select2();
</script>