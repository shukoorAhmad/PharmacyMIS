<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Stock {{$stock->stock_name}}</h5>
            </div>
            <form action="{{route('stockupdate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Stock Name</label>
                        <input class="form-control" name="stock_name" value="{{$stock->stock_name}}" autofocus required>
                        <input type="hidden" name="id" value="{{$stock->stock_id}}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Stock Address</label>
                        <input class="form-control" name="stock_address" value="{{$stock->stock_address}}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Incharge Name</label>
                        <input class="form-control" name="incharge_name" value="{{$stock->incharge}}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Contact No</label>
                        <input class="form-control" name="contact_no" value="{{$stock->contact_no}}">
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