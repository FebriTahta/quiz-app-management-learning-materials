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

    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">

    <meta name="csrf-token" content="{{csrf_token()}}">
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

    <!-- header area start -->
    <header>
        <div id="header-sticky" class="header__area header__transparent header__padding header__white">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-2 col-sm-4 col-6">
                        <div class="header__left d-flex">
                            <div class="logo">
                                <a href="/">
                                    <img class="logo-white" src="{{ asset('lms-02.png') }}" style="max-width: 100px"
                                        alt="logo">
                                    <img class="logo-black" src="{{ asset('lms-02.png') }}" style="max-width: 100px"
                                        alt="logo">
                                </a>
                            </div>
                            <div class="header__category d-none d-lg-block">
                                <nav>
                                    <ul>
                                        <li>
                                            <a href="/" class="cat-menu d-flex align-items-center" style="margin-top: 10px">
                                                <div class="cat-dot-icon d-inline-block">
                                                    <svg viewBox="0 0 276.2 276.2">
                                                        <g>
                                                            <g>
                                                                <path class="cat-dot"
                                                                    d="M33.1,2.5C15.3,2.5,0.9,17,0.9,34.8s14.5,32.3,32.3,32.3s32.3-14.5,32.3-32.3S51,2.5,33.1,2.5z" />
                                                                <path class="cat-dot"
                                                                    d="M137.7,2.5c-17.8,0-32.3,14.5-32.3,32.3s14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3S155.5,2.5,137.7,2.5    z" />
                                                                <path class="cat-dot"
                                                                    d="M243.9,67.1c17.8,0,32.3-14.5,32.3-32.3S261.7,2.5,243.9,2.5S211.6,17,211.6,34.8S226.1,67.1,243.9,67.1z" />
                                                                <path class="cat-dot"
                                                                    d="M32.3,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3S0,120.4,0,138.2S14.5,170.5,32.3,170.5z" />
                                                                <path class="cat-dot"
                                                                    d="M136.8,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3c-17.8,0-32.3,14.5-32.3,32.3    C104.5,156.1,119,170.5,136.8,170.5z" />
                                                                <path class="cat-dot"
                                                                    d="M243,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3s-32.3,14.5-32.3,32.3    C210.7,156.1,225.2,170.5,243,170.5z" />
                                                                <path class="cat-dot"
                                                                    d="M33,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3s32.3-14.5,32.3-32.3S50.8,209.1,33,209.1z    " />
                                                                <path class="cat-dot"
                                                                    d="M137.6,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3    S155.4,209.1,137.6,209.1z" />
                                                                <path class="cat-dot"
                                                                    d="M243.8,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3    S261.6,209.1,243.8,209.1z" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </div>
                                                <span>Home</span>
                                            </a>
                                            {{-- <ul class="cat-submenu">
                                                <li><a href="course-details.html">RPL</a></li>
                                                <li><a href="course-details.html">Biologi</a></li>
                                                <li><a href="course-details.html">Matematika</a></li>
                                                <li><a href="course-details.html">Indonesia</a></li>
                                                <li><a href="course-details.html">Bahasa Jawa</a></li>
                                            </ul> --}}
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-10 col-sm-8 col-6">
                        <div class="header__right d-flex justify-content-end align-items-center">
                            <div class="main-menu main-menu-3">
                                <nav id="mobile-menu">
                                    <ul>
                                        <!-- <li class="has-dropdown">
                                    <a href="index.html">Home</a>
                                    <ul class="submenu">
                                       <li><a href="index.html">Home Style 1</a></li>
                                       <li><a href="index-2.html">Home Style 2</a></li>
                                       <li><a href="index-3.html">Home Style 3</a></li>
                                    </ul>
                                 </li>
                                 <li class="has-dropdown">
                                    <a href="course-grid.html">Mata Pelajaran</a>
                                    <ul class="submenu">
                                       <li><a href="course-grid.html">Courses</a></li>
                                       <li><a href="course-list.html">Course List</a></li>
                                       <li><a href="course-sidebar.html">Course sidebar</a></li>
                                       <li><a href="course-details.html">Course Details</a></li>
                                    </ul>
                                 </li> -->
                                        <!-- <li class="has-dropdown">
                                    <a href="blog.html">-</a>
                                    <ul class="submenu">
                                       <li><a href="blog.html">Blog</a></li>
                                       <li><a href="blog-details.html">Blog Details</a></li>
                                    </ul>
                                 </li>
                                 <li class="has-dropdown">
                                    <a href="course-grid.html">Pages</a>
                                    <ul class="submenu">
                                       <li><a href="about.html">About</a></li>
                                       <li><a href="instructor.html">Instructor</a></li>
                                       <li><a href="instructor-details.html">Instructor Details</a></li>
                                       <li><a href="event-details.html">Event Details</a></li>
                                       <li><a href="cart.html">My Cart</a></li>
                                       <li><a href="wishlist.html">My Wishlist</a></li>
                                       <li><a href="checkout.html">checkout</a></li>
                                       <li><a href="sign-in.html">Sign In</a></li>
                                       <li><a href="sign-up.html">Sign Up</a></li>
                                       <li><a href="error.html">Error</a></li>
                                    </ul>
                                 </li> -->
                                        {{-- <li><a href="/">Home</a></li> --}}
                                        {{-- <li class="has-dropdown">
                                            <a href="blog.html">Daftar Mapel</a>
                                            <ul class="submenu">
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                            </ul>
                                        </li> --}}
                                        <li><a href="{{ route('daftarPeringkat') }}">Ranking</a></li>
                                        <li><a href="{{ route('rekapNilai') }}">Rekap</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                >Log Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header__search p-relative ml-50 d-none d-md-block">
                                <form action="#">
                                    <input type="text" placeholder="NOTIF" disabled style="width: 160px">
                                    {{-- <button type="submit"><i class="fad fa-search"></i></button> --}}
                                </form>
                                <!-- <div class="header__cart">
                              <a href="javascript:void(0);" class="cart-toggle-btn">
                                 <div class="header__cart-icon">
                                    <svg viewBox="0 0 24 24">
                                       <circle class="st0" cx="9" cy="21" r="1"/>
                                       <circle class="st0" cx="20" cy="21" r="1"/>
                                       <path class="st0" d="M1,1h4l2.7,13.4c0.2,1,1,1.6,2,1.6h9.7c1,0,1.8-0.7,2-1.6L23,6H6"/>
                                    </svg>
                                 </div>
                                 <span class="cart-item">2</span>
                              </a>
                           </div> -->
                           <div class="header__cart">
                            <a href="javascript:void(0);" class="cart-toggle-btn">
                               <div class="header__cart-icon">
                                  {{-- <svg viewBox="0 0 24 24">
                                     <circle class="st0" cx="9" cy="21" r="1"/>
                                     <circle class="st0" cx="20" cy="21" r="1"/>
                                     <path class="st0" d="M1,1h4l2.7,13.4c0.2,1,1,1.6,2,1.6h9.7c1,0,1.8-0.7,2-1.6L23,6H6"/>
                                  </svg> --}}
                                  <i class="fa fa-bell"></i>
                               </div>
                               <span class="cart-item" id="total_notif">?</span>
                            </a>
                         </div>
                            </div>
                            <!-- <div class="header__btn ml-20 d-none d-sm-block">
                           <a href="contact.html" class="e-btn">Try for free</a>
                        </div> -->
                            <div class="sidebar__menu d-xl-none">
                                <div class="sidebar-toggle-btn ml-30" id="sidebar-toggle">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <div class="cartmini__area">
        <div class="cartmini__wrapper">
           <div class="cartmini__title">
              <h4>Notification...</h4>
           </div>
           <div class="cartmini__close">
              <button type="button" class="cartmini__close-btn"><i class="fal fa-times"></i></button>
           </div>
           <div class="cartmini__widget">
              <div class="cartmini__inner">
                 <ul class="wrapper_notif">
                   {{-- NOTIF --}}
                 </ul>
              </div>
              <div class="cartmini__checkout">
                <div class="cartmini__checkout-btn">
                   <a href="#" class="e-btn w-100" id="read_all_notif" > <span></span> mark as read all</a>
                </div>
             </div>
           </div>
        </div>
     </div>

    <!-- header area end -->
    <div class="body-overlay"></div>
    <!-- cart mini area end -->

    <div class="sidebar__area">
        <div class="sidebar__wrapper">
            <div class="sidebar__close">
                <button class="sidebar__close-btn" id="sidebar__close-btn">
                    <span><i class="fal fa-times"></i></span>
                    <span>close</span>
                </button>
            </div>
            <div class="sidebar__content">
                <div class="logo mb-40">
                    <a href="/">
                        <img src="{{ asset('lms-02.png') }}" alt="logo" style="max-width: 100px">
                    </a>
                </div>
                <div class="mobile-menu fix"></div>

                <div class="sidebar__search p-relative mt-40 ">
                    <form action="#">
                        <input type="text" placeholder="Search...">
                        <button type="submit"><i class="fad fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar area end -->
    <div class="body-overlay"></div>
    <!-- sidebar area end -->
