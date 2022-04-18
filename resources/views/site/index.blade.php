@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">

<!-- new/update site modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_title">Add New Site</h5>
            </div>
            <div class="modal-body">
                <form id="store_form" method="POST" action="{{ route('sitestore') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" value="0" name="id" id="edit_record_id">
                    <div class="form-group">
                        <label for="site_name" class="col-form-label">Site Name</label>
                        <input class="form-control" name="site_name" required id="site_name" placeholder="Write Site Name Here...">
                        <div class="invalid-feedback site_name_error"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label w-100">Province</label>
                        <select name="province" class="form-control select2" id="province" style="width: 100%;" required>
                            <option value="" selected disabled>Please Select Province</option>
                            @foreach ($province as $pro)
                            <option value="{{ $pro->province_id }}">{{ $pro->name_en }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback province_error"></div>
                    </div>
                    <button type="submit" id="submit_btn" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" id="close_btn">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">Site List</h4>
                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_modal">New Site <span class="fa fa-plus"></span></button>
            </div>
            <div class="table-responsive">
                <table class="table table-striped w-100 data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Site Name</th>
                            <th>Province</th>
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
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
<script type="text/javascript">
    $('.select2').select2();
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
            ajax: "{{route('site')}}",
            columns: [{
                    "data": 'site_id'
                },
                {
                    "data": 'site_name'
                },
                {
                    "data": 'province_name'
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
                        $("input[name=site_name]").val('');
                        $("select[name=province]").val('').trigger('change');
                        $('.data-table').DataTable().ajax.reload();
                        if ($('#edit_record_id').val() != '0') {
                            $('#add_modal').modal('hide');
                            $('#submit_btn').html('Save');
                            $('#edit_record_id').val('0');
                            $('#modal_title').html('Add New Site');
                            success("Site Successfully Updated!!!");
                        } else {
                            success("Site Successfully Added!!!");
                        }
                    } else {
                        var response = JSON.parse(data);
                        $.each(response, function(prefix, val) {
                            $('div.' + prefix + '_error').text(val[0]);
                            $("input[name=" + prefix + "]").addClass('is-invalid');
                            $("select[name=" + prefix + "]").addClass('is-invalid');
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
        $('#modal_title').html('Edit Site');
        $('#submit_btn').html('Save Changes');
        $('#edit_record_id').val($(this).attr('data-id'));
        $("#province").select2("val", $(this).attr('data-province'));
        $('#site_name').val($(this).attr('data-site'));
        $('#add_modal').modal('show');
    });
    $('#close_btn').click(function() {
        $('#add_modal').modal('hide');
        $('#submit_btn').html('Save');
        $('#edit_record_id').val('0');
        $("#province").select2("val", '');
        $('#site_name').val('');
        $('#modal_title').html('Add New Site');
    });
</script>
<!-- Inject JS -->
@endsection
@endsection