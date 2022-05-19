@extends('layouts.master')
@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">

    <!-- new/update seller modal -->
    <div class="modal fade" id="add_modal" role="dialog" data-backdrop="static" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_title">{{ __('words.Add New Seller') }}</h5>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('sellerstore') }}" id="store_form" autocomplete="off">
                        @csrf
                        <input type="hidden" value="0" id="edit_record_id" name="id">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label">{{ __('words.Seller Name') }}</label>
                                <input class="form-control" name="seller_name" id="seller_name" placeholder="{{ __('words.Write Seller Name Here...') }}" required autofocus>
                                <div class="invalid-feedback seller_name_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">{{ __('words.Seller Last Name') }}</label>
                                <input class="form-control" name="seller_last_name" id="seller_last_name" placeholder="{{ __('words.Write Seller Last Name Here...') }}">
                                <div class="invalid-feedback seller_last_name_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label">{{ __('words.Address') }}</label>
                                <input class="form-control" name="address" id="address" placeholder="{{ __('words.Write Seller Address Here...') }}">
                                <div class="invalid-feedback address_error"></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="col-form-label">{{ __('words.Contact No 1') }}</label>
                                <input type="number" class="form-control" name="contact_no" id="contact_no" placeholder="{{ __('words.Write Contact No Here...') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10" required>
                                <div class="invalid-feedback contact_no_error"></div>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="col-form-label">{{ __('words.Contact No 2') }}</label>
                                <input type="number" class="form-control" name="contact_no_2" id="contact_no_2" placeholder="{{ __('words.Write Contact No 2 Here...') }}" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                                <div class="invalid-feedback contact_no_2_error"></div>
                            </div>
                        </div>
                        <button type="submit" id="submit_btn" class="btn btn-primary mb-2 mr-2">{{ __('words.Save') }}</button>
                        <button type="button" class="btn btn-danger  mb-2 mr-2" id="close_btn">{{ __('words.Close') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 box-margin height-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h6 class="card-title">{{ __('words.Sellers List') }}</h6>
                    <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_modal">{{ __('words.New Seller') }} <span class="fa fa-plus"></span></button>
                </div>
                <div class="table-responsive">
                    <table class="table data-table">
                        <thead>
                            <tr>
                                <th>{{ __('words.ID') }}</th>
                                <th>{{ __('words.Seller Full Name') }}</th>
                                <th>{{ __('words.Contact No') }}</th>
                                <th>{{ __('words.Address') }}</th>
                                <th>{{ __('words.Action') }}</th>
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
    <script type="text/javascript">
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
                ajax: "{{ route('seller') }}",
                columns: [{
                        "data": 'seller_id'
                    },
                    {
                        "data": 'full_name'
                    },
                    {
                        "data": 'cno'
                    },
                    {
                        "data": 'address'
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
                            $("input[name=seller_name]").val('');
                            $("input[name=seller_last_name]").val('');
                            $("input[name=address]").val('');
                            $("input[name=contact_no]").val('');
                            $("input[name=contact_no_2]").val('');
                            $('.data-table').DataTable().ajax.reload();
                            if ($('#edit_record_id').val() != '0') {
                                $('#add_modal').modal('hide');
                                $('#submit_btn').html("{{ __('words.Save') }}");
                                $('#edit_record_id').val('0');
                                $('#modal_title').html("{{ __('words.Add New Seller') }}");
                                success("{{ __('words.Seller Successfully Updated!!!') }}");
                            } else {
                                success("{{ __('words.Seller Successfully Added!!!') }}");
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
                        error_function("{{ __('words.There Is A Problem Please Contact Your Administrator!') }}");
                        submit_btn = false;
                    }
                });
            }
        });

        $(document).on('click', '.edit_btn', function() {
            $('#modal_title').html("{{ __('words.Edit Seller') }}");
            $('#submit_btn').html("{{ __('words.Save Changes') }}");
            $('#edit_record_id').val($(this).attr('data-id'));
            $("input[name=seller_name]").val($(this).attr('data-name'));
            $("input[name=seller_last_name]").val($(this).attr('data-last-name'));
            $("input[name=address]").val($(this).attr('data-address'));
            $("input[name=contact_no]").val($(this).attr('data-cno'));
            $("input[name=contact_no_2]").val($(this).attr('data-cno-2'));
            $('#add_modal').modal('show');
        });

        $('#close_btn').click(function() {
            $('#add_modal').modal('hide');
            $('#submit_btn').html("{{ __('words.Save') }}");
            $('#edit_record_id').val('0');
            $("input[name=seller_name]").val('');
            $("input[name=seller_last_name]").val('');
            $("input[name=address]").val('');
            $("input[name=contact_no]").val('');
            $("input[name=contact_no_2]").val('');
            $('#modal_title').html("{{ __('words.Add New Seller') }}");
        });
    </script>
@endsection
@endsection
