@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">


<!-- new/update customer modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_title">{{__('words.Add New Customer')}}</h5>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('customerstore') }}" id="store_form" autocomplete="off">
                    @csrf
                    <input type="hidden" value="0" id="edit_record_id" name="id">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{__('words.Pharmacy Name')}}</label>
                            <input class="form-control" name="pharmacy_name" id="pharmacy_name" placeholder="{{__('words.Write Pharmacy Name Here...')}}" autofocus required>
                            <div class="invalid-feedback pharmacy_name_error"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{__('words.Customer Name')}}</label>
                            <input class="form-control" name="customer_name" id="customer_name" placeholder="{{__('words.Write Customer Name Here...')}}">
                            <div class="invalid-feedback customer_name_error"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{__('words.Customer Last Name')}}</label>
                            <input class="form-control" name="customer_last_name" id="customer_last_name" placeholder="{{__('words.Write Customer Last Name Here...')}}">
                            <div class="invalid-feedback customer_last_name_error"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{__('words.Customer Site')}}</label>
                            <select name="site_id" id="site_id" class="form-control select2" style="width: 100%;" required>
                                <option value="" selected disabled>{{__('words.Select Customer Site')}}</option>
                                @foreach($site as $site_row)
                                <option value="{{$site_row->site_id}}">{{$site_row->site_name.' '.$site_row->province_details->name_en}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback site_id_error"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{__('words.Contact No 1')}}</label>
                            <input type="number" class="form-control" name="contact_no" id="contact_no" placeholder="{{__('words.Write Contact No Here...')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                            <div class="invalid-feedback contact_no_error"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-form-label">{{__('words.Contact No 2')}}</label>
                            <input type="number" class="form-control" id="contact_no_2" name="contact_no_2" value="{{ old('contact_no_2') }}" placeholder="{{__('words.Write Contact No 2 Here...')}}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                            <div class="invalid-feedback contact_no_2_error"></div>
                        </div>
                    </div>
                    <button type="submit" id="submit_btn" class="btn btn-primary mb-2 mr-2"> {{__('words.Save')}}</button>
                    <button type="button" class="btn btn-danger  mb-2 mr-2" id="close_btn"> {{__('words.Close')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">{{__('words.Customers List')}}</h4>
                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_modal">{{__('words.New Customer')}}<span class="fa fa-plus"></span></button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped  w-100 data-table">
                    <thead>
                        <tr>
                            <th> {{__('words.ID')}}</th>
                            <th> {{__('words.Pharmacy Name')}}</th>
                            <th> {{__('words.Customer Full Name')}}</th>
                            <th> {{__('words.Contact No')}}</th>
                            <th> {{__('words.Site')}}</th>
                            <th> {{__('words.Loan')}}</th>
                            <th> {{__('words.Action')}}</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@section('script')
<!-- Inject JS -->
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>

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
            ajax: "{{ route('customer') }}",
            columns: [{
                    "data": 'customer_id'
                },
                {
                    "data": 'pharmacy_name'
                },
                {
                    "data": 'full_name'
                },
                {
                    "data": 'contact_no'
                },
                {
                    "data": 'site'
                },
                {
                    "data": 'loan'
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
                        $("input[name=pharmacy_name]").val('');
                        $("input[name=customer_name]").val('');
                        $("input[name=customer_last_name]").val('');
                        $("input[name=contact_no]").val('');
                        $("input[name=contact_no_2]").val('');
                        $("select[name=site_id]").val('').trigger('change');
                        $('.data-table').DataTable().ajax.reload();
                        if ($('#edit_record_id').val() != '0') {
                            $('#add_modal').modal('hide');
                            $('#submit_btn').html('Save');
                            $('#edit_record_id').val('0');
                            $('#modal_title').html("{{__('words.Add New Customer ')}}");
                            success("{{__('words.Customer Successfully Updated!!!')}}");
                        } else {
                            success("{{__('words.Customer Successfully Added!!!')}}");
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
                    error_function("{{__('words.There Is A Problem Please Contact Your Administrator!')}}");
                    submit_btn = false;
                }
            });
        }
    });

    $(document).on('click', '.edit_btn', function() {
        $('#modal_title').html("{{__('words.Edit Customer')}}");
        $('#submit_btn').html("{{__('words.Save Changes')}}");
        $('#edit_record_id').val($(this).attr('data-id'));
        $("input[name=pharmacy_name]").val($(this).attr('data-pharmacy-name'));
        $("input[name=customer_name]").val($(this).attr('data-name'));
        $("input[name=customer_last_name]").val($(this).attr('data-last-name'));
        $("input[name=contact_no]").val($(this).attr('data-cno'));
        $("input[name=contact_no_2]").val($(this).attr('data-cno-2'));
        $("select[name=site_id]").val($(this).attr('data-site')).trigger('change');
        $('#add_modal').modal('show');
    });

    $('#close_btn').click(function() {
        $('#add_modal').modal('hide');
        $('#submit_btn').html("{{__('words.Save')}}");
        $('#edit_record_id').val('0');
        $("input[name=pharmacy_name]").val('');
        $("input[name=customer_name]").val('');
        $("input[name=customer_last_name]").val('');
        $("input[name=contact_no]").val('');
        $("input[name=contact_no_2]").val('');
        $("select[name=site_id]").val('').trigger('change');
        $('#modal_title').html("{{__('words.Add New Customer')}}");
    });
</script>
@endsection
@endsection