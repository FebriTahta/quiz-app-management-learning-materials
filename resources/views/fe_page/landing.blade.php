@extends('fe_layouts.master')

@section('fe_content')
    <main>
        <section class="page__title-area page__title-overlay d-flex align-items-center" style="height: 100px"></section>

        <section class="course__area pt-50 pb-50">
            <div class="container"> 
                @if (!empty($siswa->kelas))
                @php
                    $ada_ujian = [];
                    
                    foreach ($siswa->kelas->exam as $key => $x) {
                        $exam_akhir = \Carbon\Carbon::parse($x->exam_datetimeend)->format('Y-m-d H:i:s');
                        if ($exam_akhir > \Carbon\Carbon::now()) {
                            $ada_ujian = $x;
                        }
                    }

                    foreach ($siswa->kelas->examurai as $key => $y) {
                        $examurai_akhir = \Carbon\Carbon::parse($y->examurai_datetimeend)->format('Y-m-d H:i:s');
                        if ($examurai_akhir > \Carbon\Carbon::now()) {
                            $ada_ujian = $x;
                        }
                    }
                @endphp
                @if(!empty($ada_ujian))
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

                @else
                <div class="container">
                    <div class="alert">
                        <div class="alert-danger p-3" style="border-radius: 15px">
                            <i class="fa fa-info-circle"></i>
                            Data siswa kamu tidak sempurna, tidak terdaftar pada
                            @if ($siswa->kelas_id == null)
                                kelas / angkatan manapun. hubungi admin / guru terkait untuk melakukan pembaharuan datamu.
                            @endif
                            <br>
                            kamu juga bisa melakukan pembaharuan data secara mandiri dengan memverifikasi data berikut ini.
                        </div>

                        @php
                            $missing_class = App\Models\Kelas::get();
                            $missing_angkatan = App\Models\Angkatan::get();
                        @endphp
                        <form action="{{route('submit.missing_data_siswa')}}" method="post">@csrf
                            <div class="row mt-4 mb-2">
                                <div class="col-md-6 mb-2">
                                    <select name="kelas_id" class="form-control" id="">
                                        @foreach ($missing_class as $item)
                                            <option value="{{$item->id}}">{{$item->kelas_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <select name="angkatan_id" class="form-control" id="">
                                        @foreach ($missing_angkatan as $item)
                                            <option value="{{$item->id}}">{{$item->angkatan_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Saya yakin menjadi anggota dari kelas dan angkatan tersebut</button>
                            </div>
                        </form>
                    </div>
                </div>
                @endif
                
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