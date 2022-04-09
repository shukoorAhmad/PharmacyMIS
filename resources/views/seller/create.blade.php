@extends('layouts.master')

@section('content')
<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <h4 class="card-title">New Seller</h4>
                <a href="{{route('seller-list')}}" class="btn btn-success mb-3">Sellers List</a>
            </div>
            <form method="POST" action="{{ route('seller-store') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Seller Name</label>
                        <input class="form-control  @error('seller_name') is-invalid @enderror" name="seller_name" value="{{ old('seller_name') }}" placeholder="Write Seller Name Here..." required>
                        @error('seller_name')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Seller Last Name</label>
                        <input class="form-control  @error('seller_last_name') is-invalid @enderror" name="seller_last_name" value="{{ old('seller_last_name') }}" placeholder="Write Seller Last Name Here...">
                        @error('seller_last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Address</label>
                        <input class="form-control  @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Write Seller Address Here...">
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
                        <label class="col-form-label">Contact No 1</label>
                        <input type="number" class="form-control  @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" placeholder="Write Contact No Here..." oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10" required>
                        @error('contact_no')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-3">
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
<!-- Inject JS -->
@if (session()->has('success_insert'))
<script>
    success("{{ session()->get('success_insert') }}")
</script>
@endif
@endsection
@endsection