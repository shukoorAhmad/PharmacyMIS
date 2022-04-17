@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<!-- new/update stock modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_title">Add New Stock</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('stockstore') }}" id="store_form" autocomplete="off">
                    @csrf
                    <input type="hidden" value="0" id="edit_record_id" name="id">
                    <div class="form-group">
                        <label class="col-form-label">Stock Name</label>
                        <input class="form-control" name="stock_name" id="stock_name" placeholder="Write Your Stock Here..." autofocus required>
                        <div class="invalid-feedback stock_name_error"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Stock Address</label>
                        <input class="form-control" name="stock_address" id="stock_address" placeholder="Write Your Stock Address Here..." required>
                        <div class="invalid-feedback stock_address_error"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Incharge Name</label>
                        <input class="form-control" name="incharge" id="incharge" placeholder="Write Your Incharge Here...">
                        <div class="invalid-feedback incharge_error"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Contact No</label>
                        <input type="number" class="form-control" name="contact_no" id="contact_no" placeholder="Write Your Stock Here..." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                        <div class="invalid-feedback contact_no_error"></div>
                    </div>
                    <button type="submit" id="submit_btn" class="btn btn-primary mb-2 mr-2">Save</button>
                    <button class="btn btn-danger  mb-2 mr-2" id="close_btn">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Stocks List</h4>
                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_modal">New Stock <span class="fa fa-plus"></span></button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped  w-100 data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Stock Name</th>
                            <th>Stock Address</th>
                            <th>Incharge Name</th>
                            <th>Contact No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->

@section('script')
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
<script>
    $(function() {
        var table = $('.data-table').DataTable({
            "bInfo": false,
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "aaSorting": [
                [0, "desc"]
            ],
            "info": true,
            processing: true,
            serverSide: true,
            ajax: "{{ route('stock') }}",
            columns: [{
                    "data": 'stock_id'
                },
                {
                    "data": 'stock_name'
                },
                {
                    "data": 'stock_address'
                },
                {
                    "data": 'incharge'
                },
                {
                    "data": 'contact_no'
                },
                {
                    "data": 'action'
                }
            ]
        });
    });

    var submit_btn = false;
    $(document).on('submit', '#store_form', function(event) {
        event.preventDefault();
        if (!submit_btn) {
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: $(this).serialize(),
                dataType: 'html',
                beforeSend: function() {
                    submit_btn = true;
                    $('#preloader-area').fadeIn('slow', function() {
                        $(this).show();
                    });
                },
                success: function(data) {
                    if (data == true) {
                        submit_btn = false;
                        $('#preloader-area').fadeOut('slow', function() {
                            $(this).hide();
                        });
                        $("input[name=stock_name]").val('');
                        $("input[name=stock_address]").val('');
                        $("input[name=incharge]").val('');
                        $("input[name=contact_no]").val('');
                        $('.data-table').DataTable().ajax.reload();
                        if ($('#edit_record_id').val() != '0') {
                            $('#add_modal').modal('hide');
                            $('#submit_btn').html('Save');
                            $('#edit_record_id').val('0');
                            $('#modal_title').html('Add New Stock');
                            success("Stock Successfully Updated!!!");
                        } else {
                            success("Stock Successfully Added!!!");
                        }
                    } else {
                        var response = JSON.parse(data);
                        $.each(response, function(prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                            $("input[name=" + prefix + "]").addClass('is-invalid');
                        });
                    }
                    $('#preloader-area').fadeOut('slow', function() {
                        $(this).hide();
                    });
                    submit_btn = false;
                },
                error: function() {
                    error_function("There Is A Problem Please Contact Your Administrator!");
                    submit_btn = false;
                }
            });
        }
    });

    $(document).on('click', '.edit_btn', function() {
        $('#modal_title').html('Edit Customer');
        $('#submit_btn').html('Save Changes');
        $('#edit_record_id').val($(this).attr('data-id'));
        $("input[name=stock_name]").val($(this).attr('data-name'));
        $("input[name=stock_address]").val($(this).attr('data-address'));
        $("input[name=incharge]").val($(this).attr('data-incharge'));
        $("input[name=contact_no]").val($(this).attr('data-cno'));
        $('#add_modal').modal('show');
    });

    $('#close_btn').click(function() {
        $('#add_modal').modal('hide');
        $('#submit_btn').html('Save');
        $('#edit_record_id').val('0');
        $("input[name=stock_name]").val('');
        $("input[name=stock_address]").val('');
        $("input[name=incharge]").val('');
        $("input[name=contact_no]").val('');
        $('#modal_title').html('Add New Stock');
    });
</script>
@endsection
@endsection