<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ __('words.Pharmacy MIS') }}</title>
    <link rel="stylesheet" href="{{ asset('public/loginMaterials/css/style.css') }}">

</head>

<body class="login-area" style="background-image:url({{ asset('public/loginMaterials/bg/capsule.jpg') }});background-size:cover;">

    <!-- Preloader -->
    <div id="preloader-area">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- Preloader -->
    <div class="main-content- h-100vh">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="hero">
                    <div class="cube"></div>
                    <div class="cube"></div>
                    <div class="cube"></div>
                    <div class="cube"></div>
                    <div class="cube"></div>
                    <div class="cube"></div>
                </div>
                <div class="col-sm-10 col-md-8 col-lg-5">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <style>
                            span {
                                font-size: 14px !important;
                                color: white !important;
                                font-weight: bolder !important;
                            }

                        </style>
                        <div class="card" style="background-color: #88aacc !important;">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-around;border-bottom: 2px solid #a1a1a1;margin-bottom: 0.7rem; padding-bottom: 0.2rem;">
                                    <a href="{{ route('ps') }}" class="connection-item">
                                        <img src="{{ asset('public/img/AFG.png') }}" alt="" style="width: 2rem;">
                                        <br>
                                        <span class="block">پشتو</span>
                                    </a>
                                    <a href="{{ route('en') }}" class="connection-item">
                                        <center><img src="{{ asset('public/img/US.png') }}" alt="" style="width: 2rem;"></center>
                                        <span class="block">English</span>
                                    </a>
                                    <a href="{{ route('fa') }}" class="connection-item">
                                        <img src="{{ asset('public/img/AFG.png') }}" alt="" style="width: 2rem;">
                                        <br>
                                        <span class="block text-center">دری</span>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <!-- Logo -->
                                <h4 class="font-24 mb-30 text-white text-center">{{ __('words.Login Panel') }}</h4>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input id="email" type="email" class="form-control login @error('email') is-invalid @enderror" name="email" placeholder="{{ __('words.Enter Your Email Here') }}" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $message }} </strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input id="password" type="password" class="form-control login @error('password') is-invalid @enderror" placeholder="{{ __('words.Enter Your Password Here') }}" name="password" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary btn-block" type="submit"> {{ __('words.Log In') }} </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/loginMaterials/js/jquery.min.js') }}"></script>
    <script src="{{ asset('public/loginMaterials/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/loginMaterials/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/loginMaterials/js/bundle.js') }}"></script>
    <script src="{{ asset('public/loginMaterials/js/active.js') }}"></script>

</body>

</html>
