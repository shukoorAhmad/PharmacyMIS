div
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
<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Item {{ $item->item_name }}</h5>
            </div>
            <form action="{{ route('itemupdate') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Item Name</label>
                        <input class="form-control" name="item_name" value="{{ $item->item_name }}" autofocus
                            required>
                        <input type="hidden" name="id" value="{{ $item->item_id }}">
                    </div>
                    <div class="row p-0">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Dose</label>
                            <input class="form-control" name="dose" value="{{ $item->dose }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Measure Units</label>
                            <select name="measure_id" class="form-control select2" style="width: 100% !important;">
                                <option value="" selected disabled>Please Select Company</option>
                                @foreach ($measure_units as $unit)
                                    <option value="{{ $unit->measure_unit_id }}"
                                        {{ $unit->measure_unit_id == $item->measure_unit_id ? 'selected' : '' }}>
                                        {{ $unit->unit }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Item Quantity</label>
                        <input class="form-control" name="qty_per_carton" value="{{ $item->quantity_per_carton }}">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span
                            class="fa fa-times"></span></button>
                    <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    $('.select2').select2();
</script>
