<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>:: LMS :: </title>
    <meta property="og:title" content="LMS" style="text-transform: capitalize" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="{{ asset('lms-022.png') }}" />
    <meta property="og:description" content="Learning Management System SMK 1 Krian Sidoarjo" />
    <meta property="og:url" content="http://lms.coffinashop.com" />
    <meta name="theme-color" content="#8CC0DE">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="twitter:card" content="summary_large_image">
    <meta property='og:image:width' content='1200' />
    <meta property='og:image:height' content='627' />
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('fe_assets/assets/img/favicon.png') }}">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/swiper-bundle.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/backToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/fontAwesome5Pro.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/elegantFont.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/default.css') }}">
    <link rel="stylesheet" href="{{ asset('fe_assets/assets/css/style.css') }}">
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->

    <!-- Add your site or application content here -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    <div class="body-overlay"></div>
    <!-- sidebar area end -->
    <div class="body-overlay"></div>
    <!-- sidebar area end -->

    <main>

        <!-- sign up area start -->
        <section class="signup__area po-rel-z1 pt-50">
            <div class="sign__shape">
                <img class="man-1" src="{{ asset('fe_assets/assets/img/icon/sign/man-3.png') }}" alt="">
                <img class="man-2 man-22" src="{{ asset('fe_assets/assets/img/icon/sign/man-2.png') }}" alt="">
                <img class="circle" src="{{ asset('fe_assets/assets/img/icon/sign/circle.png') }}" alt="">
                <img class="zigzag" src="{{ asset('fe_assets/assets/img/icon/sign/zigzag.png') }}" alt="">
                <img class="dot" src="{{ asset('fe_assets/assets/img/icon/sign/dot.png') }}" alt="">
                <img class="bg" src="{{ asset('fe_assets/assets/img/icon/sign/sign-up.png') }}" alt="">
                <img class="flower" src="{{ asset('fe_assets/assets/img/icon/sign/flower.png') }}" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                        <div class="section__title-wrapper text-center mb-20">
                            <style>
                                @media only screen and (min-width: 601px) {
                                    .logo-lms {
                                        max-width: 300px;
                                    }
                                }

                                @media only screen and (max-width: 600px) {
                                    .logo-lms {
                                        max-width: 220px;
                                    }
                                }
                            </style>
                            <img src="{{ asset('lms-02.png') }}" class="logo-lms"
                                alt="logo">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div class="sign__wrapper white-bg">
                            @if ($message = Session::get('error'))
                                <div class="alert alert-info alert-block" style="background-color: rgb(255, 140, 140)">
                                    <strong style="color:white">{{ $message }}</strong>
                                </div>
                            @endif
                            <div class="sign__form">
                                <form action="{{ route('login') }}" method="POST"> @csrf
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>Username</h5>
                                        <div class="sign__input">
                                            <input type="text" name="username" placeholder="Username">
                                            <i class="fal fa-user"></i>
                                        </div>
                                    </div>

                                    <div class="sign__input-wrapper mb-25">
                                        <h5>Password</h5>
                                        <div class="sign__input">
                                            <input type="password" name="password" placeholder="Password">
                                            <i class="fal fa-lock"></i>
                                        </div>
                                    </div>
                                    <button class="e-btn w-100"> <span></span> Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sign up area end -->

    </main>
    <!-- JS here -->
    <script src="{{ asset('fe_assets/assets/js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/jquery.meanmenu.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/parallax.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/backToTop.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/ajax-form.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('fe_assets/assets/js/main.js') }}"></script>
</body>

</html>
