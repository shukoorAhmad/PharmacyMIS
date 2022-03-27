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
            <h4 class="card-title">New Supplier</h4>
            <form method="POST" action="{{route('supplierstore')}}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label class="col-form-label">Supplier Name</label>
                        <select name="" id="" class="form-control select2">

                        </select>
                        @error('supplier_name')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{$message}} </strong>
                        </span>
                        @enderror
                    </div>

                </div>
                <button type="submit" class="btn btn-primary mb-2 mr-2">Save</button>
            </form>
        </div>
    </div>

</div>


@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js')}}"></script>
<script>
    $('.select2').select2();
</script>
@if(session()->has('success_insert'))
<script>
    success("{{session()->get('success_insert')}}")
</script>
@endif


@endsection
@endsection