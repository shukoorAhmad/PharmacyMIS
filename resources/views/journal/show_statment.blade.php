@extends('layouts.master')

@section('content')
    <div class="col-12 box-margin height-card">
        <div class="card">
            <h5 class="card-title mt-3 ml-4">{{ $title }} Statment</h5>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>No</th>
                        <th>AFG</th>
                        <th>USD</th>
                        <th>KAL</th>
                    </tr>
                    @php
                        $total_afg = 0;
                        $total_usd = 0;
                        $total_kal = 0;
                    @endphp
                    @foreach ($data as $row)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>
                                {!! $row->in_out == 1 ? '<p class="float-left">-</p><p class="float-right">' . $row->afg . '</p>' : '<p class="float-right">-</p><p class="float-left">' . $row->afg . '</p>' !!}
                            </td>
                            <td>
                                {!! $row->in_out == 1 ? '<p class="float-left">-</p><p class="float-right">' . $row->usd . '</p>' : '<p class="float-right">-</p><p class="float-left">' . $row->usd . '</p>' !!}
                            </td>
                            <td>
                                {!! $row->in_out == 1 ? '<p class="float-left">-</p><p class="float-right">' . $row->kal . '</p>' : '<p class="float-right">-</p><p class="float-left">' . $row->kal . '</p>' !!}
                            </td>
                        </tr>
                        @php
                            $row->in_out == 1 ? ($total_afg += $row->afg) : ($total_afg -= $row->afg);
                            $row->in_out == 1 ? ($total_usd += $row->usd) : ($total_usd -= $row->usd);
                            $row->in_out == 1 ? ($total_kal += $row->kal) : ($total_kal -= $row->kal);
                        @endphp
                    @endforeach
                    <tr>
                        <th><b>N/A</b></th>
                        <th><b>Total AFG</b> - {{ $total_afg }}</th>
                        <th><b>Total USD</b> - {{ $total_usd }}</th>
                        <th><b>Total KAL</b> - {{ $total_kal }}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
