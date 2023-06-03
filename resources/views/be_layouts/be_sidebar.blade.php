<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('assets/assets/img/basic/favicon.ico') }}" type="image/x-icon">
    <title>:: Admin Panel ::</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- CSS -->
    @yield('style')
    <link rel="stylesheet" href="{{ asset('assets/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/sweetalert/sweetalert.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/toastr/toastr.min.css') }}" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
    <!-- Js -->
    <!--
    --- Head Part - Use Jquery anywhere at page.
    --- http://writing.colin-gourlay.com/safely-using-ready-before-including-jquery/
    -->
    <script>
        (function(w, d, u) {
            w.readyQ = [];
            w.bindReadyQ = [];

            function p(x, y) {
                if (x == "ready") {
                    w.bindReadyQ.push(y);
                } else {
                    w.readyQ.push(x);
                }
            };
            var a = {
                ready: p,
                bind: p
            };
            w.$ = w.jQuery = function(f) {
                if (f === d || f === u) {
                    return a
                } else {
                    p(f)
                }
            }
        })(window, document)
    </script>
</head>

<body class="light">
    <!-- Pre loader -->
    <div id="loader" class="loader">
    </div>
    <div id="app">
        <aside class="main-sidebar fixed offcanvas shadow" data-toggle='offcanvas'>
            <section class="sidebar">
                <div class="relative" style="margin-top: 20px">
                    <a data-toggle="collapse" href="#userSettingsCollapse" role="button" aria-expanded="false"
                        aria-controls="userSettingsCollapse"
                        class="btn-fab btn-fab-sm absolute fab-right-bottom fab-top btn-primary shadow1 ">
                        <i class="icon icon-cogs"></i>
                    </a>
                    <div class="user-panel p-3 light mb-2">
                        <div>
                            <div class="float-left image">
                                <img class="user_avatar" src="{{ asset('assets/assets/img/dummy/u2.png') }}"
                                    alt="User Image">
                            </div>
                            <div class="float-left info">
                                <h6 class="font-weight-light mt-2 mb-1 text-capitalize">{{ auth()->user()->username }}
                                </h6>
                                <a href="#" class="text-capitalize"><i
                                        class="icon-circle text-primary blink "></i> {{ auth()->user()->role }}</a>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="collapse multi-collapse" id="userSettingsCollapse">
                            <div class="list-group mt-3 shadow">
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="list-group-item list-group-item-action"><i
                                        class="mr-2 icon-security text-purple"></i>Log Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header light mt-3"><strong>NAVIGATION</strong></li>
                    <li class="treeview"><a href="/admin-dashboard">
                            <i class="icon icon icon-package blue-text s-18"></i>
                            <span>Dashboard</span>
                            {{-- <span class="badge r-3 badge-primary pull-right">4</span> --}}
                        </a>
                    </li>


                    <li class="header light mt-3"><strong>COMPONENTS</strong></li>

                    <li class="treeview active">
                        <a href="#">
                            <i class="icon icon icon-dialpad blue-text s-18 "></i> <span>Master Data</span>
                            <i class="icon icon-angle-left s-18 pull-right"></i>
                        </a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="/admin-angkatan">
                                    <i class="icon icon-university light-blue-text s-14"></i>
                                    <span>Angkatan</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin-jurusan">
                                    <i class="icon icon-gear light-blue-text s-14"></i>
                                    <span>Jurusan</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin-mapel">
                                    <i class="icon icon-book light-blue-text s-14"></i>
                                    <span>Mata Pelajaran</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin-jurusan-&-kelas">
                                    <i class="icon icon-class light-blue-text s-14"></i>
                                    <span>Kelas</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin-guru">
                                    <i class="icon icon-group light-blue-text s-14"></i>
                                    <span>Guru</span>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="/admin-siswa">
                                    <i class="icon icon-group light-blue-text s-14"></i>
                                    <span>Siswa</span>
                                </a>
                            </li>
                            <li>
                                <a href="/admin-jurusan-&-kelas">
                                    &nbsp;<i class="icon icon-user light-blue-text s-14"></i>
                                    <span>Guru</span>
                                </a>
                            </li> --}}

                        </ul>
                    </li>

                    {{-- <li class="header light mt-3"><strong>MANAJEMEN KELAS</strong></li>

                    <li class="treeview"><a href="#"><i class="icon icon-class light-green-text s-18"></i>Struktur
                            Kelas<i class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="/#"><i class="icon icon-circle-o"></i>Kelas - Mapel</a>
                            </li>
                            <li>
                                <a href="/#"><i class="icon icon-circle-o"></i>Kelas - Siswa</a>
                            </li>
                            <li>
                                <a href="/#"><i class="icon icon-circle-o"></i>Kelas - Guru</a>
                            </li>
                        </ul>
                    </li> --}}

                    {{-- novendra 11/1/2023 --}}

                    <li class="header light mt-3"><strong>UJIAN ONLINE UAS / UTS</strong></li>

                    <li class="treeview"><a href="#"><i
                                class="icon icon-edit light-red-text s-18"></i>UJIAN<i
                                class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/admin-manajemen-ujian"><i class="icon icon-circle-o"></i>Ujian Multiple Choice</a></li>
                            <li><a href="/admin-manajemen-ujian-urai"><i class="icon icon-circle-o"></i>Ujian Uraian</a></li>
                            <li><a href="/daftar-ranking-kelas"><i class="icon icon-circle-o"></i>Ranking Kelas</a></li>
                            <li><a href="/halaman-unduh-hasil-uraian"><i class="icon icon-circle-o"></i>Unduh Hasil Uraian</a></li>
                            <li><a href="/admin-download-data-ujian-pilihan"><i class="icon icon-circle-o"></i>Unduh Hasil Pilihan Ganda</a></li>
                        </ul>
                    </li>
                    {{--  --}}

                    <li class="header light mt-3"><strong>ACCOUNT</strong></li>

                    <li class="treeview"><a href="#"><i
                                class="icon icon-account_box light-red-text s-18"></i>Users<i
                                class="icon icon-angle-left s-18 pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="/admin-daftar-user"><i class="icon icon-circle-o"></i>All Users</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </section>
        </aside>
        <!--Sidebar End-->
        <div class="has-sidebar-left">
            <div class="pos-f-t">
                <div class="collapse" id="navbarToggleExternalContent">
                    <div class="bg-dark pt-2 pb-2 pl-4 pr-2">
                        <div class="search-bar">
                            <input class="transparent s-24 text-white b-0 font-weight-lighter w-128 height-50"
                                type="text" placeholder="start typing...">
                        </div>
                        <a href="#" data-toggle="collapse" data-target="#navbarToggleExternalContent"
                            aria-expanded="false" aria-label="Toggle navigation"
                            class="paper-nav-toggle paper-nav-white active "><i></i></a>
                    </div>
                </div>
            </div>
            <div class="sticky">
                <div class="navbar navbar-expand navbar-dark d-flex justify-content-between bd-navbar blue accent-3">
                    <div class="relative">
                        <a href="#" data-toggle="push-menu" class="paper-nav-toggle pp-nav-toggle">
                            <i></i>
                        </a>
                    </div>
