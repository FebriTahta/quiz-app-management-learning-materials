@extends('fe_layouts.master2')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css">
@endsection

@section('fe_content')
    <style>
        @media only screen and (max-width: 600px) {
            .buton {
                margin-top: 10px !important;
                border-top: solid 1px;
            }
        }

        @media only screen and (min-width: 601px) {
            .buton {
                
            }
        }
    </style>
    <main>
        <!-- instructor details area start -->
        <section class="teacher__area pt-50 pb-50">
            <div class="page__title-shape">
                <img class="page-title-shape-5 d-none d-sm-block"
                    src="{{ asset('fe_assets/assets/img/page-title/page-title-shape-1.png') }}" alt="">

                <img class="page-title-shape-3" src="{{ asset('fe_assets/assets/img/page-title/page-title-shape-3.png') }}"
                    alt="">
                <img class="page-title-shape-7" src="{{ asset('fe_assets/assets/img/page-title/page-title-shape-4.png') }}"
                    alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 pb-20">
                        <div class="teacher__details-thumb p-relative w-img">
                            <div class="blocl">
                                @if (auth()->user()->guru->detailguru)
                                <img src="{{ asset('guru_image/'.auth()->user()->guru->detailguru->img_guru) }}" alt="">
                                @else
                                <img src="{{ asset('fe_assets/assets/img/teacer-details-1.jpg') }}" alt="">
                                @endif
                            </div>
                            <div class="events__sidebar-widget white-bg">
                                <div class="events__sponsor">
                                    <h3 class="events__sponsor-title">Overview</h3>
                                    <div class="events__sponsor-info">
                                        <h3>Guru : {{ $mapelmaster->guru->guru_name }}</h3>
                                        <h4><span>Materi pada matapelajaran ini meliputi : {{ $mapelmaster->docs_count }}
                                                dokumen, 
                                                {{ $mapelmaster->vids_count }} video,
                                                {{ $mapelmaster->ujian_count }} exam dan {{ $mapelmaster->tugas_count }} tugas</span></h4>
                                        <hr>
                                        <a href="/periksa-jawaban-uraian/{{ Crypt::encrypt($mapelmaster->id) }}">
                                            <i class="fa fa-bell" style="color: red"></i>
                                            <i class="fa fa-edit"></i><span> nilai uraian</span>
                                        </a>
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
                                <div class="teacher__info">
                                    <h4 class="text-capitalize">{{ $mapelmaster->mapel->mapel_name }}</h4>
                                    <span>" {{ $mapelmaster->kelas->angkatan->angkatan_name }} "
                                        {{ $mapelmaster->kelas->angkatan->tingkat->tingkat_name }}
                                        {{ $mapelmaster->kelas->jurusan->jurusan_name }}
                                        {{ $mapelmaster->kelas->kelas_name }}</span>
                                </div>
                            </div>

                            <div class="teacher_bio" style="margin-top: 10px">
                                <div class="course__tab-2 mb-45">
                                    <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="curriculum-tab" data-bs-toggle="tab"
                                                data-bs-target="#curriculum" type="button" role="tab"
                                                aria-controls="curriculum" aria-selected="false"> <i
                                                    class="icon_book_alt"></i>
                                                <span>Materi </span> </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                                data-bs-target="#review" type="button" role="tab"
                                                aria-controls="review" aria-selected="false"> <i class="icon_star_alt"></i>
                                                <span>Nilai</span>
                                            </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="member-tab" data-bs-toggle="tab"
                                                data-bs-target="#member" type="button" role="tab"
                                                aria-controls="member" aria-selected="false"> <i class="fal fa-user"></i>
                                                <span>Siswa</span> </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link " id="description-tab" data-bs-toggle="tab"
                                                data-bs-target="#description" type="button" role="tab"
                                                aria-controls="description" aria-selected="true"> <i
                                                    class="icon_ribbon_alt"></i>
                                                <span>Tugas</span> </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course__tab-content mb-95">
                                <div class="tab-content" id="courseTabContent">
                                    <div class="tab-pane fade" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="course__description">
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modaltugas"><i class="fa fa-plus"></i>
                                                Tugas</button>
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#modaladddocstugas"><i class="fa fa-book"></i>
                                                Dokumen</button>
                                            @if ($mapelmaster->tugas_count < 1)
                                                <div class="accordion" style="margin-top: 20px">
                                                    <h3 class="mt-3" style="color: rgb(248, 134, 134)">
                                                        Belum ada tugas yang tersedia
                                                    </h3>
                                                </div>
                                            @else
                                                @foreach ($mapelmaster->tugas as $key=> $item)
                                                    <div class="accordion" id="course__accordion{{ $key }}" style="margin-top: 20px">
                                                        <div class="accordion-item mb-20">
                                                            <h2 class="accordion-header" id="week-01">
                                                                <button class="accordion-button text-capitalize" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#x{{ $key }}"
                                                                    aria-expanded="true" aria-controls="week-01-content">
                                                                    Task : {{ $item->tugas_name }}
                                                                </button>
                                                            </h2>

                                                            <div id="x{{ $key }}"
                                                            @if ($key == '0')
                                                            class="accordion-collapse collapse show"    
                                                            @else
                                                            class="accordion-collapse collapse"
                                                            @endif 
                                                            aria-labelledby="week-01" data-bs-parent="#course__accordion{{ $key }}">
                                                                <div class="accordion-body">
                                                                    <div
                                                                        class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                        <div class="course__curriculum-info">
                                                                            <p>Deskripsi :</p>
                                                                            <h3> <span>{{ $item->tugas_desc }}</span></h3><br>
                                                                            <span>Keterangan : 
                                                                                @if ($item->jawabtugas->count() < 1)
                                                                                   Belum dikerjakan
                                                                                @else
                                                                                   Dikerjakan {{ $item->jawabtugas->count() }} siswa
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                        <div class="course__curriculum-meta">
                                                                            
                                                                            <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                                                            data-bs-target="#modaltugassiswa" data-tugas_name="{{ $item->tugas_name }}"
                                                                            data-tugas_id="{{ $item->id }}" data-mapelmaster_id="{{ $mapelmaster_id }}"
                                                                             data-kelas_id="{{ $kelas_id }}">periksa</button>
                                                                            {{-- <a href="#_" data-bs-toggle="modal"
                                                                                data-bs-target="#modalhapusvideo" 
                                                                                class="btn btn-sm btn-danger text-white">hapus</a> --}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="accordion-body">
                                                                    @if ($item->docstugas->count() < 1)
                                                                    <div
                                                                        class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                        <div class="course__curriculum-info">
                                                                            <h3 class="text-damger">belum ada dokumen tugas</h3>
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                        @foreach ($item->docstugas as $dt)
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
                                                                                    <polyline class="st0"
                                                                                        points="10,9 9,9 8,9 " />
                                                                                </svg>
                                                                                <h3> <span>{{ $dt->docs_name }}</span></h3>
                                                                            </div>
                                                                            <div class="course__curriculum-meta">
                                                                                <a href="#_" data-bs-toggle="modal"
                                                                                    data-bs-target="#modalhapusdocstugas" data-id={{ $dt->id }} data-docs_name={{ $dt->docs_name }}
                                                                                    class="text-danger">hapus</a> |
                                                                                <a href="/download-docstugas/{{ $dt->id }}" class="text-primary">unduh</a>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @endif
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
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
                                                    data-bs-target="#modaladddocs"><i class="fa fa-book"></i>
                                                    Dokumen</button>
                                                <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                                    data-bs-target="#modaladdvids"><i class="fa fa-play"></i>
                                                    Video</button>
                                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                                    data-bs-target="#modaladdmateri4"><i class="fa fa-pencil"></i>
                                                    Ujian</button>
                                            </div>
                                            @if ($mapelmaster->materi_count < 1)
                                                <div class="accordion" style="margin-top: 20px; background-color: rgb(187, 187, 187); border-radius: 10px">
                                                    <h5 style="color: white; padding: 15px">
                                                        Belum ada materi yang tersedia pada pelajaran ini
                                                    </h5>
                                                </div>
                                            @endif

                                            @foreach ($mapelmaster->materi as $key => $item)
                                                <div class="accordion" id="course__accordion">
                                                    <div class="accordion-item mb-20">
                                                        <h2 class="accordion-header" id="week-01">
                                                            <button class="accordion-button "
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#x{{ $key }}"
                                                                aria-expanded="true" aria-controls="week-01-content">
                                                                <i class="fa fa-book" style="color: rgb(90, 120, 252)"></i> <span class="text-uppercase ml-20" style="font-weight: 500; font-size: 14px"> - {{ $item->materi_name }}</span>
                                                            </button>
                                                        </h2>
                                                        <div class="navigasi" style="margin-bottom:10px; margin-top: 10px">
                                                            <button class="btn btn-sm btn-danger" style="line-height: 15px" data-bs-toggle="modal"
                                                            data-bs-target="#modalhapusmateri" data-id="{{ $item->id }}" data-materi_name="{{ $item->materi_name }}"
                                                            >Hapus</button>
                                                            <button class="btn btn-sm btn-primary" style="line-height: 15px" data-bs-toggle="modal"
                                                            data-bs-target="#modalupdatemateri" data-id="{{ $item->id }}" data-materi_name="{{ $item->materi_name }}">Update</button>
                                                        </div>
                                                        <div id="x{{ $key }}"
                                                            @if ($key == 0) class="accordion-collapse collapse show"
                                                            @else
                                                        class="accordion-collapse collapse" @endif
                                                            aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                                            <div class="accordion-body">
                                                                @if ($item->vids->count() == 0 && $item->docs->count() == 0 && $item->ujian->count() == 0)
                                                                    <div 
                                                                        class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                        <div class="course__curriculum-info">
                                                                            <svg class="document" viewBox="0 0 24 24"
                                                                                style="color: red">
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
                                                                                <polyline class="st0"
                                                                                    points="10,9 9,9 8,9 " />
                                                                            </svg>
                                                                            <h3 class="course__curriculum-meta" style="font-size: 12px"> <span
                                                                                    class="question">Belum ada konten pada
                                                                                    materi ini</span></h3>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                @foreach ($item->vids as $v)
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
                                                                                <polyline class="st0"
                                                                                    points="10,9 9,9 8,9 " />
                                                                            </svg>
                                                                            <h3> <span  style="font-size: 14px">{{ $v->vids_name }}</span></h3>
                                                                        </div>
                                                                        <div class="course__curriculum-meta buton">
                                                                            <button data-bs-toggle="modal" 
                                                                            data-bs-target="#modalplayvids"
                                                                            data-src="{{ $v->vids_link }}"
                                                                            data-detail="/materi-video-comment/{{ Crypt::encrypt($v->id) }}"
                                                                            class="btn btn-sm btn-info text-white" style="line-height: 12px;font-size:12px"><i class="fa fa-play"></i> Tonton </button>
                                                                            <button class="btn btn-sm btn-danger" style="line-height: 12px; font-size: 12px" data-bs-toggle="modal" data-bs-target="#modalhapusvideo" data-id="{{ $v->id }}" data-vids_name="{{ $v->vids_name }}">
                                                                            <i class="fa fa-trash"></i> Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                @foreach ($item->docs as $d)
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
                                                                                <polyline class="st0"
                                                                                    points="10,9 9,9 8,9 " />
                                                                            </svg>
                                                                            <h3> <span  style="font-size: 14px">{{ $d->docs_name }} </span></h3>
                                                                        </div>
                                                                        <div class="course__curriculum-meta buton"  >
                                                                            <button class="btn btn-sm btn-primary" style="line-height: 12px; font-size:12px" 
                                                                            data-bs-toggle="modal"
                                                                                data-bs-target="#modaldownloaddocs"
                                                                                data-id="{{ $d->id }}"
                                                                                data-docs_name="{{ $d->docs_name }}"
                                                                                data-docs_desc="{{ $d->docs_desc }}"
                                                                                class="text-primary"
                                                                            ><i class="fa fa-download" style="font-size: 12px"></i> Unduh</button>
                                                                            <button class="btn btn-sm btn-danger" style="line-height: 12px; font-size: 12px" data-bs-toggle="modal"  data-bs-target="#modalhapusdocs"
                                                                            data-id="{{ $d->id }}" data-docs_name="{{ $d->docs_name }}">
                                                                                <i class="fa fa-trash"></i> Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                                @foreach ($item->ujian as $u)
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
                                                                                <polyline class="st0"
                                                                                    points="10,9 9,9 8,9 " />
                                                                            </svg>
                                                                            <h3> <span style="font-size:14px">{{ $u->ujian_name }}</span></h3>
                                                                        </div>
                                                                        <div class="course__curriculum-meta buton">
                                                                            <a href="/prev-quiz/{{$mapelmaster->id}}/{{ $item->id }}/{{ $u->id }}" class="btn btn-success btn-sm" style="line-height: 12px; font-size: 12px"><i class="fa fa-eye"></i> Preview Soal</a>
                                                                            <button data-bs-toggle="modal"
                                                                            data-bs-target="#modalhapusquiz" data-id="{{ $u->id }}" data-ujian_name="{{ $u->ujian_name }}" class="btn btn-sm btn-danger" style="line-height: 12px; font-size: 12px"><i class="fa fa-trash"></i> Hapus</button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane  fade" id="review" role="tabpanel"
                                        aria-labelledby="review-tab">
                                        <div class="course__review">
                                            @foreach ($mapelmaster->materi as $key => $item)
                                                <div class="accordion" id="course__accordion">
                                                    <div class="accordion-item mb-20">
                                                        <h2 class="accordion-header" id="week-01" >
                                                            <button class="accordion-button text-capitalize"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#x{{ $key }}"
                                                                aria-expanded="true" aria-controls="week-01-content">
                                                                {{ $item->materi_name }}
                                                            </button>
                                                        </h2>

                                                        <div id="x{{ $key }}"
                                                            @if ($key == 0) class="accordion-collapse collapse show"
                                                        @else
                                                        class="accordion-collapse collapse" @endif
                                                            aria-labelledby="week-01" data-bs-parent="#course__accordion">
                                                            <div class="accordion-body">
                                                                @foreach ($item->ujian as $u)
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
                                                                                <polyline class="st0"
                                                                                    points="10,9 9,9 8,9 " />
                                                                            </svg>
                                                                            <h3> <span>{{ $u->ujian_name }}</span></h3>
                                                                        </div>
                                                                        <div class="course__curriculum-meta">
                                                                            <a href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#modalnilaisiswa" data-ujian_name="{{ $u->ujian_name }}"
                                                                                data-mapelmaster_id="{{ $mapelmaster_id }}" data-kelas_id="{{ $kelas_id }}" data-ujian_id="{{ $u->id }}"
                                                                                class="text-success"><i class="fa fa-eye"
                                                                                    style="font-size: 12px"></i> Lihat
                                                                                Nilai</a>
                                                                        </div>
                                                                    </div>
                                                                @endforeach

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="member" role="tabpanel"
                                        aria-labelledby="member-tab">
                                        <div class="course__member mb-45">
                                            @foreach ($mapelmaster->kelas->siswa as $item)
                                                <div class="course__member-item">
                                                    <div class="row align-items-center">

                                                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-9">
                                                            <div class="course__member-thumb d-flex align-items-center">
                                                                @if ($item->detailsiswa)
                                                                <img src="{{ asset('siswa_image/'.$item->detailsiswa->img_siswa) }}" alt="">    
                                                                @else
                                                                <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                alt="">
                                                                @endif
                                                                <div class="course__member-name ml-20">
                                                                    <h5>{{ $item->siswa_name }}</h5>
                                                                    <span>rata-rata nilai berdasarkan total ujian yang dikerjakan</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-4">
                                                            <div class="course__member-info pl-45">
                                                                @php
                                                                $ujian = App\Models\Ujian::where('mapelmaster_id', $mapelmaster->id)->get();
                                                                
                                                                $nilai = [];
                                                                foreach ($ujian as $key => $value) {
                                                                    # code...
                                                                    $jawabanku = App\Models\Jawabanmulti::where('mapelmaster_id', $mapelmaster->id)
                                                                                                        ->where('ujian_id', $value->id)
                                                                                                        ->where('siswa_id', $item->id)->sum('jawabanku');
                                                                    if ($jawabanku > 0) {
                                                                        # code...
                                                                        $nilai[] = ($jawabanku / App\Models\Jawabanmulti::where('ujian_id', $value->id)->where('siswa_id', $item->id)->count()) * 100;
                                                                    }else {
                                                                        # code...
                                                                        $nilai[] = 0;
                                                                    }
                                                                }
                                                                $sum = array_sum($nilai);
                                                                $avg = '';
                                                                if ($sum > 0) {
                                                                    # code...
                                                                    $avg = round($sum / $ujian->count());
                                                                }else {
                                                                    # code...
                                                                    $avg = 0;
                                                                }
                                                                @endphp 
                                                                <h5>
                                                                    AVG : {{ $avg }}
                                                                </h5>
                                                                <span>rata-rata</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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

    <div class="modal fade" id="modalhapusmateri" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" style="font-size: 16px; color:white">HAPUS MATERI <span id="header_ujian_name" class="text-uppercase"></span></h4>
                </div>
                <form id="formhapusmateri">@csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="id" id="id" required>
                        <code>Materi video, dokumen & quiz / ujian akan dihapus dari sistem.</code><br>
                        <code style="line-height: 10px">Yakin akan menghapus materi tersebut ?</code>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodalhapusmateri" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-sm btn-danger" value="Hapus" id="btnhapusmateri">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalupdatemateri" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPDATE MATERI <span id="header_ujian_name" class="text-uppercase"></span></h4>
                </div>
                <form id="formupdatemateri">@csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" value="id" id="id" required>
                        <input type="text" class="form-control" name="materi_name" id="materi_name" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodalupdatemateri" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-sm btn-primary" value="Update" id="btnupdatemateri">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalnilaisiswa" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">NILAI SISWA <span id="header_ujian_name" class="text-uppercase"></span></h4>
                </div>
                <div class="modal-body">
                    <table id="example"
                    class="display responsive nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Nama Siswa</th>
                                <th style="width: 10%">Nilai</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            {{-- data --}}
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closemodalnilaisiswa" class="btn btn-sm btn-default"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaltugassiswa" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">TUGAS SISWA : <span id="header_tugas_name" class="text-uppercase"></span></h4>
                </div>
                <div class="modal-body">
                    <table id="example2"
                    class="display responsive nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Nama Siswa</th>
                                <th>Tanggal</th>
                                <th style="width: 10%">Unduh</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            {{-- data --}}
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closemodaltugassiswa" class="btn btn-sm btn-default"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalhapusvideo" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" style="font-size: 16px; color:white">HAPUS VIDEO</h4>
                </div>
                <form id="formremovevids"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <div class="col-md-12 col-12" id="block-new-jurusan" style="padding-right: 5px">
                                <p class="text-danger">Anda yakin akan menghapus video tersebut ?</p>
                                <h5 id="vids_name" class="text-danger"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btncloseremovevids" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnremovevids" class="btn btn-sm btn-danger" value="Hapus">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalhapusquiz" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" style="font-size: 16px; color:white">HAPUS QUIZ</h4>
                </div>
                <form id="formremovequiz"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <div class="col-md-12 col-12" id="block-new-jurusan" style="padding-right: 5px">
                                <p class="text-danger">Anda yakin akan menghapus Quiz  tersebut ?</p>
                                <h5 id="ujian_name"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btncloseremovequiz" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnremovequiz" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalhapusdocs" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title" style="font-size: 16px; color:white">HAPUS DOCUMENT</h4>
                </div>
                <form id="formremovedocs"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <div class="col-md-12 col-12" id="block-new-jurusan" style="padding-right: 5px">
                                <p class="text-danger">Anda yakin akan menghapus dokumen tersebut ?</p>
                                <h5 id="docs_name"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closehapusdocs" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnhapusdocs" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalhapusdocstugas" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title text-uppercase" style="font-size: 16px; color:white">HAPUS DOCUMENT tugas</h4>
                </div>
                <form id="formremovedocstugas"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <div class="col-md-12 col-12" id="block-new-jurusan" style="padding-right: 5px">
                                <p class="text-danger">Anda yakin akan menghapus dokumen tugas tersebut ?</p>
                                <h5 id="docstugas_name"></h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closehapusdocstugas" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnhapusdocstugas" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                        <button type="button" id="closemodalmateri" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnadd" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaltugas" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">TUGAS BARU</h4>
                </div>
                <form id="add_tugas_siswa"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" name="mapelmaster_id"
                                    value="{{ $mapelmaster->id }}">
                                <input type="hidden" class="form-control" name="guru_id"
                                    value="{{ auth()->user()->guru->id }}">
                                <input type="hidden" class="form-control" name="kelas_id"
                                    value="{{ $mapelmaster->kelas->id }}">
                                <input type="hidden" class="form-control" name="uploader_nip"
                                    value="{{ auth()->user()->guru->guru_nip }}">
                                <input type="text" placeholder="judul tugas" name="tugas_name"
                                    class="form-control mb-3" id="tugas_name" required>
                                <textarea name="tugas_desc" id="tugas_desc" cols="10" rows="5" placeholder="deskripsi tugas"
                                    class="form-control mb-3" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodaltugas" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnaddtugas" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladddocstugas" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">DOKUMEN TUGAS BARU.</h4>
                </div>
                <form id="formadddocstugas" method="POST"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="mapelmaster_id" value="{{ $mapelmaster_id }}">
                                    <select name="tugas_id" id="tugas_id" required class="form-control mb-3">
                                        @php
                                            $tugass = App\Models\Tugas::where('mapelmaster_id', $mapelmaster_id)->get();
                                        @endphp
                                        
                                        <option value="">:: Tugas ::</option>
                                        @foreach ($tugass as $item)
                                            <option value="{{ $item->id }}">{{ $item->tugas_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="docs_name" id="docs_name" class="form-control">
                                </div>
                                <div class="form-group" style="margin-top: 20px">
                                    <input type="file"  name="docs_file" id="docs_file" 
                                    accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf,.rar"
                                    {{-- accept=".doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" --}}
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodaldocstugas" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnadddocstugas" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladdvids" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">MATERI VIDEO BARU</h4>
                </div>
                <form id="formaddvids"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-12" id="block-new-jurusan" style="padding-right: 5px">
                                <div class="form-group mb-20">
                                    <input type="hidden" class="form-control" value="{{ $mapelmaster->id }}"
                                        name="mapelmaster_id">
                                    <select name="materi_id" id="materi_id" required class="form-control">
                                        <option value="">:: Materi ::</option>
                                        @foreach ($mapelmaster->materi as $item)
                                            <option value="{{ $item->id }}">{{ $item->materi_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-20">
                                    <input type="text" class="form-control" name="vids_name"
                                        placeholder="Nama Video">
                                </div>
                                <div class="form-group mb-20">
                                    <input type="text" class="form-control" name="vids_link"
                                        placeholder="Link Video">
                                </div>
                                <div class="form-group mb-20">
                                    <textarea name="vids_desc" cols="30" rows="3" class="form-control" placeholder="Deskripsi Video"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodalvids" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnaddvids" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalplayvids" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="ratio ratio-16x9">
                            <div class="form-group">
                                <iframe width="100%" height="100%" class="embed-responsive-item" src=""
                                    id="video" frameborder="0" allowscriptaccess="always" allow="autoplay"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closemodalplayvids" class="btn btn-sm btn-secondary"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaldownloaddocs" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-group">
                        <h5 class="text-uppercase" id="docs_name"></h5>
                        <p id="docs_desc"></p>
                    </div>
                    <div class="form-group">
                        <a href="" id="download" class="btn btn-sm btn-outline-primary"><i
                                class="fa fa-download"></i> unduh</a>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closemodaldownloaddocs" class="btn btn-sm btn-secondary"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladddocs" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">MATERI DOKUMEN BARU</h4>
                </div>
                <form id="formadddocs"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-12" id="block-new-jurusan" style="padding-right: 5px">
                                <div class="form-group mb-20">
                                    <input type="hidden" class="form-control" value="{{ $mapelmaster->id }}"
                                        name="mapelmaster_id">
                                    <select name="materi_id" id="materi_id" required class="form-control">
                                        <option value="">:: Materi ::</option>
                                        @foreach ($mapelmaster->materi as $item)
                                            <option value="{{ $item->id }}">{{ $item->materi_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-20">
                                    <input type="text" class="form-control" name="docs_name"
                                        placeholder="Nama Dokumen">
                                </div>
                                <div class="form-group mb-20">
                                    <input type="file" class="form-control" accept=".xlsx,.docs,.doc,.pdf,.csv,.ppt,.pptx,.rar"
                                        name="docs_file" placeholder="Source Dokumen">
                                </div>
                                <div class="form-group mb-20">
                                    <textarea name="docs_desc" cols="30" rows="3" class="form-control" placeholder="Deskripsi Dokumen"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodaldocs" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnadddocs" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladdmateri4" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UJIAN BARU</h4>
                </div>
                <form id="formaddmateri4"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                {{-- <a href="#" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#modalcreateujian"><i class="fa fa-plus"></i>
                                    Ujian</a> --}}
                                <a href="#" class="btn btn-sm btn-outline-primary" style="width: 100%"
                                    id="showtemplateujian" data-bs-toggle="modal" data-bs-target="#modaltemplateujian"><i
                                        class="fa fa-book"></i> Download Template</a>
                            </div>
                            <div class="col-md-6 col-6">
                                <a href="#" class="btn btn-sm btn-outline-success" style="width: 100%"
                                    data-bs-toggle="modal" data-bs-target="#modalimportquiz"><i class="fa fa-upload"></i>
                                    Import From Template</a>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodalmateri4" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaltemplateujian" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">JUMLAH SOAL BARU</h4>
                </div>
                <form id="formaddujian"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" name="number_soal" id="number_soal"
                                    placeholder="Jumlah soal" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodaladdujian" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <a href="#" class="btn btn-sm btn-outline-primary" id="btnaddujian">Download</a>
                        {{-- <input type="submit" id="btnaddujian" class="btn btn-sm btn-primary" value="Submit"> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalimportquiz" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">IMPORT DATA QUIZ</h4>
                </div>
                <form action="/admin-import-data-quiz" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="mapelmaster_id"
                                value="{{ $mapelmaster->id }}">
                            <select name="materi_id" id="materi_id" required class="form-control mb-3">
                                <option value="">:: Ujian ::</option>
                                @foreach ($mapelmaster->materi as $materi)
                                    <option value="{{ $materi->id }}">{{ $materi->materi_name }}</option>
                                @endforeach
                            </select>
                            <div class="form-group mb-20">
                                <input class="form-control" id="ujian_name" name="ujian_name" placeholder="Nama Ujian">
                            </div>
                            <div class="form-group mb-20">
                                <input class="form-control" id="ujian_lamapengerjaan" name="ujian_lamapengerjaan"
                                    placeholder="Lama pengerjaan (in minute)">
                            </div>
                            <div class="form-group mb-20">
                                <input class="form-control" type="datetime-local" id="ujian_datetimestart"
                                    name="ujian_datetimestart" placeholder="Waktu mulai">
                            </div>
                            <div class="form-group mb-20">
                                <input class="form-control" type="datetime-local" id="ujian_datetimeend"
                                    name="ujian_datetimeend" placeholder="Waktu berakhir">
                            </div>
                            <label for="file" style="font-size: 14px">Import Excel File Template Quiz</label>
                            <input type="file" class="form-control" style="border: none" name="file"
                                id="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnclosemodalquiz" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnimportsiswa" class="btn btn-sm btn-primary" value="Import">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalcreateujian" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UJIAN BARU</h4>
                </div>
                <form id="add_ujian"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" name="mapelmaster_id"
                                    value="{{ $mapelmaster->id }}">
                                <select name="materi_id" id="materi_id" required class="form-control mb-3">
                                    <option value="">:: Ujian ::</option>
                                    @foreach ($mapelmaster->materi as $materi)
                                        <option value="{{ $materi->id }}">{{ $item->materi_name }}</option>
                                    @endforeach
                                </select>
                                <div class="form-group mb-20">
                                    <input class="form-control" id="ujian_name" name="ujian_name"
                                        placeholder="Nama Ujian">
                                </div>
                                <div class="form-group mb-20">
                                    <input class="form-control" id="ujian_lamapengerjaan" name="ujian_lamapengerjaan"
                                        placeholder="Lama pengerjaan (in minute)">
                                </div>
                                <div class="form-group mb-20">
                                    <input class="form-control" type="datetime-local" id="ujian_datetimestart"
                                        name="ujian_datetimestart" placeholder="Waktu mulai">
                                </div>
                                <div class="form-group mb-20">
                                    <input class="form-control" type="datetime-local" id="ujian_datetimeend"
                                        name="ujian_datetimeend" placeholder="Waktu berakhir">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodalcreateujian" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnaddujian" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>

    <script>
        
        $('#closemodalnilaisiswa').on('click', function() {
            $('#modalnilaisiswa').modal('hide');
        })
        $('#closemodaltugassiswa').on('click', function() {
            $('#modaltugassiswa').modal('hide');
        })
        $('#closemodalmateri').on('click', function() {
            $('#modaladdmateri').modal('hide');
        })
        $('#closemodalvids').on('click', function() {
            $('#modaladdvids').modal('hide');
        })
        $('#closemodaldocs').on('click', function() {
            $('#modaladddocs').modal('hide');
        })
        $('#btnclosemodalquiz').on('click', function() {
            $('#modalimportquiz').modal('hide');
        })

        $('#btncloseremovequiz').on('click', function() {
            $('#modalhapusquiz').modal('hide');
        })

        $('#closemodalhapusmateri').on('click', function() {
            $('#modalhapusmateri').modal('hide');
        })

        $('#closemodalupdatemateri').on('click', function() {
            $('#modalupdatemateri').modal('hide');
        })

        $('#modalupdatemateri').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var materi_name = button.data('materi_name')
            var modal = $(this)
            modal.find('.modal-body #materi_name').val(materi_name);
            modal.find('.modal-body #id').val(id);
        })

        $('#modalhapusquiz').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var ujian_name = button.data('ujian_name')
            var modal = $(this)
            modal.find('.modal-body #ujian_name').html(ujian_name);
            modal.find('.modal-body #id').val(id);
        })

        $('#modalhapusmateri').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })

        $('#closemodaldownloaddocs').on('click', function() {
            $('#modaldownloaddocs').modal('hide');
        })
        $('#modaldownloaddocs').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var docs_name = button.data('docs_name')
            var docs_desc = button.data('docs_desc')
            var modal = $(this)
            $("#download").attr("href", '/download-docs/' + id);
            modal.find('.modal-body #docs_name').html(docs_name);
            modal.find('.modal-body #docs_desc').html(docs_desc);
        })

        $('#modaltugassiswa').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var tugas_id = button.data('tugas_id')
            var mapelmaster_id = button.data('mapelmaster_id')
            var kelas_id = button.data('kelas_id')
            var tugas_name = button.data('tugas_name')
            var modal = $(this)
            
            modal.find('#header_tugas_name').html(tugas_name);
            var oTable = $('#example2').dataTable();
            oTable.fnDraw(false);
            var table = $('#example2').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: '/cek-tugas-siswa/'+mapelmaster_id+'/'+tugas_id,
            columns: [{
                    "width": 10,
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'siswa',
                    name: 'siswa'
                },
                {
                    data: 'tanggal',
                    name: 'tanggal'
                },
                {
                    data: 'unduh',
                    name: 'unduh'
                },
            ]
        });
        })

        var videoSrc;
        $('#closemodalplayvids').on('click', function() {
            $('#modalplayvids').modal('hide');
            $('#video').attr('src', videoSrc);
        })
        $('#modalplayvids').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            videoSrc = button.data('src')
            var detailvids = button.data('src')
            $('#video').attr('src', videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
            $('#detailvids').attr('src', detailvids);
        })
        $('#closemodalmateri4').on('click', function() {
            $('#modaladdmateri4').modal('hide');
        })

        $("#showtemplateujian").on('click', function() {
            $('#modaladdmateri4').modal('hide');
        })
        $('#btncloseremovevids').on('click', function () {
            $('#modalhapusvideo').modal('hide');
        })

        $('#closehapusdocs').on('click', function () {
            $('#modalhapusdocs').modal('hide');
        })

        $('#closehapusdocstugas').on('click', function () {
            $('#modalhapusdocstugas').modal('hide');
        })


        $('#modalhapusvideo').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var vids_name = button.data('vids_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #vids_name').html(vids_name);
        })

        $('#modalhapusdocs').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var docs_name = button.data('docs_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #docs_name').html(docs_name);
        })

        $('#modalhapusdocstugas').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var docs_name = button.data('docs_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #docstugas_name').html(docs_name);
        })

        $('#btnaddujian').on('click', function() {
            var number_soal;
            number_soal = document.getElementById('number_soal').value;
            var modal = $(this)
            $("#btnaddujian").attr("href", "/guru-download-template-ujian/" + number_soal)
            $('#modaltemplateujian').modal('hide');
        })
        $('#closemodaladdujian').on('click', function() {
            $('#modaltemplateujian').modal('hide');
        })

        $('#modaladdmateri').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var jurusan_name = button.data('jurusan_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #jurusan_name').val(jurusan_name);
        })
        $('#modalnilaisiswa').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var ujian_name = button.data('ujian_name')
            var mapelmaster_id = button.data('mapelmaster_id')
            var kelas_id = button.data('kelas_id')
            var ujian_id = button.data('ujian_id')
            var modal = $(this)
            modal.find('#header_ujian_name').html(ujian_name);
            var url_cek_nilai = '/cek-nilai-siswa/'+kelas_id+'/'+mapelmaster_id+'/'+ujian_id;
            var oTable = $('#example').dataTable();
            oTable.fnDraw(false);
                $.ajax({
                    type: 'GET',
                    url: url_cek_nilai,
                    success: function(response) {
                        if (response.status) {
                            $('#modalnilaisiswa').modal('hide');
                            toastr.error("Belum ada siswa yang mengerjakan");
                            swal({
                                title: "SORRY!",
                                text: "Belum ada siswa yang mengerjakan",
                                type: "error"
                            });
                        }else{
                            var table = $('#example').DataTable({
                                destroy: true,
                                processing: true,
                                serverSide: true,
                                ajax: url_cek_nilai,
                                columns: [{
                                        "width": 10,
                                        "data": null,
                                        "sortable": false,
                                        render: function(data, type, row, meta) {
                                            return meta.row + meta.settings._iDisplayStart + 1;
                                        }
                                    },
                                    {
                                        data: 'siswa_name',
                                        name: 'siswa_name'
                                    },
                                    {
                                        data: 'nilai',
                                        name: 'nilai'
                                    },
                                ]
                            });
                        }

                    }
                });
        })

        $('#closemodaltugas').on('click', function() {
            $('#modaltugas').modal('hide');
        })
        $('#closemodaldocstugas').on('click', function() {
            $('#modaladddocstugas').modal('hide');
        })
        $('#closemodalcreateujian').on('click', function() {
            // alert('a');
            $('#modalcreateujian').modal('hide');
        })

        $('#formremovevids').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/remove-vids",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnremovevids').attr('disabled', 'disabled');
                    $('#btnremovevids').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modalhapusvideo').modal('hide');
                        $("#formremovevids")[0].reset();
                        $('#btnremovevids').val('Submit');
                        $('#btnremovevids').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnremovevids').val('Submit');
                        $('#btnremovevids').attr('disabled', false);
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

        $('#formhapusmateri').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/hapus-materi",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnhapusmateri').attr('disabled', 'disabled');
                    $('#btnhapusmateri').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modalhapusmateri').modal('hide');
                        $("#formhapusmateri")[0].reset();
                        $('#btnhapusmateri').val('Submit');
                        $('#btnhapusmateri').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnhapusmateri').val('Submit');
                        $('#btnhapusmateri').attr('disabled', false);
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

        $('#formupdatemateri').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/update-materi",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnupdatemateri').attr('disabled', 'disabled');
                    $('#btnupdatemateri').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modalupdatemateri').modal('hide');
                        $("#formupdatemateri")[0].reset();
                        $('#btnupdatemateri').val('Update');
                        $('#btnupdatemateri').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnupdatemateri').val('Submit');
                        $('#btnupdatemateri').attr('disabled', false);
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

        $('#formremovequiz').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/remove-quiz",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnremovequiz').attr('disabled', 'disabled');
                    $('#btnremovequiz').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modalhapusquiz').modal('hide');
                        $('#btnremovequiz').val('Remove');
                        $('#btnremovequiz').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnremovequiz').val('Submit');
                        $('#btnremovequiz').attr('disabled', false);
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

        $('#formremovedocs').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/remove-docs",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnhapusdocs').attr('disabled', 'disabled');
                    $('#btnhapusdocs').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modalhapusdocs').modal('hide');
                        $("#formremovedocs")[0].reset();
                        $('#btnhapusdocs').val('Submit');
                        $('#btnhapusdocs').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnhapusdocs').val('Submit');
                        $('#btnhapusdocs').attr('disabled', false);
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

        $('#formremovedocstugas').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/remove-docs-tugas",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnhapusdocstugas').attr('disabled', 'disabled');
                    $('#btnhapusdocstugas').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modalhapusdocstugas').modal('hide');
                        $("#formremovedocstugas")[0].reset();
                        $('#btnhapusdocstugas').val('Submit');
                        $('#btnhapusdocstugas').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnhapusdocstugas').val('Submit');
                        $('#btnhapusdocstugas').attr('disabled', false);
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

        $('#formadddocstugas').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/post-dokumen-tugas-siswa",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnadddocstugas').attr('disabled', 'disabled');
                    $('#btnadddocstugas').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modaladddocstugas').modal('hide');
                        $("#formadddocstugas")[0].reset();
                        $('#btnadddocstugas').val('Submit');
                        $('#btnadddocstugas').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnadddocstugas').val('Submit');
                        $('#btnadddocstugas').attr('disabled', false);
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

        $('#add_tugas_siswa').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/post-tugas-siswa",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnaddtugas').attr('disabled', 'disabled');
                    $('#btnaddtugas').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modaltugas').modal('hide');
                        $("#add_tugas_siswa")[0].reset();
                        $('#btnaddtugas').val('Submit');
                        $('#btnaddtugas').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnaddtugas').val('Submit');
                        $('#btnaddtugas').attr('disabled', false);
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

        $('#formaddvids').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/post-vids",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnaddvids').attr('disabled', 'disabled');
                    $('#btnaddvids').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modaladdvids').modal('hide');
                        $("#formaddvids")[0].reset();
                        $('#btnaddvids').val('Submit');
                        $('#btnaddvids').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnaddvids').val('Submit');
                        $('#btnaddvids').attr('disabled', false);
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

        $('#formadddocs').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/post-docs",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnadddocs').attr('disabled', 'disabled');
                    $('#btnadddocs').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modaladddocs').modal('hide');
                        $("#formadddocs")[0].reset();
                        $('#btnadddocs').val('Submit');
                        $('#btnadddocs').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnadddocs').val('Submit');
                        $('#btnadddocs').attr('disabled', false);
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

        $('#add_ujian').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/ujianStore",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnaddujian').attr('disabled', 'disabled');
                    $('#btnaddujian').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#modalcreateujian').modal('hide');
                        $("#add_tugas_siswa")[0].reset();
                        $('#btnaddujian').val('Submit');
                        $('#btnaddujian').attr('disabled', false);

                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnaddujian').val('Submit');
                        $('#btnaddujian').attr('disabled', false);
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
