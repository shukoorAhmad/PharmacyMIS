@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">
    <style>
        .select2-container{
            width: 100% !important;
        }
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
    </style>
    <div class="col-12 box-margin height-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">New Sale</h4>
                    <a href="{{ route('seller-list') }}" class="btn btn-success mb-3">Sales List</a>
                </div>
                <form method="POST" action="{{ route('seller-store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label>Select Sale Type</label>
                            <select name="sale_type" id="sale_type" class="form-control select2" required>
                                <option value="" selected disabled>Select Sale Type</option>
                                <option value="1">Customer</option>
                                <option value="2">Seller</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label id="show-label-name">Select</label>
                            <select name="customer_id" id="customer_id" class="form-control select2" required>
                                <option value="" selected disabled>Select Sale Type</option>
                            </select>
                        </div>
                        <div class="col-md-4 visibility-hidden" id="percentage">
                            <label>Seller Percentage</label>
                            <select name="percentage" class="form-control select2" required>
                                <option value="" selected disabled>Select Percentage</option>
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}">{{ str_pad($i, 2, 0, STR_PAD_LEFT) }}%</option>
                                @endfor
                            </select>
                        </div>
                        <hr style="height: 1px !important;width:100% !important;border-top: 1px solid rgba(0,0,0,.1);">
                        <div class="col-md-4">
                            <label>Select Item</label>
                            <select name="item[]" class="form-control select2" required>
                                <option value="" selected disabled>Select Item</option>
                                @foreach ($items as $item)
                                    <option value="{{$item->item_details->item_id}}">{{$item->item_details->item_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Available To Stock</label>
                            <input class="form-control" value="" placeholder="Available To Stock">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Quantity</label>
                            <input class="form-control" placeholder="Quantity" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Sale Price</label>
                            <input class="form-control" placeholder="Sale Price" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Stock</label>
                            <input class="form-control" placeholder="Stock" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


@section('script')
    <script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
    <script>
        $('body').addClass('sidebar-icon-only');
        $('#sale_type').change(function() {
            $('#sale_type').val() == 1 ? $('#show-label-name').html('Select Customer') : $('#show-label-name').html(
                'Select Seller');
            $('#sale_type').val() == 1 ? $('#percentage').addClass('visibility-hidden') : $('#percentage')
                .removeClass('visibility-hidden');
            $.get("{{ route('show-customer') }}/" + $('#sale_type').val(), function(response) {
                $('#customer_id').empty();
                $('#customer_id').append(response);
            });
        });
        $('.select2').select2();
    </script>
    <!-- Inject JS -->
    @if (session()->has('success_insert'))
        <script>
            success("{{ session()->get('success_insert') }}")
        </script>
    @endif
@endsection
@endsection
