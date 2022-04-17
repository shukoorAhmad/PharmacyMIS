@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">

<!-- new/update supplier modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_title">Add New Supplier</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('supplierstore') }}" id="store_form" autocomplete="off">
                    @csrf
                    <input type="hidden" value="0" id="edit_record_id" name="id">
                    <div class="form-group">
                        <label class="col-form-label">Supplier Name</label>
                        <input class="form-control" name="supplier_name" id="supplier_name" placeholder="Write Supplier Name Here..." autofocus required>
                        <div class="invalid-feedback supplier_name_error"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Supplier Email</label>
                        <input class="form-control" name="email" id="email" placeholder="Write Supplier Email Here...">
                        <div class="invalid-feedback email_error"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label">Supplier Contact No</label>
                        <input class="form-control" name="contact_no" id="contact_no" placeholder="Write Contact No Here...">
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
                <h4 class="card-title">Suppliers List</h4>
                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_modal">New Supplier <span class="fa fa-plus"></span></button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped  w-100 data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
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
            ajax: "{{route('supplier')}}",
            columns: [{
                    "data": 'supplier_id'
                },
                {
                    "data": 'name'
                },
                {
                    "data": 'email'
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
                        $("input[name=supplier_name]").val('');
                        $("input[name=email]").val('');
                        $("input[name=contact_no]").val('');
                        $('.data-table').DataTable().ajax.reload();
                        if ($('#edit_record_id').val() != '0') {
                            $('#add_modal').modal('hide');
                            $('#submit_btn').html('Save');
                            $('#edit_record_id').val('0');
                            $('#modal_title').html('Add New Supplier');
                            success("Supplier Successfully Updated!!!");
                        } else {
                            success("Supplier Successfully Added!!!");
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
        $('#modal_title').html('Edit Supplier');
        $('#submit_btn').html('Save Changes');
        $('#edit_record_id').val($(this).attr('data-id'));
        $('#supplier_name').val($(this).attr('data-name'));
        $('#email').val($(this).attr('data-email'));
        $('#contact_no').val($(this).attr('data-cno'));
        $('#add_modal').modal('show');
    });
    $('#close_btn').click(function() {
        $('#add_modal').modal('hide');
        $('#submit_btn').html('Save');
        $('#edit_record_id').val('0');
        $('#supplier_name').val('');
        $('#email').val('');
        $('#contact_no').val('');
        $('#modal_title').html('Add New Supplier');
    });
</script>

@endsection
@endsection