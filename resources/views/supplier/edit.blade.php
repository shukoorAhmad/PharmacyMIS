<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h3 class="modal-title text-white">Edit Supplier {{$supplier->name}}</h3>
            </div>
            <form action="{{route('supplierupdate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Supplier Name</label>
                        <input class="form-control" name="supplier_name" value="{{$supplier->name}}" autofocus required>
                        <input type="hidden" name="id" value="{{$supplier->supplier_id}}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Supplier Email</label>
                        <input class="form-control" name="email" value="{{$supplier->email}}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Supplier Contact No</label>
                        <input class="form-control" name="contact_no" value="{{$supplier->contact_no}}">
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