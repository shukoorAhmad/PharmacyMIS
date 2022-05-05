<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">

<div class="row show_items">
    <div class="form-group col-md-6">
        <label class="col-form-label">Item Name</label>
        <select name="item[]" class="form-control select2" required>
            <option value="" selected disabled>Please Select Item</option>
            @foreach ($items as $item)
            <option value="{{ $item->item_id }}">{{ $item->item_name . ' ' . $item->item_unit . ' ' . $item->item_type_details->type }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-md-4">
        <label>Item Quantity</label>
        <input type="number" class="form-control" name="quantity[]" required>
    </div>
    <div class="col-md-2">
        <a class="btn btn-danger w-100 close_btn" style="padding: 7px 1.75rem !important;margin-left:-12px !important;margin-top:30px !important;font-size:14px !important;">
            <i class="zmdi zmdi-close text-white"></i>
        </a>
    </div>
</div>
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    $('.select2').select2();
</script>