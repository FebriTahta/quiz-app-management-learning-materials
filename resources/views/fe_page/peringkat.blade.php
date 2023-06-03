@extends('fe_layouts.master')

@section('fe_content')
    <main>
        <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
            data-background="{{ asset('fe_assets/assets/img/page-title.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="page__title-wrapper mt-110">
                            <h3 class="page__title">{{ $kelas->kelas_name }}
                                {{ $kelas->jurusan->jurusan_name }}
                                {{ $kelas->angkatan->tingkat->tingkat_name }}
                                "{{ $kelas->angkatan->angkatan_name }}"</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Daftar Peringkat</li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $siswa_ini->siswa_name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="course__area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 pb-20">
                        <div class="teacher__details-thumb p-relative w-img">
                            <div class="blocl">
                                @if (auth()->user()->siswa->detailsiswa)
                                    <img src="{{ asset('siswa_image/'.auth()->user()->siswa->detailsiswa->img_siswa) }}" alt="">    
                                @else
                                    <img src="{{ asset('fe_assets/assets/img/teacer-details-1.jpg') }}" alt="">
                                @endif
                            </div>
                            <div class="events__sidebar-widget white-bg">
                                <div class="events__sponsor">
                                    <h3 class="events__sponsor-title" style="text-transform: capitalize">Name : {{ auth()->user()->siswa->siswa_name }}</h3>
                                </div>
                                <hr>
                                <div class="events__sponsor">
                                    <div class="events__sponsor-info">
                                        <h3>Overview :</h3>
                                        <h4><span>Rekap keseluruhan nilai serta rata-rata pada tiap jenis ujian yang telah dikerjakan</span></h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="events__sponsor">
                                    <div class="events__sponsor-info" style="margin-bottom: 15px">
                                        <h3>
                                            UTS 01 : <br>
                                            @if ($myrank_uts1 == null)
                                                -- 
                                            @else
                                                @if (strlen($myrank_uts1->ranking_rank) == 1)
                                                <span class="text-primary"> ranking - 0{{ $myrank_uts1->ranking_rank }}</span>
                                                @else
                                                <span class="text-primary">ranking - {{ $myrank_uts1->ranking_rank }}</span>
                                                @endif
                                            @endif
                                        </h3>
                                    </div>
                                    
                                    <div class="events__sponsor-info" style="margin-bottom: 15px">
                                        <h3>UAS 01 : <br>
                                            @if ($myrank_uas1 == null)
                                                --
                                            @else
                                                @if (strlen($myrank_uas1->ranking_rank) == 1)
                                                <span class="text-primary">ranking - 0{{ $myrank_uas1->ranking_rank }}</span>
                                                @else
                                                <span class="text-primary">ranking - {{ $myrank_uas1->ranking_rank }}</span>
                                                @endif
                                            @endif
                                        </h3>
                                    </div>
                                    
                                    <div class="events__sponsor-info" style="margin-bottom: 15px">
                                        <h3>UTS 02 : <br>
                                            @if ($myrank_uts2 == null)
                                                --
                                            @else
                                                @if (strlen($myrank_uts2->ranking_rank) == 1)
                                                <span class="text-primary">ranking - 0{{ $myrank_uts2->ranking_rank }}</span>
                                                @else
                                                <span class="text-primary">ranking - {{ $myrank_uts2->ranking_rank }}</span>
                                                @endif
                                            @endif
                                        </h3>
                                    </div>
                                    
                                    <div class="events__sponsor-info" style="margin-bottom: 15px">
                                        <h3>UAS 02 : <br>
                                            @if ($myrank_uas2 == null)
                                                --
                                            @else
                                                @if (strlen($myrank_uas2->ranking_rank) == 1)
                                                <span class="text-primary">ranking - 0{{ $myrank_uas2->ranking_rank }}</span>
                                                @else
                                                <span class="text-primary">ranking - {{ $myrank_uas2->ranking_rank }}</span>
                                                @endif
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="teacher__details-shape">
                                <img class="teacher-details-shape-1"
                                    src="{{ asset('fe_assets/assets/img/teacher/details/shape/shape-1.png') }}"
                                    alt="">
                                <img class="teacher-details-shape-2"
                                    src="{{ asset('fe_assets/assets/img/teacher/details/shape/shape-2.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-8 col-xl-8 col-lg-8">
                        <div class="teacher__wrapper">
                            <div class="teacher__top d-md-flex align-items-end justify-content-between">
                                
                            </div>

                            <div class="teacher_bio" style="margin-top: 10px">
                                <div class="course__tab-2 mb-45">
                                    <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="curriculum-tab" data-bs-toggle="tab"
                                                data-bs-target="#curriculum" type="button" role="tab"
                                                aria-controls="curriculum" aria-selected="false"> <i
                                                class="icon_ribbon_alt"></i></i>
                                                <span>UTS 1 </span> </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                                data-bs-target="#review" type="button" role="tab"
                                                aria-controls="review" aria-selected="false"> <i
                                                class="icon_ribbon_alt"></i>
                                                <span>UAS 1</span>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="member-tab" data-bs-toggle="tab"
                                                data-bs-target="#member" type="button" role="tab"
                                                aria-controls="member" aria-selected="false"> <i
                                                class="icon_ribbon_alt"></i>
                                                <span>UTS 2</span> </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link " id="description-tab" data-bs-toggle="tab"
                                                data-bs-target="#description" type="button" role="tab"
                                                aria-controls="description" aria-selected="true"> <i
                                                    class="icon_ribbon_alt"></i>
                                                <span>UAS 2</span> </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course__tab-content mb-95">
                                <div class="tab-content" id="courseTabContent">
                                    <div class="tab-pane fade" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="course__curriculum">
                                            <div class="accordion" id="course__accordion">
                                                <div class="accordion-item mb-20">
                                                    <h2 class="accordion-header" id="week-01">
                                                        <button class="accordion-button"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#x1"
                                                            aria-expanded="true" aria-controls="week-01-content">
                                                            UAS SEMESTER 02
                                                        </button>
                                                    </h2>

                                                    <div id="x1"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                                        <div class="accordion-body">
                                                            @foreach ($kelas->siswa as $key=> $item)
                                                                <div
                                                                    class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                    <div class="course__comment-thumb float-start">
                                                                        @if ($item->detailsiswa)
                                                                            <img src="{{ asset('siswa_image/'.$item->detailsiswa->img_siswa) }}" alt="">    
                                                                            @else
                                                                            <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                            alt="">
                                                                        @endif
                                                                    </div>
                                                                   
                                                                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="course__member-name ml-20">
                                                                                <h5 style="text-transform: capitalize">{{ $item->siswa_name }}</h5>
                                                                                <span>rata-rata nilai UAS SEMESTER 02</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                        <div class="course__member-info pl-45">
                                                                            <h5>
                                                                                AVG : {{ round($avg4[$key]) }}
                                                                            </h5>
                                                                            <span>rata-rata</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="accordion" id="course__accordion">
                                                <div class="accordion-item mb-20">
                                                    <h2 class="accordion-header" id="week-02">
                                                        <button class="accordion-button text-capitalize"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#x2"
                                                            aria-expanded="true" aria-controls="week-02-content">
                                                            Peringkat
                                                        </button>
                                                    </h2>

                                                    <div id="x2"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="week-02" data-bs-parent="#course__accordion">
                                                        <div class="accordion-body">
                                                            @if ($rank_uas2->count() > 0)
                                                                @foreach ($rank_uas2 as $key=> $item)
                                                                    <div
                                                                        class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                        <div class="course__comment-thumb float-start">
                                                                            @if ($item->siswa->detailsiswa)
                                                                                <img src="{{ asset('siswa_image/'.$item->siswa->detailsiswa->img_siswa) }}" alt="">    
                                                                                @else
                                                                                <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                                alt="">
                                                                            @endif
                                                                        </div>
                                                                    
                                                                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="course__member-name ml-20">
                                                                                    <h5 style="text-transform: capitalize">{{ $item->siswa->siswa_name }}</h5>
                                                                                    <span>rata-rata nilai : {{ $item->ranking_nilai }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                            <div class="course__member-info pl-45">
                                                                                <h5>
                                                                                    @if (strlen($item->ranking_rank) == 1)
                                                                                        : 0{{ $item->ranking_rank }} -
                                                                                    @else
                                                                                        : {{ $item->ranking_rank }} -
                                                                                    @endif 
                                                                                </h5>
                                                                                <span>ranking</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="course__member-name ml-20">
                                                                                <h5 style="text-transform: capitalize">Data Ranking / Peringkat Belum Diterbitkan</h5>
                                                                                <span>hubungi admin untuk update data ranking kelas</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade  show active" id="curriculum" role="tabpanel"
                                        aria-labelledby="curriculum-tab">
                                        <div class="course__curriculum">

                                                <div class="accordion" id="course__accordion">
                                                    <div class="accordion-item mb-20">
                                                        <h2 class="accordion-header" id="week-01">
                                                            <button class="accordion-button"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#x1"
                                                                aria-expanded="true" aria-controls="week-01-content">
                                                                UTS SEMESTER 01
                                                            </button>
                                                        </h2>

                                                        <div id="x1"
                                                            class="accordion-collapse collapse show"
                                                            aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                                            <div class="accordion-body">
                                                                @foreach ($kelas->siswa as $key=> $item)
                                                                    <div
                                                                        class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                        <div class="course__comment-thumb float-start">
                                                                            @if ($item->detailsiswa)
                                                                                <img src="{{ asset('siswa_image/'.$item->detailsiswa->img_siswa) }}" alt="">    
                                                                                @else
                                                                                <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                                alt="">
                                                                            @endif
                                                                        </div>
                                                                       
                                                                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="course__member-name ml-20">
                                                                                    <h5 style="text-transform: capitalize">{{ $item->siswa_name }}</h5>
                                                                                    <span>rata-rata nilai UTS SEMESTER 01</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                            <div class="course__member-info pl-45">
                                                                                <h5>
                                                                                    AVG : {{ round($avg[$key]) }}
                                                                                </h5>
                                                                                <span>rata-rata</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="accordion" id="course__accordion">
                                                    <div class="accordion-item mb-20">
                                                        <h2 class="accordion-header" id="week-02">
                                                            <button class="accordion-button text-capitalize"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#x2"
                                                                aria-expanded="true" aria-controls="week-02-content">
                                                                Peringkat
                                                            </button>
                                                        </h2>

                                                        <div id="x2"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="week-02" data-bs-parent="#course__accordion">
                                                            <div class="accordion-body">
                                                                @if ($rank_uts1->count() > 0)
                                                                    @foreach ($rank_uts1 as $key=> $item)
                                                                        <div
                                                                            class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                            <div class="course__comment-thumb float-start">
                                                                                @if ($item->siswa->detailsiswa)
                                                                                    <img src="{{ asset('siswa_image/'.$item->siswa->detailsiswa->img_siswa) }}" alt="">    
                                                                                    @else
                                                                                    <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                                    alt="">
                                                                                @endif
                                                                            </div>
                                                                        
                                                                            <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12">
                                                                                <div class="d-flex align-items-center">
                                                                                    <div class="course__member-name ml-20">
                                                                                        <h5 style="text-transform: capitalize">{{ $item->siswa->siswa_name }}</h5>
                                                                                        <span>rata-rata nilai : {{ $item->ranking_nilai }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                                <div class="course__member-info pl-45">
                                                                                    <h5>
                                                                                        @if (strlen($item->ranking_rank) == 1)
                                                                                            : 0{{ $item->ranking_rank }} -
                                                                                        @else
                                                                                            : {{ $item->ranking_rank }} -
                                                                                        @endif 
                                                                                    </h5>
                                                                                    <span>ranking</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                @else
                                                                    <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="course__member-name ml-20">
                                                                                    <h5 style="text-transform: capitalize">Data Ranking / Peringkat Belum Diterbitkan</h5>
                                                                                    <span>hubungi admin untuk update data ranking kelas</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                        <div class="course__curriculum">
                                            <div class="accordion" id="course__accordion">
                                                <div class="accordion-item mb-20">
                                                    <h2 class="accordion-header" id="week-01">
                                                        <button class="accordion-button"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#x1"
                                                            aria-expanded="true" aria-controls="week-01-content">
                                                            UAS SEMESTER 01
                                                        </button>
                                                    </h2>

                                                    <div id="x1"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                                        <div class="accordion-body">
                                                            @foreach ($kelas->siswa as $key=> $item)
                                                                <div
                                                                    class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                    <div class="course__comment-thumb float-start">
                                                                        @if ($item->detailsiswa)
                                                                            <img src="{{ asset('siswa_image/'.$item->detailsiswa->img_siswa) }}" alt="">    
                                                                            @else
                                                                            <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                            alt="">
                                                                        @endif
                                                                    </div>
                                                                   
                                                                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="course__member-name ml-20">
                                                                                <h5 style="text-transform: capitalize">{{ $item->siswa_name }}</h5>
                                                                                <span>rata-rata nilai UAS SEMESTER 01</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                        <div class="course__member-info pl-45">
                                                                            <h5>
                                                                                AVG : {{ round($avg3[$key]) }}
                                                                            </h5>
                                                                            <span>rata-rata</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion" id="course__accordion">
                                                <div class="accordion-item mb-20">
                                                    <h2 class="accordion-header" id="week-02">
                                                        <button class="accordion-button text-capitalize"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#x2"
                                                            aria-expanded="true" aria-controls="week-02-content">
                                                            Peringkat
                                                        </button>
                                                    </h2>

                                                    <div id="x2"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="week-02" data-bs-parent="#course__accordion">
                                                        <div class="accordion-body">
                                                            @if ($rank_uas1->count() > 0)
                                                                @foreach ($rank_uas1 as $key=> $item)
                                                                    <div
                                                                        class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                        <div class="course__comment-thumb float-start">
                                                                            @if ($item->siswa->detailsiswa)
                                                                                <img src="{{ asset('siswa_image/'.$item->siswa->detailsiswa->img_siswa) }}" alt="">    
                                                                                @else
                                                                                <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                                alt="">
                                                                            @endif
                                                                        </div>
                                                                    
                                                                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="course__member-name ml-20">
                                                                                    <h5 style="text-transform: capitalize">{{ $item->siswa->siswa_name }}</h5>
                                                                                    <span>rata-rata nilai : {{ $item->ranking_nilai }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                            <div class="course__member-info pl-45">
                                                                                <h5>
                                                                                    @if (strlen($item->ranking_rank) == 1)
                                                                                        : 0{{ $item->ranking_rank }} -
                                                                                    @else
                                                                                        : {{ $item->ranking_rank }} -
                                                                                    @endif 
                                                                                </h5>
                                                                                <span>ranking</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="course__member-name ml-20">
                                                                                <h5 style="text-transform: capitalize">Data Ranking / Peringkat Belum Diterbitkan</h5>
                                                                                <span>hubungi admin untuk update data ranking kelas</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="member" role="tabpanel"
                                        aria-labelledby="member-tab">
                                        <div class="course__curriculum">
                                            <div class="accordion" id="course__accordion">
                                                <div class="accordion-item mb-20">
                                                    <h2 class="accordion-header" id="week-01">
                                                        <button class="accordion-button"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#x1"
                                                            aria-expanded="true" aria-controls="week-01-content">
                                                            UTS SEMESTER 02
                                                        </button>
                                                    </h2>

                                                    <div id="x1"
                                                        class="accordion-collapse collapse show"
                                                        aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                                        <div class="accordion-body">
                                                            @foreach ($kelas->siswa as $key=> $item)
                                                                <div
                                                                    class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                    <div class="course__comment-thumb float-start">
                                                                        @if ($item->detailsiswa)
                                                                            <img src="{{ asset('siswa_image/'.$item->detailsiswa->img_siswa) }}" alt="">    
                                                                            @else
                                                                            <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                            alt="">
                                                                        @endif
                                                                    </div>
                                                                   
                                                                    <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="course__member-name ml-20">
                                                                                <h5 style="text-transform: capitalize">{{ $item->siswa_name }}</h5>
                                                                                <span>rata-rata nilai UTS SEMESTER 02</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                        <div class="course__member-info pl-45">
                                                                            <h5>
                                                                                AVG : {{ round($avg2[$key]) }}
                                                                            </h5>
                                                                            <span>rata-rata</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion" id="course__accordion">
                                                <div class="accordion-item mb-20">
                                                    <h2 class="accordion-header" id="week-02">
                                                        <button class="accordion-button text-capitalize"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#x2"
                                                            aria-expanded="true" aria-controls="week-02-content">
                                                            Peringkat
                                                        </button>
                                                    </h2>

                                                    <div id="x2"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="week-02" data-bs-parent="#course__accordion">
                                                        <div class="accordion-body">
                                                            @if ($rank_uts2->count() > 0)
                                                                @foreach ($rank_uts2 as $key=> $item)
                                                                    <div
                                                                        class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                        <div class="course__comment-thumb float-start">
                                                                            @if ($item->siswa->detailsiswa)
                                                                                <img src="{{ asset('siswa_image/'.$item->siswa->detailsiswa->img_siswa) }}" alt="">    
                                                                                @else
                                                                                <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                                alt="">
                                                                            @endif
                                                                        </div>
                                                                    
                                                                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12">
                                                                            <div class="d-flex align-items-center">
                                                                                <div class="course__member-name ml-20">
                                                                                    <h5 style="text-transform: capitalize">{{ $item->siswa->siswa_name }}</h5>
                                                                                    <span>rata-rata nilai : {{ $item->ranking_nilai }}</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                                            <div class="course__member-info pl-45">
                                                                                <h5>
                                                                                    @if (strlen($item->ranking_rank) == 1)
                                                                                        : 0{{ $item->ranking_rank }} -
                                                                                    @else
                                                                                        : {{ $item->ranking_rank }} -
                                                                                    @endif 
                                                                                </h5>
                                                                                <span>ranking</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                                        <div class="d-flex align-items-center">
                                                                            <div class="course__member-name ml-20">
                                                                                <h5 style="text-transform: capitalize">Data Ranking / Peringkat Belum Diterbitkan</h5>
                                                                                <span>hubungi admin untuk update data ranking kelas</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    
@endsection
