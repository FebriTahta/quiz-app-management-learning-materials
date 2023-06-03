@extends('fe_layouts.master')

@section('fe_content')
    <main>
        <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
            data-background="{{ asset('fe_assets/assets/img/page-title.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="page__title-wrapper mt-110">
                            <h3 class="page__title">{{ $siswa->kelas->kelas_name }} {{ $siswa->kelas->jurusan->jurusan_name }}
                                {{ $siswa->kelas->angkatan->tingkat->tingkat_name }}
                                "{{ $siswa->kelas->angkatan->angkatan_name }}"</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Mapel Room</li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $siswa->siswa_name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="course__area pt-50 pb-50">
            <div class="container"> 
                @if ($siswa->kelas->exam->where('exam_datetime', 'aktif')->count() > 0 || 
                $siswa->kelas->examurai->where('examurai_status', 'aktif')->count() > 0 )
                    <div class="ujian">
                        <div class="alert alert-success alert-block">
                            <small>Ada daftar ujian yang harus diselesaikan 
                                <br><u><a href="/daftar-ujian/{{ Crypt::encrypt($siswa->kelas->id) }}">klik disini <i class="fa fa-pencil"></i></a></u>
                            </small>
                        </div>
                    </div>
                @endif
                
                <div class="course__tab-inner grey-bg-2 mb-50">
                    <div class="course__sort d-flex justify-content-sm-end">
                        <div class="course__sort-inner">
                            <select id="search_mapel">
                                <option>Search Mapel</option>
                                @foreach ($siswa->kelas->mapelmaster as $item)
                                    <option style="max-width: 100%" value="/mapel-siswa/{{ Crypt::encrypt($item->id) }}">
                                        {{ $item->kelas->angkatan->angkatan_name }}
                                        {{ $item->kelas->angkatan->tingkat->tingkat_name }}
                                        {{ $item->kelas->jurusan->jurusan_name }}
                                        {{ $item->kelas->kelas_name }} : {{ $item->mapel->mapel_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="course__tab-conent">
                            <div class="tab-content" id="courseTabContent">
                                <div class="tab-pane fade show active" id="list" role="tabpanel"
                                    aria-labelledby="list-tab">
                                    <div class="row">
                                        @foreach ($siswa->kelas->mapelmaster as $item)
                                            <div class="col-xxl-12">
                                                <div class="course__item white-bg mb-30 fix">
                                                    <div class="row gx-0">
                                                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                                                            <div class="course__thumb course__thumb-list w-img p-relative fix"
                                                                style="padding: 10px"> 
                                                                <a href="/mapel-siswa/{{ Crypt::encrypt($item->id) }}">
                                                                    @if ($item->mapel->image == null || $item->mapel->image == '')
                                                                        <img src="{{ asset('assets/lms-default.png') }}"
                                                                            alt=""
                                                                            style="max-height: 100%; border-radius: 10px; margin-top: 15px">
                                                                    @else
                                                                        <img src="{{ asset('mapl_image/' . $item->mapel->image . '') }}"
                                                                            alt="">
                                                                    @endif
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-xxl-8 col-xl-8 col-lg-8">
                                                            <div class="course__right">
                                                                <div class="course__content ">
                                                                    <div class="course__meta d-flex align-items-center"
                                                                        style="padding: 0">
                                                                        <div class="course__lesson mr-20">
                                                                            <span style="margin-right: 10px"><i
                                                                                    class="far fa-book-alt"></i>{{ $item->docs->count() }}-Docs</span>
                                                                            <span style="margin-right: 10px"><i
                                                                                    class="far fa-video"></i>{{ $item->vids->count() }}-Video</span>
                                                                            <span style="margin-right: 10px"><i
                                                                                    class="far fa-pencil-alt"></i>{{ $item->ujian->count() }}-Soal</span>
                                                                        </div>
                                                                    </div>
                                                                    <h3 class="course__title course__title-3"
                                                                        style="margin: 0">
                                                                        <a style="font-size: 18px"
                                                                            href="/mapel-siswa/{{ Crypt::encrypt($item->id) }}">{{ $item->mapel->mapel_name }}</a>
                                                                    </h3>
                                                                    <div class="course__summary">
                                                                        <p style="font-size: 14px" style="margin: 0">Simak &
                                                                            Pelajari secara seksama materi yang disajikan
                                                                            dalam mata pelajaran ini untuk menunjang
                                                                            pemahaman serta nilai ujian.</p>
                                                                        <div class="course__teacher d-flex align-items-center"
                                                                            style="margin: 0">
                                                                            <div class="course__teacher-thumb mr-15">
                                                                                <img src="{{ asset('fe_assets/assets/img/contact/contact-shape-4.png') }}"
                                                                                    alt="">
                                                                            </div>
                                                                            <h6 style="margin: 0"><a
                                                                                    href="/mapel-siswa/{{ Crypt::encrypt($item->id) }}">{{ $item->guru->guru_name }}</a>
                                                                            </h6>
                                                                        </div>
                                                                    </div>
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
        </section>
    </main>
@endsection

@section('script')
<script>
     $('#search_mapel').on('change', function () {
            if (this.value !== null) {
                window.location = this.value;
            }
        })
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
            // var url = "/do-quiz/" + ujian.id;
            // window.location.href = url;
        }
</script>
@endsection