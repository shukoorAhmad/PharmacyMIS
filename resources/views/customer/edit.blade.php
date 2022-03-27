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
                <h4 class="modal-title text-white">Edit Customer {{$customer->pharmacy_name}} </h4>
            </div>
            <form action="{{ route('update-customer') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Pharmacy Name</label>
                        <input class="form-control" name="pharmacy_name" value="{{ $customer->pharmacy_name }}" autofocus required>
                        <input type="hidden" name="id" value="{{ $customer->customer_id }}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Customer Name</label>
                        <input class="form-control" name="customer_name" value="{{ $customer->customer_name }}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Customer Last Name</label>
                        <input class="form-control" name="customer_last_name" value="{{ $customer->customer_last_name }}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Customer Site</label>
                        <select name="site_id" class="form-control select2" style="width: 100% !important;" required>
                            @foreach($site as $site_row)
                            <option value="{{$site_row->site_id}}" {{$site_row->site_id==$customer->site_id?'selected':''}}>{{$site_row->site_name.' '.$site_row->prov_id->en_province}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Contact No 1</label>
                            <input type="number" class="form-control" name="contact_no" value="{{$customer->contact_no}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">Contact No 2</label>
                            <input type="number" class="form-control" name="contact_no_2" value="{{$customer->contact_no_2}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span></button>
                    <button type="submit" class="btn btn-primary"><span class="fa fa-save"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('public/js/default-assets/select2.min.js')}}"></script>
<script>
    $('.select2').select2();
</script>