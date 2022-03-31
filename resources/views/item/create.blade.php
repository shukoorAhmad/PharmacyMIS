@extends('layouts.master')

@section('content')
    <div class="col-12 box-margin height-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h4 class="card-title">New Item</h4>
                    <div class="mb-3">
                        <a class="btn btn-primary" id="add_items"><i class="zmdi zmdi-plus text-white font-weight-bolder"></i></a>
                        <a href="{{ route('item-list') }}" class="btn btn-success">Item List</a>
                    </div>
                </div>
                <form method="POST" action="{{ route('itemstore') }}">
                    @csrf
                    <div class="row">
                        <div class='col-md-4'><label>Item Name</label><input name='item_name[]' class='form-control'
                                required></div>
                        <div class='col-md-2'><label>Measure</label><select class='form-control select2' name='measure_id[]'
                                required>
                                <option selected disabled>Select Measure Unit</option>
                                @foreach ($measure as $m)
                                    <option value="{{ $m->measure_unit_id }}">{{ $m->unit }}</option>
                                @endforeach
                            </select></div>
                        <div class='col-md-2'><label>Dose</label><input name='dose[]' required class='form-control'>
                        </div>
                        <div class='col-md-2'><label>Quantity Per Carton</label>
                            <input name='qty_per_carton[]' required class='form-control'>
                        </div>
                        <div class="form-group col-md-2" style="margin-top: 34px;">
                        </div>
                        <div class="col-md-12" id="showItems">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 ml-3 mt-3" id="submit_btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@section('script')
    <script>
        $(document).on('click', '.close_btn', function() {
            $(this).closest($('.show_items')).remove();
        });

        $('#add_items').click(function() {
            $.get("{{ route('showItemField') }}", function(response) {
                $('#showItems').append(response);
            });
        });
    </script>
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
