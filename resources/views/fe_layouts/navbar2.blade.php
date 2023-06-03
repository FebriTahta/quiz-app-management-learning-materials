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
<header>
    <div id="header-sticky" class="header__area header__padding-2 header__shadow">
       <div class="container">
          <div class="row align-items-center">
             <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-2 col-sm-4 col-6">
                <div class="header__left d-flex">
                   <div class="logo" style="padding: 0">
                      <a href="/">
                         <img src="{{ asset('lms-02.png') }}" style="max-width: 100px" alt="logo">
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
                                              <path class="cat-dot" d="M33.1,2.5C15.3,2.5,0.9,17,0.9,34.8s14.5,32.3,32.3,32.3s32.3-14.5,32.3-32.3S51,2.5,33.1,2.5z"/>
                                              <path class="cat-dot" d="M137.7,2.5c-17.8,0-32.3,14.5-32.3,32.3s14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3S155.5,2.5,137.7,2.5    z"/>
                                              <path class="cat-dot" d="M243.9,67.1c17.8,0,32.3-14.5,32.3-32.3S261.7,2.5,243.9,2.5S211.6,17,211.6,34.8S226.1,67.1,243.9,67.1z"/>
                                              <path class="cat-dot" d="M32.3,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3S0,120.4,0,138.2S14.5,170.5,32.3,170.5z"/>
                                              <path class="cat-dot" d="M136.8,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3c-17.8,0-32.3,14.5-32.3,32.3    C104.5,156.1,119,170.5,136.8,170.5z"/>
                                              <path class="cat-dot" d="M243,170.5c17.8,0,32.3-14.5,32.3-32.3c0-17.8-14.5-32.3-32.3-32.3s-32.3,14.5-32.3,32.3    C210.7,156.1,225.2,170.5,243,170.5z"/>
                                              <path class="cat-dot" d="M33,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3s32.3-14.5,32.3-32.3S50.8,209.1,33,209.1z    "/>
                                              <path class="cat-dot" d="M137.6,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3    S155.4,209.1,137.6,209.1z"/>
                                              <path class="cat-dot" d="M243.8,209.1c-17.8,0-32.3,14.5-32.3,32.3c0,17.8,14.5,32.3,32.3,32.3c17.8,0,32.3-14.5,32.3-32.3    S261.6,209.1,243.8,209.1z"/>
                                           </g>
                                        </g>
                                     </svg>
                                  </div>
                                  <span>Home</span>
                               </a>
                               {{-- <ul class="cat-submenu">
                                  <li><a href="course-details.html">English Learning</a></li>
                                  <li><a href="course-details.html">Web Development</a></li>
                                  <li><a href="course-details.html">Logo Design</a></li>
                                  <li><a href="course-details.html">Motion Graphics</a></li>
                                  <li><a href="course-details.html">Video Edition</a></li>
                               </ul> --}}
                            </li>
                         </ul>
                      </nav>
                   </div>
                </div>
             </div>
             <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-10 col-sm-8 col-6">
                <div class="header__right d-flex justify-content-end align-items-center">
                   <div class="main-menu main-menu-2">
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
                               <a href="course-grid.html">Courses</a>
                               <ul class="submenu">
                                  <li><a href="course-grid.html">Courses</a></li>
                                  <li><a href="course-list.html">Course List</a></li>
                                  <li><a href="course-sidebar.html">Course sidebar</a></li>
                                  <li><a href="course-details.html">Course Details</a></li>
                               </ul>
                            </li>
                            <li class="has-dropdown">
                               <a href="blog.html">Blog</a>
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
                            {{-- <li><a href="contact.html">Home</a></li> --}}

                            {{-- <li><a href="contact.html">Mata Pelajaran</a></li>
                            
                            <li><a href="contact.html">Peringkat</a></li> --}}
                            <li><a href="{{ route('logout') }}"
                              onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                              ><u>Log Out</u></a>
                          <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                              {{ csrf_field() }}
                          </form></li>
                         </ul>
                      </nav>
                   </div>
                   {{-- <div class="header__btn header__btn-2 ml-50 d-none d-sm-block">
                      <a href="sign-up.html" class="e-btn">Sign up</a>
                   </div> --}}
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
                        <img src="{{ asset('fe_assets/assets/img/logo/logo.png') }}" alt="logo">
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