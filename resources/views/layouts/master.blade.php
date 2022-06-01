<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Required meta tags -->

    <title>{{ __('words.Pharmacy MIS') }}</title>

    <!-- Favicon -->
    <link rel="icon" href="">
    <!-- Master Stylesheet CSS -->
    <link rel="stylesheet" href="{{ asset('public/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/new/sweetalert-2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/default-assets/form-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('public/dropify/dropify.min.css') }}">
    <style>
        @media print {
            .hop {
                display: none !important;
            }
        }

        th {
            text-align: center !important;
        }

        .datepicker table tr td.day:hover {
            background: #5867dd !important;
        }

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

        .odd>td,
        .even>td {
            text-align: center !important;
        }

    </style>
</head>

<body class="{{ Session::get('locale') == 'en' ? '' : 'rtl' }}">
    <!-- Preloader -->
    <div id="preloader-area">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preloader -->

    <!-- ======================================
    ******* Main Page Wrapper **********
    ======================================= -->

    <div class="main-container-wrapper">
        <!-- Top bar area -->
        <nav class="navbar col-lg-12 col-12 fixed-top d-flex hop flex-row p-0">
            <div class="navbar-brand-wrapper d-flex align-items-center justify-content-center text-center">
                <a class="navbar-brand brand-logo ml-1 text-white" style="font-family: Kaushan; color: #e77817 !important;">{{ __('words.Pharmacy MIS') }}</a>
                <a class="navbar-brand brand-logo-mini text-white" style="font-family: Kaushan; color: #e77817 !important;">{{ __('words.PMIS') }}</a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('site') }}">
                            <i class="fa fa-sitemap mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Site') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('item') }}">
                            <i class="fa fa-medkit mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Items') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('stock') }}">
                            <i class="fa fa-archive mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Stock') }}</span>
                        </a>
                    </li>
                </ul>
                <ul class="top-navbar-area navbar-nav navbar-nav-right">
                    <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <img class="flex-30-img mr-2" @if (Session::get('locale') == 'en') src="{{ asset('public/img/US.png') }}" @elseif(Session::get('locale') == 'fa' || Session::get('locale') == 'ps') src="{{ asset('public/img/AFG.png') }}" @else src="{{ asset('public/img/US.png') }}" @endif alt="">
                            @if (Session::get('locale') == 'en')
                                English
                            @elseif(Session::get('locale') == 'fa')
                                Dari
                            @elseif(Session::get('locale') == 'ps')
                                Pashto
                            @else
                                English
                            @endif
                            <i class="arrow_carrot-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <a href="{{ route('en') }}" class="dropdown-item preview-item d-flex align-items-center"><img class="language-thumb" src="{{ asset('public/img/US.png') }}" alt=""> English</a>
                            <a href="{{ route('fa') }}" class="dropdown-item preview-item d-flex align-items-center"><img class="language-thumb" src="{{ asset('public/img/AFG.png') }}" alt=""> Dari</a>
                            <a href="{{ route('ps') }}" class="dropdown-item preview-item d-flex align-items-center"><img class="language-thumb" src="{{ asset('public/img/AFG.png') }}" alt=""> Pashto</a>
                        </div>
                    </li>

                    <!-- <li class="nav-item dropdown dropdown-animate">
                        <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                            <p class="font-weight-normal dropdown-header float-left mb-0">Notifications</p>
                            <a class="dropdown-item preview-item d-flex align-items-center">
                                <div class="notification-thumbnail">
                                    <div class="preview-icon bg-primary">
                                        <i class="ti-info-alt mx-0"></i>
                                    </div>
                                </div>
                                <div class="notification-item-content">
                                    <h6>Code problem solved.</h6>
                                    <p class="mb-0">
                                        Just now
                                    </p>
                                </div>
                            </a>

                            <a class="dropdown-item preview-item d-flex align-items-center">
                                <div class="notification-thumbnail">
                                    <div class="preview-icon bg-success">
                                        <i class="ti-info-alt mx-0"></i>
                                    </div>
                                </div>
                                <div class="notification-item-content">
                                    <h6>New theme update.</h6>
                                    <p class="mb-0">
                                        02 days ago
                                    </p>
                                </div>
                            </a>

                            <a class="dropdown-item preview-item d-flex align-items-center">
                                <div class="notification-thumbnail">
                                    <div class="preview-icon bg-warning">
                                        <i class="ti-info-alt mx-0"></i>
                                    </div>
                                </div>
                                <div class="notification-item-content">
                                    <h6>Awsome support.</h6>
                                    <p class="mb-0">
                                        02 days ago
                                    </p>
                                </div>
                            </a>
                            <a class="dropdown-item preview-item d-flex align-items-center">
                                <div class="notification-thumbnail">
                                    <div class="preview-icon bg-danger">
                                        <i class="ti-info-alt mx-0"></i>
                                    </div>
                                </div>
                                <div class="notification-item-content">
                                    <h6>Text to build on the card title.</h6>
                                    <p class="mb-0">
                                        03 days ago
                                    </p>
                                </div>
                            </a>

                        </div>
                    </li> -->

                    <li class="nav-item nav-profile dropdown dropdown-animate">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                            @if (Auth::user()->photo != '')
                                <img src="{{ asset('storage/app/public/images') . '/' . Auth::user()->photo }}" alt="profile" />
                            @else
                                <img src="{{ asset('public/img/user_default.jpg') }}" alt="profile" />
                            @endif
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown profile-top" aria-labelledby="profileDropdown">
                            <a href="#" class="dropdown-item"> Welcome, <b>{{ Auth::user()->name }}</b></a>
                            <a href="#" class="dropdown-item" data-toggle="modal" data-target="#settings-modal"><i class="zmdi zmdi-brightness-7 profile-icon" aria-hidden="true"></i> {{ __('words.Settings') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <i class="ti-unlink profile-icon" aria-hidden="true"></i> {{ __('words.Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-xl-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="ti-layout-grid2"></span>
                </button>
            </div>
        </nav>

        <div class="container-fluid page-body-wrapper">
            <!-- Side Menu area -->
            <nav class="sidebar sidebar-offcanvas hop" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="fa fa-tachometer mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Dashboard') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('supplier') }}">
                            <i class="fa fa-user mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Suppliers') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('customer') }}">
                            <i class="fa fa-user-md mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Customers') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('order-list') }}">
                            <i class="fa fa-calendar mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Order') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('purchase-list') }}">
                            <i class="fa fa-shopping-cart mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Purchase') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('seller') }}">
                            <i class="fa fa-users mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Sellers') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('transfer-list') }}">
                            <i class="fa fa-arrows mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Transfer') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('sale') }}">
                            <i class="fa fa-usd mr-2 font-17 ml-2"></i>
                            <span class="menu-title">{{ __('words.Sale') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('journal') }}">
                            <i class="fa fa-th-list mr-2 font-17 ml-2"></i>

                            <span class="menu-title">{{ __('words.Journal') }}</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="container-fluid p-0">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="settings-modal" data-backdrop="static" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_title">{{ __('words.Settings') }}</h5>
                </div>
                <div class="modal-body">
                    <form id="store_form" method="POST" action="{{ route('settings.update') }}" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-md-12 p-0">
                            <label for="full_name" class="col-form-label">{{ __('words.Full Name') }}</label>
                            <input class="form-control" name="full_name" id="full_name" required value="{{ Auth::user()->name }}">
                            <div class="invalid-feedback full_name_error"></div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="old_password" class="col-form-label">{{ __('words.Old Password') }}</label>
                                <input type="password" class="form-control" name="old_password" id="old_password" placeholder="{{ __('words.Write Old Password Here...') }}">
                                <div class="invalid-feedback old_password_error"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="new_password" class="col-form-label">{{ __('words.New Password') }}</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="{{ __('words.Write New Password Here...') }}">
                                <div class="invalid-feedback new_password_error"></div>
                            </div>
                        </div>
                        <div class="form-group col-md-12 p-0">
                            <label for="confirm_password" class="col-form-label">{{ __('words.Confirm Password') }}</label>
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="{{ __('words.Write Confirm Password Here...') }}">
                            <div class="invalid-feedback confirm_password_error"></div>
                        </div>
                        <div class="col-12 p-0 mb-3">
                            <div id="file-upload0" class="section">
                                <div class="row section">
                                    <div class="col s12 m8 l9">
                                        <label for="basicInputFile">{{ __('words.Attach Photo') }}</label>
                                        <input type="file" name="photo" class="dropify" data-max-file-size="5M" data-height="100" data-allowed-file-extensions="JPG jpg PNG png JPEG jpeg" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="submit_btn" class="btn btn-primary"> {{ __('words.Save') }}</button>
                        <button type="button" class="btn btn-danger" id="close_btn" data-dismiss="modal"> {{ __('words.Close') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Plugins Js -->
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/bundle.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/fullscreen.js') }}"></script>

    <!-- Active JS -->
    <script src="{{ asset('public/js/canvas.js') }}"></script>
    <script src="{{ asset('public/js/collapse.js') }}"></script>
    <script src="{{ asset('public/js/settings.js') }}"></script>
    <script src="{{ asset('public/js/template.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/active.js') }}"></script>
    <script src="{{ asset('public/js/default-assets/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('public/dropify/dropify.min.js') }}"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here or click',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });

        function success(msg) {
            Swal.fire({
                title: msg,
                text: "",
                type: "success",
            })
        }

        function error_function(msg) {
            Swal.fire({
                title: msg,
                text: "",
                type: "error",
            })
        }
    </script>
    <!-- Inject JS -->
    @yield('script')

</body>

</html>
