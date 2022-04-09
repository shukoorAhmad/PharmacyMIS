@extends('layouts.master')

@section('content')
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
</style>
<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">New Transfer</h4>
                <a href="{{route('transfer-list')}}" class="btn btn-success mb-3">Transfers List</a>
            </div>
            <form method="POST" action="{{ route('transfer-store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        <label class="col-form-label">From Stock</label>
                        <select name="source_stock_id" id="source_stock_id" class="form-control select2" required>
                            <option value="" selected disabled>Select From stock</option>
                            @foreach($src_stock as $s_stk)
                            <option value="{{$s_stk->stock_id}}">{{$s_stk->stock_name}}</option>
                            @endforeach
                        </select>
                        @error('source_stock_id')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label">To Stock</label>
                        <select name="destination_stock_id" id="destination_stock_id" class="form-control select2" required>
                            <option value="" selected disabled>Select Destination stock</option>
                        </select>
                        @error('destination_stock_id')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-2">
                        <label class="col-form-label">Transfer Date</label>
                        <input type="date" class="form-control  @error('transfer_date') is-invalid @enderror" name="transfer_date" value="<?php echo date('Y-m-d'); ?>">
                        @error('transfer_date')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label">Comment</label>
                        <input class="form-control  @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" placeholder="Write comments Here if you have...">
                        @error('comment')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div id="show-items">

                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script>
    $('.select2').select2();

    $('#source_stock_id').change(function() {
        $.get("{{route('show-dest-stock')}}/" + $('#source_stock_id').val(), function(response) {
            $('#destination_stock_id').empty();
            $('#destination_stock_id').append(response);
            // console.log(response);
        });
        $.get("{{route('show-stock-items')}}/" + $('#source_stock_id').val(), function(response) {
            $('#show-items').empty();
            $('#show-items').append(response);
        });
    });
</script>
<!-- Inject JS -->
@if (session()->has('success_insert'))
<script>
    success("{{ session()->get('success_insert') }}")
</script>
@endif
@endsection
@endsection