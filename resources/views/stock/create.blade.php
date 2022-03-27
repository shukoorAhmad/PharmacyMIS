@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">

<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">New Stock</h4>
            <form method="POST" action="{{ route('stockstore') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Stock Name</label>
                        <input class="form-control  @error('stock_name') is-invalid @enderror" name="stock_name" value="{{ old('stock_name') }}" placeholder="Write Your Stock Here..." autofocus required>
                        @error('stock_name')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Stock Address</label>
                        <input class="form-control  @error('stock_address') is-invalid @enderror" name="stock_address" value="{{ old('stock_address') }}" placeholder="Write Your Stock Address Here..." autofocus required>
                        @error('stock_address')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Incharge Name</label>
                        <input class="form-control  @error('incharge_name') is-invalid @enderror" name="incharge_name" value="{{ old('incharge_name') }}" placeholder="Write Your Incharge Here..." required>
                        @error('incharge_name')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{ $message }} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Contact No</label>
                        <input type="number" class="form-control  @error('contact_no') is-invalid @enderror" name="contact_no" value="{{ old('contact_no') }}" placeholder="Write Your Stock Here..." required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="10">
                        @error('contact_no')
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

<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-2">Stock List</h4>
            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Stock Name</th>
                        <th>Stock Address</th>
                        <th>Incharge Name</th>
                        <th>Contact No</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stocks as $key => $stock)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $stock->stock_name }}</td>
                        <td>{{ $stock->stock_address }}</td>
                        <td>{{ $stock->incharge }}</td>
                        <td>{{ $stock->contact_no }}</td>
                        <th>
                            <a data-id="{{ $stock->stock_id }}" class="edit"><i class="zmdi zmdi-edit btn btn-info btn-circle"></i>
                            </a>
                        </th>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="showEditModal"></div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->

@section('script')
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/demo.datatable-init.js') }}"></script>

<script>
    $('.edit').click(function() {
        $.get("{{ route('editstock') }}/" + $(this).attr('data-id'), function(data) {
            $('#showEditModal').html(data);
            $('#editModal').modal('show');
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