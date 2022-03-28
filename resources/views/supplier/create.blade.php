@extends('layouts.master')

@section('content')

    <link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
    <style>
        .odd>td, .even>td{
            text-align: center !important;
        }
    </style>
    
    <div class="col-12 box-margin height-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">New Supplier</h4>
                <form method="POST" action="{{ route('supplierstore') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Supplier Name</label>
                            <input class="form-control  @error('supplier_name') is-invalid @enderror" name="supplier_name"
                                value="{{ old('supplier_name') }}" placeholder="Write Supplier Name Here..." autofocus
                                required>
                            @error('supplier_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{ $message }} </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Supplier Email</label>
                            <input class="form-control  @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Write Supplier Email Here...">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong> {{ $message }} </strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-form-label">Supplier Contact No</label>
                            <input class="form-control  @error('contact_no') is-invalid @enderror" name="contact_no"
                                value="{{ old('contact_no') }}" placeholder="Write Contact No Here...">
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
                <h4 class="card-title mb-2">Supplier List</h4>
                <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Supplier Name</th>
                            <th>Supplier Email</th>
                            <th>Supplier Contact No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($supplier as $key => $s)
                            <tr>
                                <th>{{ $key + 1 }}</th>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->email }}</td>
                                <td>{{ $s->contact_no }}</td>
                                <th><a data-id="{{ $s->supplier_id }}" class="edit"><i
                                            class="zmdi zmdi-edit btn btn-info btn-circle"></i></a></th>
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
            $.get("{{ route('supplieredit') }}/" + $(this).attr('data-id'), function(data) {
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
