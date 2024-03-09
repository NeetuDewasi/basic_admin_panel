<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pages / Login - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="CodedThemes">
    <meta name="keywords"
        content=" Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="CodedThemes">

    <link rel="icon" href="/assets/images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="/assets/icon/themify-icons/themify-icons.css">

    <link rel="stylesheet" type="text/css" href="/assets/icon/icofont/css/icofont.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/style.css">

<body>

    <body class="fix-menu">

        {{--  <div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>  --}}


        <section class="login p-fixed d-flex text-center bg-primary common-img-bg">

            <div class="container">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="login-card card-block auth-body mr-auto ml-auto">
                            <form class="md-float-material" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="text-center m-b-20">
                                    <h3 class="text-center" style="color: #303549">LOGIN FORM</h3>
                                    {{--  <img src="/assets/images/auth/logo-dark.png" alt="logo.png">  --}}
                                </div>
                                <div class="auth-box">
                                    <div class="row m-b-20">
                                        <div class="col-md-12">
                                            <h3 class="text-left txt-primary">Sign In</h3>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="input-group">
                                        <input type="email" id="email"
                                            placeholder="Your Email Address" name="email" value="{{ old('email') }}"
                                            class="col-md-12 form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus>
                                                <span class="md-line"></span>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="input-group">
                                        <input type="password" id="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="current-password" placeholder="Password">
                                        <span class="md-line"></span>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    {{--  <div class="row m-t-25 text-left">
                                        <div class="col-sm-7 col-xs-12">
                                            <div class="checkbox-fade fade-in-primary">
                                                <label>
                                                    <input type="checkbox" value="">
                                                    <span class="cr"><i
                                                            class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                    <span class="text-inverse">Remember me</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                            <a href="auth-reset-password.html" class="text-right f-w-600 text-inverse">
                                                Forgot Your Password?</a>
                                        </div>
                                    </div>  --}}
                                    <div class="row m-t-30">
                                        <div class="col-md-12">
                                            <button type="submit"
                                                class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Sign
                                                in</button>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="row">
                                        <div class="col-md-10">
                                            <p class="text-inverse text-left m-b-0">Thank you and enjoy our website.</p>
                                            <p class="text-inverse text-left"><b>Your Authentication Team</b></p>
                                        </div>
                                        <div class="col-md-2">
                                            <img src="/assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </section>

        <script type="text/javascript" src="/assets/js/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="/assets/js/jquery-ui/jquery-ui.min.js"></script>
        <script type="text/javascript" src="/assets/js/popper.js/popper.min.js"></script>
        <script type="text/javascript" src="/assets/js/bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="/assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

        <script type="text/javascript" src="/assets/js/modernizr/modernizr.js"></script>
        <script type="text/javascript" src="/assets/js/modernizr/css-scrollbars.js"></script>
        <script type="text/javascript" src="/assets/js/common-pages.js"></script>

    </body>

</html>
