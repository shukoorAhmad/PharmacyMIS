<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Seller {{$seller->seller_name}} </h5>
            </div>
            <form action="{{ route('update-seller') }}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Seller Name</label>
                        <input class="form-control" name="seller_name" value="{{ $seller->seller_name }}" required>
                        <input type="hidden" name="id" value="{{ $seller->seller_id }}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Seller Last Name</label>
                        <input class="form-control" name="seller_last_name" value="{{ $seller->seller_last_name }}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Contact No 1</label>
                        <input type="number" class="form-control" name="contact_no" value="{{$seller->contact_no}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10" required>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Contact No 2</label>
                        <input type="number" class="form-control" name="contact_no_2" value="{{$seller->contact_no_2}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Address</label>
                        <input class="form-control" name="address" value="{{$seller->address}}">
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