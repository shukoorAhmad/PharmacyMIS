@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">

<!-- new/update item modal -->
<div class="modal fade" id="add_modal" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modal_title">{{__('words.Add New Item')}}</h5>
            </div>
            <div class="modal-body">
                <form id="store_form" method="POST" action="{{ route('itemstore') }}" autocomplete="off">
                    @csrf
                    <input type="hidden" value="0" name="id" id="edit_record_id">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="item_name" class="col-form-label">{{__('words.Item Name')}}</label>
                            <input class="form-control" name="item_name" required id="item_name" placeholder="{{__('words.Write Item Name Here...')}}">
                            <div class="invalid-feedback item_name_error"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="item_unit" class="col-form-label">{{__('words.Item Unit')}}</label>
                            <input class="form-control" name="item_unit" id="item_unit" placeholder="{{__('words.Write Item Unit Here...')}}">
                            <div class="invalid-feedback item_unit_error"></div>
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label w-100">{{__('words.Item Type')}}</label>
                            <select name="item_type" class="form-control select2" id="item_type" style="width: 100%;" required>
                                <option value="" selected disabled>{{__('words.Select Item Type')}}</option>
                                @foreach($type as $typ)
                                <option value="{{$typ->id}}">{{$typ->type}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback item_type_error"></div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="col-form-label w-100">{{__('words.Unit')}}</label>
                            <select name="measure_unit_id" class="form-control select2" id="measure_unit_id" style="width: 100%;" required>
                                <option value="" selected disabled>{{__('words.Select Item Unit')}}</option>
                                @foreach($measure as $m)
                                <option value="{{$m->measure_unit_id}}">{{$m->unit}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback measure_unit_id_error"></div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="quantity_per_carton" class="col-form-label">{{__('words.Quantity Per Carton')}}</label>
                            <input class="form-control" name="quantity_per_carton" required id="quantity_per_carton" placeholder="{{__('words.Write Quantity Per Carton Here...')}}">
                            <div class="invalid-feedback quantity_per_carton_error"></div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="purchase_price" class="col-form-label">{{__('words.Purchase Price')}}</label>
                            <input class="form-control" name="purchase_price" required id="purchase_price" placeholder="{{__('words.Write Purchase Price Here...')}}">
                            <div class="invalid-feedback purchase_price_error"></div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="sale_price" class="col-form-label">{{__('words.Sale Price')}}</label>
                            <input class="form-control" name="sale_price" required id="sale_price" placeholder="{{__('words.Write Sale Price Here...')}}">
                            <div class="invalid-feedback sale_price_error"></div>
                        </div>
                    </div>
                    <button type="submit" id="submit_btn" class="btn btn-primary"> {{__('words.Save')}}</button>
                    <button type="button" class="btn btn-danger" id="close_btn"> {{__('words.Close')}}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h6 class="card-title"> {{__('words.Item List')}}</h6>
                <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#add_modal"> {{__('words.New Item')}}<span class="fa fa-plus"></span></button>
            </div>
            <div class="table-responsive">
                <table class="table data-table table-striped w-100">
                    <thead>
                        <tr>
                            <th> {{__('words.ID')}}</th>
                            <th> {{__('words.Item Name')}}</th>
                            <th> {{__('words.Measure Unit')}}</th>
                            <th> {{__('words.Quantity Per Carton')}}</th>
                            <th> {{__('words.Purchase Price')}}</th>
                            <th> {{__('words.Sale Price')}}</th>
                            <th> {{__('words.Action')}}</th>
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
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>


<!-- Inject JS -->
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
            ajax: "{{ route('item') }}",
            columns: [{
                    "data": 'item_id'
                },
                {
                    "data": 'it_name'
                },
                {
                    "data": 'measure_name'
                },
                {
                    "data": 'quantity_per_carton'
                },
                {
                    "data": 'purchase_price'
                },
                {
                    "data": 'sale_price'
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
                        $("input[name=item_name]").val('');
                        $("input[name=item_unit]").val('');
                        $("select[name=item_type]").val('').trigger('change');
                        $("select[name=measure_unit_id]").val('').trigger('change');
                        $("input[name=quantity_per_carton]").val('');
                        $("input[name=purchase_price]").val('');
                        $("input[name=sale_price]").val('');
                        $('.data-table').DataTable().ajax.reload();
                        if ($('#edit_record_id').val() != '0') {
                            $('#add_modal').modal('hide');
                            $('#submit_btn').html("{{__('words.Save')}}");
                            $('#edit_record_id').val('0');
                            $('#modal_title').html(" {{__('words.Add New Item')}}");
                            success("{{__('words.Item Successfully Updated!!!')}}");
                        } else {
                            success("{{__('words.Item Successfully Added!!!')}}");
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
        $('#modal_title').html("{{__('words.Edit Item')}}");
        $('#submit_btn').html("{{__('words.Save Changes')}}");
        $('#edit_record_id').val($(this).attr('data-id'));
        $("input[name=item_name]").val($(this).attr('data-name'));
        $("input[name=item_unit]").val($(this).attr('data-unit'));
        $("select[name=item_type]").val($(this).attr('data-type')).trigger('change');
        $("select[name=measure_unit_id]").val($(this).attr('data-measure')).trigger('change');
        $("input[name=quantity_per_carton]").val($(this).attr('data-qty'));
        $("input[name=purchase_price]").val($(this).attr('data-purchase'));
        $("input[name=sale_price]").val($(this).attr('data-sale'));
        $('#add_modal').modal('show');
    });

    $('#close_btn').click(function() {
        $('#add_modal').modal("hide");
        $('#submit_btn').html("{{__('words.Save')}}");
        $('#edit_record_id').val('0');
        $("input[name=item_name]").val('');
        $("input[name=item_unit]").val('');
        $("select[name=item_type]").val('').trigger('change');
        $("select[name=measure_unit_id]").val('').trigger('change');
        $("input[name=quantity_per_carton]").val('');
        $("input[name=purchase_price]").val('');
        $("input[name=sale_price]").val('');
        $('#modal_title').html("{{__('words.Add New Item')}}");
    });
</script>
@endsection
@endsection