@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/new/sweetalert-2.min.css') }}">
    <div class="col-12 box-margin height-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">Form Grid</h6>
                <form>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">First Name</label>
                                <input type="text" class="form-control" placeholder="Enter first name">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Last Name</label>
                                <input type="text" class="form-control" placeholder="Enter last name">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleSelect1">Example select</label>
                                <select class="form-control rounded-0 select2">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">City</label>
                                <input type="text" class="form-control" placeholder="Enter city">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">State</label>
                                <input type="text" class="form-control" placeholder="Enter state">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label">Zip</label>
                                <input type="text" class="form-control" placeholder="Enter zip code">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Email address</label>
                                <input type="email" class="form-control" placeholder="Enter email">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input type="password" class="form-control" autocomplete="off" placeholder="Password">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->
                </form>
                <button type="button" class="btn btn-primary submit">Submit form</button>
                <button type="button" class="btn btn-primary" id="sa-params">Click me</button>
            </div>
        </div>
    </div>

@section('script')
    <script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
    <!-- Inject JS -->
    <script src="{{ asset('public/js/default-assets/sweetalert2.min.js') }}"></script>
    <script>
        $("#sa-params").click(function() {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ml-2 mt-2",
                buttonsStyling: !1,
            }).then(function(t) {
                t.value ?
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        type: "success",
                    }) :
                    t.dismiss === Swal.DismissReason.cancel &&
                    Swal.fire({
                        title: "Cancelled",
                        text: "Your imaginary file is safe :)",
                        type: "error",
                    });
            });
        });
    </script>
    <script>
        $('.select2').select2();
    </script>
@endsection
@endsection
