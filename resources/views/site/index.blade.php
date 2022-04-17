@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
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

    .odd>td,
    .even>td {
        text-align: center !important;
    }
</style>
<!-- new site modal -->
<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Add New Site</h5>
            </div>
            <div class="modal-body">
                <form id="store_form" method="POST" action="{{ route('sitestore') }}">
                    @csrf
                    <div class="form-group">
                        <label for="site_name" class="col-form-label">Site Name</label>
                        <input class="form-control" name="site_name" required id="site_name" placeholder="Write Site Name Here...">
                        <div class="invalid-feedback site_name_error"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label w-100">Province</label>
                        <select name="province" class="form-control select2" style="width: 100%;" required>
                            <option value="" selected disabled>Please Select Province</option>
                            @foreach ($province as $pro)
                            <option value="{{ $pro->province_id }}">{{ $pro->name_en }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback province_error"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Close</button>
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
                <table class="table table-striped nowrap w-100 data-table">
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
<!-- edit modal -->
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Edit Site </h5>
            </div>
            <div class="modal-body">
                <form method="POST" id="edit_form" action="{{ route('siteUpdate') }}">
                    @csrf
                    <input type="hidden" id="edit_record_id" name="id" value="">
                    <div class="form-group">
                        <label for="site_name" class="col-form-label">Site Name</label>
                        <input class="form-control" name="site_name" required id="edit_site_name" placeholder="Write Site Name Here...">
                        <div class="invalid-feedback site_name_error"></div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label w-100">Province</label>
                        <select name="province" class="form-control select2" id="edit_province" style="width: 100%;" required>
                            <option value="" selected disabled>Please Select Province</option>
                            @foreach ($province as $pro)
                            <option value="{{ $pro->province_id }}">{{ $pro->name_en }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback province_error"></div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal" aria-label="Close">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
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
    var store_form_submited = false;
    $(document).on('submit', '#store_form', function(event) {
        event.preventDefault();
        if (!store_form_submited) {
            $.ajax({
                url: $(this).attr('action'),
                type: 'post',
                data: $(this).serialize(),
                dataType: 'html',
                beforeSend: function() {
                    store_form_submited = true;
                    $('#preloader-area').fadeIn('slow', function() {
                        $(this).show();
                    });
                },
                success: function(data) {
                    if (data == true) {
                        store_form_submited = false;
                        $('#preloader-area').fadeOut('slow', function() {
                            $(this).hide();
                        });
                        $("input[name=site_name]").val('');
                        $("select[name=province]").val('').trigger('change');
                        $('.data-table').DataTable().ajax.reload();
                        success("Site Successfully Added!!!");
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
                    store_form_submited = false;
                },
                error: function() {
                    error_function("There Is A Problem Please Contact Your Administrator!");
                    store_form_submited = false;
                }
            });
        }
    });
    $(document).on('click', '.edit_btn', function(event) {
        
        var url = $(this).attr('action');
        $.ajax({
            url: url,
            type: 'get',
            data: {
                'id': province_id
            },
            dataType: 'html',
            beforeSend: function() {
                $('.someBlock').preloader({
                    zIndex: '6666666666'
                });
            },
            success: function(data) {
                var districts = JSON.parse(data);
                var value = `<option value="">--انتخاب ولسوالی--</option>`;
                districts.forEach(item => {
                    value += `<option value="` + item.id + `">` + item.name_dr +
                        `</option>`;
                });

                $("#edit_record_id").val($(this).attr('data-id'));
                $("#edit_name_ps").val(name_ps);
                $("#edit_name_dr").val(name_dr);
                $("#edit_name_en").val(name_en);
                $("#edit_tashkil_template_id").val(tashkil_template_id);
                $("#edit_UIC").val(UIC);
                $("#edit_province_id").removeClass('province_id');
                $("#edit_province_id").val(province_id).trigger('change');
                $("#edit_province_id").addClass('province_id');
                $("#edit_district_id").html(value);
                $("#edit_district_id").val(district_id).trigger('change');
                $('.select2').select2();
                $('#edit_modal').modal('show');
                $('.someBlock').preloader('remove');
            },
            error: function() {
                error_function("There Is Problem on Processing Your Request Please Contact Database Administrator!");
                $('.someBlock').preloader('remove');
            }
        });
    });
</script>
<!-- Inject JS -->
@if (session()->has('success_insert'))
<script>
    success("{{ session()->get('success_insert') }}")
</script>
@endif
@if (session()->has('success_update'))
<script>
    success("{{ session()->get('success_update') }}")
</script>
@endif
@endsection
@endsection