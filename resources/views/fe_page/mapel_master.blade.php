@extends('fe_layouts.master2')

@section('fe_content')
    <main>
        <section class="page__title-area pt-50 pb-90">
            <div class="page__title-shape">
                <img class="page-title-shape-5 d-none d-sm-block"
                    src="{{ asset('fe_assets/assets/img/page-title/page-title-shape-1.png') }}" alt="">
                <img class="page-title-shape-7" src="{{ asset('fe_assets/assets/img/page-title/page-title-shape-4.png') }}"
                    alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-8 col-xl-8 col-lg-8" style="margin-bottom: 0">
                        <div class="course__wrapper">
                            <div class="page__title-content">
                                <h5 class="page__title-3">{{ $mapelmaster->kelas->angkatan->angkatan_name }}
                                    {{ $mapelmaster->kelas->angkatan->tingkat->tingkat_name }}
                                    {{ $mapelmaster->kelas->jurusan->jurusan_name }} {{ $mapelmaster->kelas->kelas_name }} :
                                    {{ $mapelmaster->mapel->mapel_name }}
                                </h5>
                            </div>
                            <div class="course__meta-2 d-sm-flex mb-30">
                                <div class="course__teacher-3 d-flex align-items-center mr-70 mb-30">
                                    <div class="course__teacher d-flex align-items-center" style="margin: 0">
                                        <div class="course__teacher-thumb mr-15">
                                            <img src="{{ asset('fe_assets/assets/img/contact/contact-shape-4.png') }}"
                                                alt="">
                                        </div>
                                        <h6 style="margin: 0"><a style="text-transform: capitalize">Me : as
                                                ({{ auth()->user()->role }}) {{ $mapelmaster->guru->guru_name }}</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-4 col-lg-4" style="margin-top: 0">
                        <div class="course__sidebar pl-70 p-relative">
                            <div class="course__shape">
                                <img class="course-dot" src="{{ asset('fe_assets/assets/img/course/course-dot.png') }}"
                                    alt="">
                            </div>
                            <div class="course__sidebar-widget-2 white-bg">
                                <div class="course__video">
                                    <div class="course__video-content">
                                        <ul>
                                            <li class="d-flex align-items-center">
                                                <div class="course__video-icon">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                        y="0px" viewBox="0 0 16 16"
                                                        style="enable-background:new 0 0 16 16;" xml:space="preserve">
                                                        <path class="st0"
                                                            d="M2,6l6-4.7L14,6v7.3c0,0.7-0.6,1.3-1.3,1.3H3.3c-0.7,0-1.3-0.6-1.3-1.3V6z" />
                                                        <polyline class="st0" points="6,14.7 6,8 10,8 10,14.7 " />
                                                    </svg>
                                                </div>
                                                <div class="course__video-info">
                                                    <h5><span>Instructor :</span> {{ $mapelmaster->guru->guru_name }}</h5>
                                                </div>
                                            </li>
                                            <li class="d-flex align-items-center">
                                                <div class="course__video-icon">
                                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                                                        y="0px" viewBox="0 0 24 24"
                                                        style="enable-background:new 0 0 24 24;" xml:space="preserve">

                                                        <path class="st0" d="M4,19.5C4,18.1,5.1,17,6.5,17H20" />
                                                        <path class="st0"
                                                            d="M6.5,2H20v20H6.5C5.1,22,4,20.9,4,19.5v-15C4,3.1,5.1,2,6.5,2z" />
                                                    </svg>
                                                </div>
                                                <div class="course__video-info">
                                                    <h5><span>Dokumen :</span>14</h5>
                                                </div>
                                            </li>

                                            <li class="d-flex align-items-center">
                                                <div class="course__video-icon">
                                                    <svg>
                                                        <path class="st0"
                                                            d="M13.3,14v-1.3c0-1.5-1.2-2.7-2.7-2.7H5.3c-1.5,0-2.7,1.2-2.7,2.7V14" />
                                                        <circle class="st0" cx="8" cy="4.7"
                                                            r="2.7" />
                                                    </svg>
                                                </div>
                                                <div class="course__video-info">
                                                    <h5><span>Anggota :</span>20 Siswa</h5>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- <div class="course__payment mb-35">
                                                         <h3>Payment:</h3>
                                                         <a href="#">
                                                            <img src="assets/img/course/payment/payment-1.png" alt="">
                                                         </a>
                                                      </div> -->
                                    <!-- <div class="course__enroll-btn">
                                                         <a href="contact.html" class="e-btn e-btn-7 w-100">Enroll <i class="far fa-arrow-right"></i></a>
                                                      </div> -->
                                </div>
                            </div>
                            <!-- <div class="course__sidebar-widget-2 white-bg mb-20">
                                                   <div class="course__sidebar-course">
                                                      <h3 class="course__sidebar-title">Related courses</h3>
                                                      <ul>
                                                         <li>
                                                            <div class="course__sm d-flex align-items-center mb-30">
                                                               <div class="course__sm-thumb mr-20">
                                                                  <a href="#">
                                                                     <img src="assets/img/course/sm/course-sm-1.jpg" alt="">
                                                                  </a>
                                                               </div>
                                                               <div class="course__sm-content">
                                                                  <div class="course__sm-rating">
                                                                     <ul>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                     </ul>
                                                                  </div>
                                                                  <h5><a href="#">Development</a></h5>
                                                                  <div class="course__sm-price">
                                                                     <span>$54.00</span>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </li>
                                                         <li>
                                                            <div class="course__sm d-flex align-items-center mb-30">
                                                               <div class="course__sm-thumb mr-20">
                                                                  <a href="#">
                                                                     <img src="assets/img/course/sm/course-sm-2.jpg" alt="">
                                                                  </a>
                                                               </div>
                                                               <div class="course__sm-content">
                                                                  <div class="course__sm-rating">
                                                                     <ul>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                     </ul>
                                                                  </div>
                                                                  <h5><a href="#">Data Science</a></h5>
                                                                  <div class="course__sm-price">
                                                                     <span>$72.00</span>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </li>
                                                         <li>
                                                            <div class="course__sm d-flex align-items-center mb-10">
                                                               <div class="course__sm-thumb mr-20">
                                                                  <a href="#">
                                                                     <img src="assets/img/course/sm/course-sm-3.jpg" alt="">
                                                                  </a>
                                                               </div>
                                                               <div class="course__sm-content">
                                                                  <div class="course__sm-rating">
                                                                     <ul>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                        <li><a href="#"> <i class="icon_star"></i> </a></li>
                                                                     </ul>
                                                                  </div>
                                                                  <h5><a href="#">UX Design</a></h5>
                                                                  <div class="course__sm-price">
                                                                     <span>Free</span>
                                                                  </div>
                                                               </div>
                                                            </div>
                                                         </li>
                                                      </ul>
                                                   </div>
                                                </div> -->
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="course__img w-img mb-30">
                            <!-- <img src="assets/img/course-details-1.jpg" alt=""> -->
                        </div>
                        <div class="course__tab-2 mb-45">
                            <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="curriculum-tab" data-bs-toggle="tab"
                                        data-bs-target="#curriculum" type="button" role="tab"
                                        aria-controls="curriculum" aria-selected="false"> <i class="icon_book_alt"></i>
                                        <span>Materi</span> </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab" aria-controls="review"
                                        aria-selected="false"> <i class="icon_star_alt"></i> <span>Diskusi</span>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="member-tab" data-bs-toggle="tab"
                                        data-bs-target="#member" type="button" role="tab" aria-controls="member"
                                        aria-selected="false"> <i class="fal fa-user"></i> <span>Siswa</span> </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link " id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab"
                                        aria-controls="description" aria-selected="true"> <i class="icon_ribbon_alt"></i>
                                        <span>Deskripsi</span> </button>
                                </li>
                            </ul>
                        </div>
                        <div class="course__tab-content mb-95">
                            <div class="tab-content" id="courseTabContent">
                                <div class="tab-pane fade" id="description" role="tabpanel"
                                    aria-labelledby="description-tab">
                                    <div class="course__description">
                                        <h3>Course Overview</h3>
                                        <p>
                                            Simak &
                                            Pelajari secara seksama materi yang disajikan
                                            dalam mata pelajaran ini untuk menunjang
                                            pemahaman serta nilai ujian.
                                        </p>
                                    </div>
                                </div>
                                <div class="tab-pane fade  show active" id="curriculum" role="tabpanel"
                                    aria-labelledby="curriculum-tab">
                                    <div class="course__curriculum">
                                        <div class="form-group" style="margin-bottom: 20px">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modaladdmateri"><i class="fa fa-plus"></i>
                                                Materi</button>
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#modaladdmateri2"><i class="fa fa-book"></i>
                                                Dokumen</button>
                                            <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                data-bs-target="#modaladdmateri3"><i class="fa fa-play"></i>
                                                Video</button>
                                            <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                                data-bs-target="#modaladdmateri4"><i class="fa fa-pencil"></i>
                                                Ujian</button>
                                        </div>
                                        @if ($materi->count() < 1)
                                            <div class="accordion" style="margin-top: 20px">
                                                <h4 style="color: red">
                                                    Belum ada materi yang tersedia pada pelajaran ini
                                                </h4>
                                            </div>
                                        @endif

                                        @foreach ($materi as $item)
                                            <div class="accordion" id="course__accordion">
                                                <div class="accordion-item mb-50">
                                                    <h2 class="accordion-header" id="week-01">
                                                        <button class="accordion-button text-capitalize" type="button"
                                                            data-bs-toggle="collapse" data-bs-target="#week-01-content"
                                                            aria-expanded="true" aria-controls="week-01-content">
                                                            {{ $item->materi_name }}
                                                        </button>
                                                    </h2>

                                                    <div id="week-01-content" class="accordion-collapse collapse show"
                                                        aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                                        <div class="accordion-body">
                                                            <div
                                                                class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                <div class="course__curriculum-info">
                                                                    <svg class="document" viewBox="0 0 24 24">
                                                                        <path class="st0"
                                                                            d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z" />
                                                                        <polyline class="st0"
                                                                            points="14,2 14,8 20,8 " />
                                                                        <line class="st0" x1="16"
                                                                            y1="13" x2="8"
                                                                            y2="13" />
                                                                        <line class="st0" x1="16"
                                                                            y1="17" x2="8"
                                                                            y2="17" />
                                                                        <polyline class="st0" points="10,9 9,9 8,9 " />
                                                                    </svg>
                                                                    <h3> <span>Ujian:</span> Soal Ujian</h3>
                                                                </div>
                                                                <div class="course__curriculum-meta">
                                                                    <span class="time"> <i class="icon_clock_alt"></i>
                                                                        14
                                                                        minutes</span>
                                                                    <span class="question">Soal Ujan</span>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                <div class="course__curriculum-info">
                                                                    <svg class="document" viewBox="0 0 24 24">
                                                                        <path class="st0"
                                                                            d="M14,2H6C4.9,2,4,2.9,4,4v16c0,1.1,0.9,2,2,2h12c1.1,0,2-0.9,2-2V8L14,2z" />
                                                                        <polyline class="st0"
                                                                            points="14,2 14,8 20,8 " />
                                                                        <line class="st0" x1="16"
                                                                            y1="13" x2="8"
                                                                            y2="13" />
                                                                        <line class="st0" x1="16"
                                                                            y1="17" x2="8"
                                                                            y2="17" />
                                                                        <polyline class="st0" points="10,9 9,9 8,9 " />
                                                                    </svg>
                                                                    <h3> <span>Reading: </span> Ut enim ad minim veniam</h3>
                                                                </div>
                                                                <div class="course__curriculum-meta">
                                                                    <span class="time"> <i class="icon_clock_alt"></i>
                                                                        22
                                                                        minutes</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="tab-pane  fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                                    <div class="course__review">

                                        <div class="course__comment mb-75">
                                            <h3>2 Discuse</h3>

                                            <ul>
                                                <li>
                                                    <div class="course__comment-box ">
                                                        <div class="course__comment-thumb float-start">
                                                            <img src="{{ asset('fe_asset/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                alt="">
                                                        </div>
                                                        <div class="course__comment-content">
                                                            <div class="course__comment-wrapper ml-70 fix">
                                                                <div class="course__comment-info float-start">
                                                                    <h4>Eleanor Fant</h4>
                                                                    <span>July 14, 2022</span>
                                                                </div>

                                                            </div>
                                                            <div class="course__comment-text ml-70">
                                                                <p>Guys ada yang mengerti materi oop ?</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="course__form">
                                            <h3>Write comment</h3>
                                            <div class="course__form-inner">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-xxl-12">
                                                            <div class="course__form-input">
                                                                <div class="course__form-rating">
                                                                    <span>Intan ? tulis sesuatu disini</span>
                                                                </div>
                                                                <textarea placeholder="Tulis disini"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xxl-12">
                                                            <div class="course__form-btn mt-10 mb-55">
                                                                <button type="submit" class="e-btn">Submit
                                                                    Comment</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="member" role="tabpanel" aria-labelledby="member-tab">
                                    <div class="course__member mb-45">
                                        <div class="course__member-item">
                                            <div class="row align-items-center">
                                                <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6">
                                                    <div class="course__member-thumb d-flex align-items-center">
                                                        <img src="{{ asset('fe_assets/assets/img/course/instructor/course-instructor-1.jpg') }}"
                                                            alt="">
                                                        <div class="course__member-name ml-20">
                                                            <h5>Shahnewaz Sakil</h5>
                                                            <span>RPL</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="course__member-info pl-45">
                                                        <h5>70</h5>
                                                        <span>Ujian 1</span>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="course__member-info pl-70">
                                                        <h5>75</h5>
                                                        <span>Ujian 2</span>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="course__member-info pl-85">
                                                        <h5>90</h5>
                                                        <span>Ujian 3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="course__member-item">
                                            <div class="row align-items-center">
                                                <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6">
                                                    <div class="course__member-thumb d-flex align-items-center">
                                                        <img src="{{ asset('fe_assets/assets/img/course/instructor/course-instructor-2.jpg') }}"
                                                            alt="">
                                                        <div class="course__member-name ml-20">
                                                            <h5>Lauren Stamps</h5>
                                                            <span>RPL</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="course__member-info pl-45">
                                                        <h5>50</h5>
                                                        <span>Ujian 1</span>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="course__member-info pl-70">
                                                        <h5>65</h5>
                                                        <span>Ujian 2</span>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="course__member-info pl-85">
                                                        <h5>75</h5>
                                                        <span>Ujian 3</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="course__member-item">
                                            <div class="row align-items-center">
                                                <div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6 ">
                                                    <div class="course__member-thumb d-flex align-items-center">
                                                        <img src="{{ asset('fe_assets/assets/img/course/instructor/course-instructor-3.jpg') }}"
                                                            alt="">
                                                        <div class="course__member-name ml-20">
                                                            <h5>Jonquil Von</h5>
                                                            <span>RPL</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="course__member-info pl-45">
                                                        <h5>80</h5>
                                                        <span>Ujian 1</span>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="course__member-info pl-70">
                                                        <h5>90</h5>
                                                        <span>Ujian 2</span>
                                                    </div>
                                                </div>
                                                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-2 col-4">
                                                    <div class="course__member-info pl-85">
                                                        <h5>65</h5>
                                                        <span>Ujian 3</span>
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

    <div class="modal fade" id="modaladdmateri" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">MATERI BARU</h4>
                </div>
                <form id="formadd"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <div class="col-md-12 col-12" id="block-new-jurusan" style="padding-right: 5px">
                                <input type="hidden" class="form-control" name="mapelmaster_id"
                                    value="{{ $mapelmaster->id }}">
                                <input type="hidden" class="form-control" name="guru_id"
                                    value="{{ auth()->user()->guru->id }}">
                                <input type="hidden" class="form-control" name="kelas_id"
                                    value="{{ $mapelmaster->kelas->id }}">
                                <input type="hidden" class="form-control" name="uploader_nip"
                                    value="{{ auth()->user()->guru->guru_nip }}">
                                <input type="text" style="font-size: 14px" name="materi_name" class="form-control"
                                    placeholder="nama materi">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button> --}}
                        <input type="submit" id="btnadd" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

        })
        $('#modaladdmateri').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var jurusan_name = button.data('jurusan_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #jurusan_name').val(jurusan_name);
        })

        $('#formadd').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/post-materi",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnadd').attr('disabled', 'disabled');
                    $('#btnadd').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modaladdmateri').modal('hide');
                        $("#formadd")[0].reset();
                        $('#btnadd').val('Submit');
                        $('#btnadd').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });

                        reload();

                    } else {
                        $('#btnadd').val('Submit');
                        $('#btnadd').attr('disabled', false);
                        var values = '';
                        jQuery.each(response.message, function(key, value) {
                            values += value + '\n'
                        });
                        swal({
                            title: "Maaf",
                            text: values,
                            type: "error",
                        });
                        toastr.error(values);
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        function reload() {
            location.reload();
        }
    </script>
@endsection
