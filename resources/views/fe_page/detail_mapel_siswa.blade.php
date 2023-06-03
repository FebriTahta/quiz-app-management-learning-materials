@extends('fe_layouts.master2')

@section('fe_content')
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
                                @if (auth()->user()->siswa->detailsiswa)
                                    <img src="{{ asset('siswa_image/'.auth()->user()->siswa->detailsiswa->img_siswa) }}" alt="">    
                                @else
                                    <img src="{{ asset('fe_assets/assets/img/teacer-details-1.jpg') }}" alt="">
                                @endif
                            </div>
                            <div class="events__sidebar-widget white-bg">
                                <div class="events__sponsor">
                                    <h3 class="events__sponsor-title">Name : {{ auth()->user()->siswa->siswa_name }}</h3>
                                    <div class="events__sponsor-info">
                                        <div class="row">
                                            <div class="col-md-6 col-6">
                                                <button style="width: 100%"
                                                    class="btn btn-sm btn-outline-info"
                                                    data-user_id="{{ auth()->user()->id }}" data-bs-toggle="modal"
                                        data-username="{{ auth()->user()->username }}" data-pass="{{ auth()->user()->pass }}"
                                        data-bs-target="#modaluser" >user / pass</button> 
                                            </div>
                                            <div class="col-md-6 col-6">
                                                <button style="width: 100%" class="btn btn-sm btn-outline-info"
                                                data-bs-toggle="modal" data-siswa_id="{{ auth()->user()->siswa->id }}"
                                                data-bs-target="#modalphoto"
                                                >myphoto</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="events__sponsor">
                                    <h3 class="events__sponsor-title">Class Overview</h3>
                                    <div class="events__sponsor-info">
                                        <h3>Guru : {{ $mapelmaster->guru->guru_name }}</h3>
                                        <h4><span>Materi pada matapelajaran ini meliputi : {{ $mapelmaster->docs_count }}
                                                dokumen {{ $mapelmaster->vids_count }} video
                                                dan {{ $mapelmaster->ujian_count }} exam</span></h4>
                                        @if ($mapelmaster->guru->detailguru !== null)
                                            <span>Whatsapp : </span>
                                           @if (substr($mapelmaster->guru->detailguru->wa_guru,0,1) == '0')
                                           <a href="https://wa.me/+62{{ substr($mapelmaster->guru->detailguru->wa_guru,1) }}"><u>{{ $mapelmaster->guru->detailguru->wa_guru }}</u></a>
                                           @else
                                           <a href="https://wa.me/{{ $mapelmaster->guru->detailguru->wa_guru }}"><u>{{ $mapelmaster->guru->detailguru->wa_guru }}</u></a>
                                           @endif
                                            
                                        @endif
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
                                            @foreach ($tugas as $key=> $item)
                                                    <div class="accordion" id="course__accordion{{ $key }}" style="margin-top: 20px">
                                                        <div class="accordion-item mb-20">
                                                            <h2 class="accordion-header" id="week-01">
                                                                <button class="accordion-button text-capitalize" type="button"
                                                                    data-bs-toggle="collapse" data-bs-target="#x"
                                                                    aria-expanded="true" aria-controls="week-01-content">
                                                                    Task : {{ $item->tugas_name }}
                                                                </button>
                                                            </h2>

                                                            <div id="x"
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
                                                                            @php
                                                                                $jawabanku = App\Models\Jawabtugas::where('mapelmaster_id',$mapelmaster_id)->where('siswa_id',auth()->user()->siswa->id)->first();
                                                                            @endphp
                                                                            @if ($jawabanku == null)
                                                                                <button class="btn btn-sm btn-danger text-white" data-bs-toggle="modal"
                                                                                data-bs-target="#modaltugassiswa1" data-siswa_id="{{ auth()->user()->siswa->id }}" data-tugas_name="{{ $item->tugas_name }}"
                                                                                data-tugas_id="{{ $item->id }}" data-mapelmaster_id="{{ $mapelmaster_id }}"
                                                                                data-guru_id="{{ $mapelmaster->guru->id }}">belum dikerjakan</button>
                                                                            @else
                                                                                <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                                                                data-bs-target="#modaltugassiswa2"data-jawabtugas_id="{{ $jawabanku->id }}" data-tanggal_upload="{{ $jawabanku->updated_at }}" data-jawabtugas_file="{{ $jawabanku->jawabtugas_file }}" data-tugas_name="{{ $item->tugas_name }}" data-siswa_id="{{ auth()->user()->siswa->id }}"
                                                                                data-tugas_id="{{ $item->id }}" data-mapelmaster_id="{{ $mapelmaster_id }}"
                                                                                data-guru_id="{{ $mapelmaster->guru->id }}">periksa</button>
                                                                            @endif
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
                                                                                <a href="/download-docstugas/{{ $dt->id }}" style="font-size: 12px" class="text-primary">unduh</a>
                                                                            </div>
                                                                        </div>
                                                                        @endforeach
                                                                    @endif
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade  show active" id="curriculum" role="tabpanel"
                                        aria-labelledby="curriculum-tab">
                                        <div class="course__curriculum">

                                            @if ($mapelmaster->materi_count < 1)
                                                <div class="accordion" style="margin-top: 20px">
                                                    <h4 style="color: red">
                                                        Belum ada materi yang tersedia pada pelajaran ini
                                                    </h4>
                                                </div>
                                            @endif

                                            @foreach ($mapelmaster->materi as $key => $item)
                                                <div class="accordion" id="course__accordion">
                                                    <div class="accordion-item mb-50">
                                                        <h2 class="accordion-header" id="week-01">
                                                            <button class="accordion-button text-capitalize"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#x{{ $key }}"
                                                                aria-expanded="true" aria-controls="week-01-content">
                                                                {{ $item->materi_name }}
                                                            </button>
                                                        </h2>

                                                        <div id="x{{ $key }}"
                                                            class="accordion-collapse collapse show"
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
                                                                            <h3 class="course__curriculum-meta"> <span
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
                                                                            <h3> <span>{{ $v->vids_name }}</span></h3>
                                                                        </div>
                                                                        <div class="course__curriculum-meta">
                                                                            <button
                                                                                data-bs-toggle="modal"
                                                                                data-bs-target="#modalplayvids"
                                                                                data-src="{{ $v->vids_link }}"
                                                                                class="btn btn-sm btn-danger" style="font-size: 12px"><i class="fa fa-play"
                                                                                    style="font-size: 12px"></i> tonton</button>
                                                                            <a href="/materi-video-comment/{{ Crypt::encrypt($v->id) }}"
                                                                                class="btn-info btn-sm text-white" style="line-height: 12px;font-size: 12px"><i class="fa fa-eye"
                                                                                    style="font-size: 12px"></i> details</a>
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
                                                                            <h3> <span>{{ $d->docs_name }} </span></h3>
                                                                        </div>
                                                                        <div class="course__curriculum-meta">
                                                                            <a href="#" data-bs-toggle="modal"
                                                                                data-bs-target="#modaldownloaddocs"
                                                                                data-id="{{ $d->id }}"
                                                                                data-docs_name="{{ $d->docs_name }}"
                                                                                data-docs_desc="{{ $d->docs_desc }}"
                                                                                class="btn-primary btn-sm" style="line-height: 12px;font-size: 12px"><i
                                                                                    class="fa fa-download"
                                                                                    style="font-size: 14px"></i> unduh</a>
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
                                                                            <h3> <span>{{ $u->ujian_name }}</span></h3>
                                                                        </div>
                                                                        <div class="course__curriculum-meta">
                                                                            <a href="#mulai"
                                                                                onclick="check({{ $mapelmaster->id }},{{ $item->id }},{{ $u }},'/do-quiz')"
                                                                                class="btn-success btn-sm" style="line-height: 12px; font-size: 12px"><i class="fa fa-edit"
                                                                                    style="font-size: 12px"></i>
                                                                                mengerjakan</a>
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
                                            <div class="course__comment mb-75">
                                                <ul>
                                                    @foreach ($nama_quiz as $key=>$ujian_name)
                                                    <li>
                                                        <div class="course__comment-box ">
                                                            <div class="course__comment-thumb float-start">
                                                                @if (auth()->user()->siswa->detailsiswa)
                                                                <img src="{{ asset('siswa_image/'.auth()->user()->siswa->detailsiswa->img_siswa) }}" alt="">    
                                                                @else
                                                                <img src="{{ asset('fe_assets/assets/img/course/comment/course-comment-1.jpg') }}"
                                                                alt="">
                                                                @endif
                                                            </div>
                                                            <div class="course__comment-content">
                                                                <div class="course__comment-wrapper ml-70 fix">
                                                                    <div class="course__comment-info float-start">
                                                                        <h4 class="text-capitalize">{{ $ujian_name }}</h4>
                                                                        <u><span>Nilai : {{ $nilai_quiz[$key] }}</span></u>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="member" role="tabpanel"
                                        aria-labelledby="member-tab">
                                        <div class="course__member mb-45">
                                            @foreach ($mapelmaster->kelas->siswa as $item)
                                                <div class="course__member-item">
                                                    <div class="row align-items-center">

                                                        <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12">
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

    <div class="modal fade" id="modaluser" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPDATE DATA USER</h4>
                </div>
                <form id="formupdateuser"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="user_id" id="user_id" class="form-control">
                                    <input type="text" placeholder="username" id="username" name="username"
                                        class="form-control mb-3" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" placeholder="password" id="pass" name="pass"
                                        class="form-control mb-3" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodaluser" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnupdateuser" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalhapusvideo" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">HAPUS VIDEO</h4>
                </div>
                <form id="formremovevids"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <div class="col-md-12 col-12" id="block-new-jurusan" style="padding-right: 5px">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodalmateri" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnremovevids" class="btn btn-sm btn-primary" value="Submit">
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
                            <iframe width="420" height="315" class="embed-responsive-item" src=""
                                id="video" frameborder="0" allowscriptaccess="always" allow="autoplay"></iframe>
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
                    <h4 class="modal-title" style="font-size: 16px; color:white">MATERI VIDEO BARU</h4>
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
                                    <input type="file" class="form-control" accept=".xlsx,.docs,.doc,.pdf,.csv"
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
                            <div class="col">
                                <a href="#" class="btn btn-sm btn-outline-info" data-bs-toggle="modal"
                                    data-bs-target="#modalcreateujian"><i class="fa fa-plus"></i>
                                    Ujian</a>
                                <a href="#" class="btn btn-sm btn-outline-primary" id="showtemplateujian"
                                    data-bs-toggle="modal" data-bs-target="#modaltemplateujian"><i
                                        class="fa fa-book"></i> Download Template</a>
                                <a href="#" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                                    data-bs-target="#modalimportujian"><i class="fa fa-upload"></i>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaltugassiswa1" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPLOAD JAWABAN TUGAS</h4>
                </div>
                <form id="formjawabtugas"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="hidden" name="tugas_id" id="tugas_id">
                                <input type="hidden" name="mapelmaster_id" id="mapelmaster_id">
                                <input type="hidden" name="guru_id" id="guru_id">
                                <input type="hidden" name="siswa_id" id="siswa_id">
                                <input type="file" class="form-control" name="jawabtugas_file" accept=".xlsx,.docs,.doc,.pdf,.csv" id="jawabtugas_file" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnclosejawabtugas" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-sm btn-outline-primary" id="btnaddjawabtugas" value="Upload">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modaltugassiswa2" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPLOAD JAWABAN TUGAS</h4>
                </div>
                <form id="formjawabtugas2"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <i class="fa fa-book"></i> File Tugasku : <span id="tanggal_upload"></span> 
                            </div>
                            <div class="col-md-4">
                                <a href="" id="download_tugasku" style="float: right"> <i class="fa fa-download"></i> unduh</a>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <span>Upload File Tugas Baru ? </span>
                                <input type="hidden" name="jawabtugas_id" id="jawabtugas_id">
                                <input type="hidden" name="tugas_id" id="tugas_id">
                                <input type="hidden" name="mapelmaster_id" id="mapelmaster_id">
                                <input type="hidden" name="guru_id" id="guru_id">
                                <input type="hidden" name="siswa_id" id="siswa_id">
                                <input type="file" class="form-control" name="jawabtugas_file" accept=".xlsx,.docs,.doc,.pdf,.csv" id="jawabtugas_file" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnclosejawabtugas2" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-sm btn-outline-primary" id="btnaddjawabtugas2" value="Upload">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalphoto" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPDATE PHOTO</h4>
                </div>
                <form id="formupdatephoto" enctype="multipart/form-data"> @csrf
                    <input type="hidden" id="formupdate" value="/update-photo-siswa">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="siswa_id" id="siswa_id" class="form-control">
                                    <div class="custom-file">
                                        
                                        <input type="file" name="img_siswa" class="custom-file-input"
                                            id="inputGroupFile01" accept="image/*" onchange="showPreview(event);">
                                        <p class="custom-file-label form-control" readonly style="margin-top: 20px" id="label_img" for="inputGroupFile01">Chose
                                            Image</p>
                                    </div>
                                    <div class="preview" style="max-width: 100%; margin-top: 20px; margin-bottom: 20px">
                                        @if (auth()->user()->siswa->detailsiswa)
                                            <input type="hidden" name="id" id="id" value="{{ auth()->user()->siswa->detailsiswa->id }}">
                                            <img style="max-width: 300px" id="inputGroupFile01-preview" src="{{ asset('siswa_image/'.auth()->user()->siswa->detailsiswa->img_siswa) }}">
                                        @else
                                            <img style="max-width: 300px" id="inputGroupFile01-preview" src="">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodalphoto" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnupdatephoto" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        var updatepoto;
        $(document).ready(function() {
            updatepoto = $('#formupdate').val()
        })
        $(document).ready(function() {})
        $('#closemodalmateri').on('click', function() {
            $('#modaladdmateri').modal('hide');
        })
        $('#btnclosejawabtugas').on('click', function() {
            $('#modaltugassiswa1').modal('hide');
        })
        $('#btnclosejawabtugas2').on('click', function() {
            $('#modaltugassiswa2').modal('hide');
        })
        $('#closemodalvids').on('click', function() {
            $('#modaladdvids').modal('hide');
        })
        $('#closemodaldocs').on('click', function() {
            $('#modaladddocs').modal('hide');
        })
        $('#closemodaldownloaddocs').on('click', function() {
            $('#modaldownloaddocs').modal('hide');
        })
        $('#closemodaluser').on('click', function() {
            $('#modaluser').modal('hide');
        })
        $('#closemodalphoto').on('click', function() {
            $('#modalphoto').modal('hide');
        })
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("inputGroupFile01-preview");
                preview.src = src;
                preview.style.display = "block";
                $('#label_img').html(src.substr(0, 30));
            }
        }
        $('#modalphoto').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var siswa_id = button.data('siswa_id')
            var modal = $(this)
            modal.find('.modal-body #siswa_id').val(siswa_id);
        })
        $('#modaltugassiswa1').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var siswa_id = button.data('siswa_id')
            var tugas_id = button.data('tugas_id')
            var mapelmaster_id = button.data('mapelmaster_id')
            var guru_id = button.data('guru_id')
            var modal = $(this)
            modal.find('.modal-body #siswa_id').val(siswa_id);
            modal.find('.modal-body #tugas_id').val(tugas_id);
            modal.find('.modal-body #mapelmaster_id').val(mapelmaster_id);
            modal.find('.modal-body #guru_id').val(guru_id);
        })
        $('#modaltugassiswa2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var siswa_id = button.data('siswa_id')
            var tugas_id = button.data('tugas_id')
            var mapelmaster_id = button.data('mapelmaster_id')
            var guru_id = button.data('guru_id')
            var tanggal_upload = button.data('tanggal_upload')
            var jawabtugas_id = button.data('jawabtugas_id')
            var modal = $(this)
            modal.find('.modal-body #tanggal_upload').html(tanggal_upload);
            modal.find('.modal-body #siswa_id').val(siswa_id);
            modal.find('.modal-body #tugas_id').val(tugas_id);
            modal.find('.modal-body #mapelmaster_id').val(mapelmaster_id);
            modal.find('.modal-body #guru_id').val(guru_id);
            modal.find('.modal-body #jawabtugas_id').val(jawabtugas_id);
            document.getElementById('download_tugasku').href="/download-jawaban-tugas-siswa/"+jawabtugas_id;
        })
        $('#modaluser').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var user_id = button.data('user_id')
            var username = button.data('username')
            var pass = button.data('pass')
            var modal = $(this)
            modal.find('.modal-body #user_id').val(user_id);
            modal.find('.modal-body #username').val(username);
            modal.find('.modal-body #pass').val(pass);
        })
        $('#formupdateuser').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-ubah-password",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnupdateuser').attr('disabled', 'disabled');
                    $('#btnupdateuser').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#btnupdateuser').val('Submit');
                        $('#btnupdateuser').attr('disabled', false);
                        $('#modaluser').modal('hide');
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnupdateuser').val('Submit');
                        $('#btnupdateuser').attr('disabled', false);
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

        $('#formjawabtugas').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/post-jawaban-tugas-siswa",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnaddjawabtugas').attr('disabled', 'disabled');
                    $('#btnaddjawabtugas').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#btnaddjawabtugas').val('Submit');
                        $('#btnaddjawabtugas').attr('disabled', false);
                        $('#modaltugassiswa1').modal('hide');
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnaddjawabtugas').val('Submit');
                        $('#btnaddjawabtugas').attr('disabled', false);
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

        $('#formjawabtugas2').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/post-jawaban-tugas-siswa2",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnaddjawabtugas2').attr('disabled', 'disabled');
                    $('#btnaddjawabtugas2').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#btnaddjawabtugas2').val('Submit');
                        $('#btnaddjawabtugas2').attr('disabled', false);
                        $('#modaltugassiswa2').modal('hide');
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnaddjawabtugas2').val('Submit');
                        $('#btnaddjawabtugas2').attr('disabled', false);
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

        $('#formupdatephoto').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: updatepoto,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnupdatephoto').attr('disabled', 'disabled');
                    $('#btnupdatephoto').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#btnupdatephoto').val('Submit');
                        $('#btnupdatephoto').attr('disabled', false);
                        $('#modalphoto').modal('hide');
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnupdatephoto').val('Submit');
                        $('#btnupdatephoto').attr('disabled', false);
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

        var videoSrc;
        $('#closemodalplayvids').on('click', function() {
            $('#modalplayvids').modal('hide');
            $('#video').attr('src', videoSrc);
        })
        $('#modalplayvids').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            videoSrc = button.data('src')
            $('#video').attr('src', videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
            console.log(videoSrc);
        })
        $('#closemodalmateri4').on('click', function() {
            $('#modaladdmateri4').modal('hide');
        })

        $("#showtemplateujian").on('click', function() {
            $('#modaladdmateri4').modal('hide');
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

        function check(mapelmaster_id, materi_id, ujian, url) {
            let now = new Date().getTime();
            let countDownDate = new Date(ujian.ujian_datetimeend).getTime();
            var distance = countDownDate - now;
            
            if (distance < 0) {
                swal({
                    title: "Waktu habis",
                    html: 'Ujian berakhir. Redirecting... ',
                    type: "info",
                });
            } else {
                swal({
                    title: "Mulai",
                    text: "MULAI MENGERJAKAN",
                    type: "info",
                }, function () {
                    window.location = url+'/'+mapelmaster_id+'/'+materi_id+'/'+ujian.id;
                });
            }
            // var url = "/do-quiz/" + ujian.id;
            // window.location.href = url;
        }

        function reload() {
            location.reload();
        }
    </script>
@endsection
