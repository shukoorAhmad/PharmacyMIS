@extends('layouts.master')

@section('content')
    <div class="col-12 box-margin">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title mb-2">Order List</h4>
                    <a href="{{route('order')}}" class="btn btn-success mb-3">New Order</a>
                </div>
                <table class="table data-table w-100">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item Name</th>
                            <th>Measure Unit</th>
                            <th>Quantity Per Carton</th>
                            <th>Supplier</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot></tfoot>
                </table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
@section('script')
    
@endsection
@endsection
