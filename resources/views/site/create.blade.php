@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="{{asset('public/css/default-assets/datatables.bootstrap4.css')}}">
<link rel="stylesheet" href="{{asset('public/css/default-assets/responsive.bootstrap4.css')}}">
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
            <h4 class="card-title">New Site</h4>
            <form method="POST" action="{{route('sitestore')}}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Site</label>
                        <input class="form-control  @error('site_name') is-invalid @enderror" name="site_name" value="{{old('site_name')}}" placeholder="Write Your Site Here..." autofocus required>
                        @error('site_name')
                        <span class="invalid-feedback" role="alert">
                            <strong> {{$message}} </strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label">Province</label>
                        <select name="province" class="form-control select2 @error('province') is-invalid @enderror" required>
                            <option value="" selected disabled>Please Select Province</option>
                            @foreach($province as $pro)
                            <option value="{{$pro->province_id}}" {{old('province')==$pro->province_id?'selected':''}}>{{$pro->en_province}}</option>
                            @endforeach
                        </select>
                        @error('province')
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
<div class="col-12 box-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-2">Site List</h4>
            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Site Name</th>
                        <th>Province</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($site as $s)
                    <tr>
                        <th>{{$s->site_id}}</th>
                        <td>{{$s->site_name}}</td>
                        <td>{{$s->prov_id->en_province}}</td>
                        <th><a href="{{route('editsite', $s->site_id)}}"><i class="zmdi zmdi-edit btn btn-info btn-circle"></i></a></th>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->

@section('script')
<script src="{{ asset('public/js/default-assets/select2.min.js')}}"></script>
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js')}}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js')}}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js')}}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js')}}"></script>
<script src="{{ asset('public/js/default-assets/demo.datatable-init.js')}}"></script>
<!-- Inject JS -->
@if(session()->has('success_insert'))
<script>
    success("{{session()->get('success_insert')}}")
</script>
@endif

<script>
    $('.select2').select2();
</script>
@endsection
@endsection