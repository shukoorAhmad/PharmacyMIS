@extends('layouts.master')

@section('content')
<link rel="stylesheet" href="{{ asset('public/css/default-assets/datatables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/responsive.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/default-assets/select2.min.css') }}">
<link rel="stylesheet" href="{{asset('public/radio-button/index.css')}}">

<div class="col-12 box-margin height-card">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs nav-bordered nav-justified">
                <li class="nav-item">
                    <a href="#cash-tab" data-toggle="tab" aria-expanded="false" class="nav-link active">
                        Cash
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#expense-tab" data-toggle="tab" aria-expanded="true" class="nav-link">
                        Expense
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#messages-b2" data-toggle="tab" aria-expanded="false" class="nav-link">
                        Messages
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="cash-tab">
                    <form action="{{route('cash-store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-2">
                                <label for="">USD</label>
                                <input name="usd" class="form-control inputNumeral check usd" value="0">
                                <label class="text-danger usd_error"></label>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">AFG</label>
                                <input name="afg" class="form-control inputNumeral check afg" value="0">
                                <div class="text-danger afg_error"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">KAL</label>
                                <input name="kal" class="form-control inputNumeral check kal" value="0">
                                <div class="text-danger kal_error"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">USD to AFG</label>
                                <input id="" name="usd_afg" class="form-control inputNumeral" value="{{$exchange_rate->usd_afg}}">
                                <input type="hidden" name="exchange_rate_id" class="form-control inputNumeral" value="{{$exchange_rate->exchange_rate_id}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">USD to Kal</label>
                                <input id="" name="usd_kal" class="form-control inputNumeral" value="{{$exchange_rate->usd_kal}}">
                            </div>
                            <div class="col-md-2" style="margin-top: 30px !important;">
                                <div id="div1" class="selectGroup">
                                </div>
                                <input type="hidden" name="in_out" class="radio-value" value="0">
                            </div>
                            <div class="form-group col-md-10">
                                <label>Comment</label>
                                <input name="comment" class="form-control" placeholder="Write your comments here...">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mr-2 w-100 submit" style="margin-top:28px !important;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="expense-tab">
                    <form action="{{route('expense-store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="">USD</label>
                                        <input name="usd" class="form-control inputNumeral check usd" value="0">
                                        <label class="text-danger usd_error"></label>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">AFG</label>
                                        <input name="afg" class="form-control inputNumeral check afg" value="0">
                                        <div class="text-danger afg_error"></div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="">KAL</label>
                                        <input name="kal" class="form-control inputNumeral check kal" value="0">
                                        <div class="text-danger kal_error"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">USD to AFG</label>
                                <input name="usd_afg" class="form-control inputNumeral" value="{{$exchange_rate->usd_afg}}">
                                <input type="hidden" name="exchange_rate_id" class="form-control inputNumeral" value="{{$exchange_rate->exchange_rate_id}}">
                            </div>
                            <div class="form-group col-md-2">
                                <label for="">USD to Kal</label>
                                <input name="usd_kal" class="form-control inputNumeral" value="{{$exchange_rate->usd_kal}}">
                            </div>
                            <input type="hidden" name="in_out" class="expense-radio-value" value="1">
                            <div class="form-group col-md-10">
                                <label>Comment</label>
                                <input name="comment" class="form-control" placeholder="Write your comments here...">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary mr-2 w-100 submit" style="margin-top:28px !important;">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="messages-b2">
                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.</p>
                    <p class="mb-0">Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<!-- Inject JS -->
<script src="{{ asset('public/js/default-assets/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatables.bootstrap4.js') }}"></script>
<script src="{{ asset('public/js/default-assets/datatable-responsive.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/js/default-assets/select2.min.js') }}"></script>
<script src="{{ asset('public/radio-button/toggle.js') }}"></script>
<script src="{{asset('public/js/default-assets/cleave.min.js')}}"></script>
@if(session()->has('success_insert'))
<script>
    success("{{session()->get('success_insert')}}");
</script>
@endif
@if(session()->has('error_transaction'))
<script>
    error_function("{{session()->get('error_transaction')}}");
</script>
@endif
<script>
    $(document).on('keyup', '.check', function() {
        if ($('.radio-value').val() == 1 || $('.expense-radio-value').val() == 1) {
            var name = $(this).attr('name');
            $.get("{{route('check-money')}}/" + $(this).val() + "/" + name, function(response) {
                if (response != 1) {
                    $('.' + name + '_error').html('You Have ' + response + ' ' + name);
                    $('.' + name).css('border-color', '#dc3545');
                    $('.submit').attr('disabled', 'disabled');
                } else {
                    $('.' + name).css('border-color', '#5867dd');
                    $('.' + name + '_error').html('');
                    $('.' + name + '_error').focus();
                    $('.submit').removeAttr('disabled');
                }
            });
        }
    });

    $(document).on('click', '.submit', function() {
        if ($('#usd').val() == 0 && $('#afg').val() == 0 && $('#kal').val() == 0) {
            error_function('please enter value');
            return false;
        } else {
            return true;
        }
    });
    $("#div1").setupToggles();
    $(document).on('click', '.zero', function() {
        if ($(this).attr('value') == '0') {
            $('.radio-value').val(0);
        } else {
            $('.radio-value').val(1);
        }
    });
    $('.inputNumeral').toArray().forEach(function(field) {
        new Cleave(field, {
            numeral: !0,
            numeralThousandsGroupStyle: "false"
        });
    });
</script>
@endsection
@endsection