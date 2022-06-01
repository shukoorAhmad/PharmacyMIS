<div id="edit-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header bg-red">
                <h3 class="modal-title">آرشیف </h3>
            </div>
            <form action="" method="post">
                @csrf
                <input type="hidden" name="crd_detail_id" value="{{$id}}">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">نوعیت کارتن</label>
                        <select name="archive_type" id="" class="form-control" required>
                            <option value="" selected disabled>نوعیت کارتن را انتخاب نمایید</option>
                            <option value="1">ملکی</option>
                            <option value="2">دولتی</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">نمبر کارتن</label>
                        <input type="text" maxlength="3" class="form-control" name="carton_no" required>
                    </div>
                    <div class="form-group">
                        <label for="">سال</label>
                        <input type="text" name="year" class="form-control" maxlength="4" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><span class="fa fa-times"></span></button>
                    <button type="submit" class="btn btn-primary pull-right"><span class="fa fa-save"></span></button>
                </div>
            </form>
        </div>
    </div>
</div>
