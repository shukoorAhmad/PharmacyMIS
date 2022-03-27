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
            <h4 class="card-title">New Customer</h4>
            <form method="POST" action="{{ route('customer-store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-4">
                        <label class="col-form-label">Pharmacy Name</label>
                        <input class="form-control  @error('pharmacy_name') is-invalid @enderror" name="pharmacy_name" value="{{ old('pharmacy_name') }}" placeholder="Write Pharmacy Name Here..." autofocus required>
                        @error('pharmacy_name')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label">Customer Name</label>
                        <input class="form-control  @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ old('customer_name') }}" placeholder="Write Customer Name Here...">
                        @error('customer_name')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label">Customer Last Name</label>
                        <input class="form-control  @error('customer_last_name') is-invalid @enderror" name="customer_last_name" value="{{ old('customer_last_name') }}" placeholder="Write Customer Last Name Here...">
                        @error('customer_last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label">Customer Site</label>
                        <select name="site_id" class="form-control select2" required>
                            <option value="" selected disabled>Select Customer Site</option>
                            @foreach($site as $site_row)
                            <option value="{{$site_row->site_id}}">{{$site_row->site_name.' '.$site_row->prov_id->en_province}}</option>
                            @endforeach
                        </select>
                        @error('site_id')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label">Contact No 1</label>
                        <input type="number" class="form-control  @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" placeholder="Write Contact No Here..." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                        @error('contact_no')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <label class="col-form-label">Contact No 2</label>
                        <input type="number" class="form-control  @error('contact_no_2') is-invalid @enderror" name="contact_no_2" value="{{ old('contact_no_2') }}" placeholder="Write Contact No 2 Here..." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                        @error('contact_no_2')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
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
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>

<!-- Inject JS -->
@if (session()->has('success_insert'))
<script>
    success("{{ session()->get('success_insert') }}")
</script>
@endif
<script>
    $('.select2').select2();
</script>
@endsection
@endsection