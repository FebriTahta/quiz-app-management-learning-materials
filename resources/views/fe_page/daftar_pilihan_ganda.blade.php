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
                                    <li class="breadcrumb-item active" aria-current="page">Rekap Nilai</li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $siswa->siswa_name }}</li>
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
                                    <img src="{{ asset('siswa_image/' . auth()->user()->siswa->detailsiswa->img_siswa) }}"
                                        alt="">
                                @else
                                    <img src="{{ asset('fe_assets/assets/img/teacer-details-1.jpg') }}" alt="">
                                @endif
                            </div>
                            <div class="events__sidebar-widget white-bg">
                                <div class="events__sponsor">
                                    <h3 class="events__sponsor-title" style="text-transform: capitalize">Name :
                                        {{ auth()->user()->siswa->siswa_name }}</h3>
                                </div>
                                <hr>
                                <div class="events__sponsor">
                                    <div class="events__sponsor-info">
                                        <h3>Overview :</h3>
                                        <h4><span>Berikut adalah daftar Ujian Pilihan Ganda Aktif yang harus
                                                diselesaikan.</span></h4>
                                        <h4><span>Dengan total : {{ $pilihan_ganda_aktif->count() }} Ujian.</span></h4>
                                    </div>
                                </div>
                                <hr>

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
                                <div class="course__tab mb-45">
                                    <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="curriculum-tab" data-bs-toggle="tab"
                                                data-bs-target="#curriculum" type="button" role="tab"
                                                aria-controls="curriculum" aria-selected="false"> <i
                                                    class="icon_ribbon_alt"></i></i>
                                                <span>MULTIPLE </span> </button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                                data-bs-target="#review" type="button" role="tab"
                                                aria-controls="review" aria-selected="false"> <i
                                                    class="icon_ribbon_alt"></i>
                                                <span>URAIAN</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course__tab-content mb-95">
                                <div class="tab-content" id="courseTabContent">
                                    <div class="tab-pane fade" id="review" role="tabpanel"
                                        aria-labelledby="curriculum-tab">
                                        <div class="course__curriculum">
                                            @foreach ($uraian_aktif as $key => $item)
                                                <div class="accordion" id="course__accordion{{ $key }}"
                                                    style="margin-top: 20px">
                                                    <div class="accordion-item mb-20">
                                                        <h2 class="accordion-header" id="week-01">
                                                            <button class="accordion-button text-capitalize"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#x" aria-expanded="true"
                                                                aria-controls="week-01-content">
                                                                {{ $item->mapel->mapel_name }}
                                                            </button>
                                                        </h2>

                                                        <div id="x"
                                                            @if ($key == '0') class="accordion-collapse collapse show"
                                                                @else
                                                                class="accordion-collapse collapse show" @endif
                                                            aria-labelledby="week-01"
                                                            data-bs-parent="#course__accordion{{ $key }}">
                                                            <div class="accordion-body">
                                                                <div
                                                                    class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                    <div class="course__curriculum-info">
                                                                        <p>Deskripsi :</p>
                                                                        <h3> <span>Start : {{ \Carbon\Carbon::parse($item->examurai_datetimestart)->format('l - m F') }} ({{ $item->examurai_lamapengerjaan }} menit)</span></h3><br>
                                                                        {{-- <span>Keterangan :
                                                                            @if ($item->jawabanexamurai->count() < 1)
                                                                                Belum ada yang mengerjakan dikerjakan
                                                                            @else
                                                                                Dikerjakan {{ $siswa_kelas[$key] }} siswa
                                                                            @endif
                                                                        </span> --}}
                                                                    </div>
                                                                    <div class="course__curriculum-meta">
                                                                        @php
                                                                            $jawabanku = App\Models\Jawabanexamurai::where('kelas_id', $kelas->id)->where('examurai_id',$item->id)
                                                                                ->where('siswa_id', auth()->user()->siswa->id)
                                                                                ->first();
                                                                        @endphp
                                                                        @if ($jawabanku == null)
                                                                            <button class="btn btn-sm btn-danger text-white"
                                                                            onclick="check2({{ $item }},{{ $item->mapel_id }},{{ $siswa->kelas->id }},'/do-exam-uraian')"
                                                                            >belum dikerjakan</button>
                                                                        @else
                                                                            <button onclick="check2({{ $item }},{{ $item->mapel_id }},{{ $siswa->kelas->id }},'/do-exam-uraian')"
                                                                             class="btn btn-sm btn-info text-white">sudah dikerjakan</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    {{--  --}}

                                    <div class="tab-pane fade  show active" id="curriculum" role="tabpanel"
                                        aria-labelledby="curriculum-tab">
                                        <div class="course__curriculum">
                                            @foreach ($pilihan_ganda_aktif as $key => $item)
                                                <div class="accordion" id="course__accordion{{ $key }}"
                                                    style="margin-top: 20px">
                                                    <div class="accordion-item mb-20">
                                                        <h2 class="accordion-header" id="week-01">
                                                            <button class="accordion-button text-capitalize"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#x" aria-expanded="true"
                                                                aria-controls="week-01-content">
                                                                {{ $item->mapel->mapel_name }}
                                                            </button>
                                                        </h2>

                                                        <div id="x"
                                                            @if ($key == '0') class="accordion-collapse collapse show"
                                                                @else
                                                                class="accordion-collapse collapse show" @endif
                                                            aria-labelledby="week-01"
                                                            data-bs-parent="#course__accordion{{ $key }}">
                                                            <div class="accordion-body">
                                                                <div
                                                                    class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                    <div class="course__curriculum-info">
                                                                        <p>Deskripsi :</p>
                                                                        <h3> <span>Start : {{ \Carbon\Carbon::parse($item->exam_datetimestart)->format('l - m F') }} ({{ $item->exam_lamapengerjaan }} menit)</span></h3><br>
                                                                        {{-- <span>Keterangan :
                                                                            @if ($item->jawabanexam->count() < 1)
                                                                                Belum ada yang mengerjakan dikerjakan
                                                                            @else
                                                                            Dikerjakan {{ $siswa_kelas2[$key] }} siswa
                                                                            @endif
                                                                        </span> --}}
                                                                    </div>
                                                                    <div class="course__curriculum-meta">
                                                                        @php
                                                                            $jawabanku = App\Models\Jawabanexam::where('kelas_id', $kelas->id)->where('exam_id',$item->id)
                                                                                ->where('siswa_id', auth()->user()->siswa->id)
                                                                                ->first();
                                                                        @endphp
                                                                        @if ($jawabanku == null)
                                                                            <button class="btn btn-sm btn-danger text-white"
                                                                            onclick="check({{ $item }},{{ $item->mapel_id }},{{ $siswa->kelas->id }},'/do-exam')"
                                                                            >belum dikerjakan</button>
                                                                        @else
                                                                            <button onclick="check({{ $item }},{{ $item->mapel_id }},{{ $siswa->kelas->id }},'/do-exam')"
                                                                             class="btn btn-sm btn-info text-white">sudah dikerjakan</button>
                                                                        @endif
                                                                    </div>
                                                                </div>
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
@endsection

@section('script')
<script>
    function check(exam,mapel_id,kelas_id, url) {
        let now = new Date().getTime();
        let countDownDate = new Date(exam.exam_datetimeend).getTime();
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
                window.location = url+'/'+exam.id+'/'+mapel_id+'/'+kelas_id;
            });
        }
    }

    function check2(exam,mapel_id,kelas_id, url) {
        let now2 = new Date().getTime();
        let countDownDate2 = new Date(exam.examurai_datetimeend).getTime();
        var distance2 = countDownDate2 - now2;
        
        if (distance2 < 0) {
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
                window.location = url+'/'+exam.id+'/'+mapel_id+'/'+kelas_id;
            });
        }
    }
</script>
@endsection
