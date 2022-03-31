<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Edit Site {{$site->site_name}}</h5>
            </div>
            <form action="{{route('siteUpdate')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-form-label">Site</label>
                        <input class="form-control  @error('site_name') is-invalid @enderror" name="site_name" value="{{$site->site_name}}" autofocus required>
                        <input type="hidden" name="id" value="{{$site->site_id}}">
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Province</label>
                        <select name="province" class="form-control select2 @error('province') is-invalid @enderror" required>
                            @foreach($province as $pro)
                            <option value="{{$pro->province_id}}" {{$site->province==$pro->province_id?'selected':''}}>{{$pro->en_province}}</option>
                            @endforeach
                        </select>
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