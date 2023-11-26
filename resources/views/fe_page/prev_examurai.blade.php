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
                            <div class="events__sidebar-widget white-bg">
                                <div class="events__sponsor" style="text-align: center">
                                    <h3 class="events__sponsor-title">
                                        @php
                                            $soal_first = $soal->first();
                                        @endphp
                                        <h4>{{ \Carbon\Carbon::parse($soal_first->examurai->examurai_datetimeend)->format('d F Y - h:i') }} ({{ $soal_first->examurai->examurai_lamapengerjaan }}:00 MENIT)</h4>
                                        <input type="hidden" id="waktu_selesai" value="{{ $soal_first->examurai->examurai_datetimeend }}">
                                        <h5 id="counter"></h5>
                                    </h3>

                                    <div class="events__sponsor-info">
                                        <h3>Note : </h3>
                                        <h4><span>Usahakan selesaikan seluruh soal sebelum batas waktu pengerjaan
                                                habis</span></h4>
                                    </div>
                                    <div class="events__sponsor-info button-nav">

                                        @foreach ($soal as $i => $s)
                                            <a id="btnQuiz-{{ $i+1 }}" href="/prev-exam-uraian-next/{{ $s->examurai_id }}/{{ $s->id }}/{{ $i }}"
                                                type="button"style="margin: 7px; width:30px"
                                                class="btn btn-sm btn-outline-secondary"
                                                ><span
                                                style="font-size: 12px">{{ $i + 1 }}</span>
                                            </a>
                                        @endforeach
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
                        <div class="teacher__wrapper events__sidebar-widget white-bg">
                            @if (count($q) > 0)
                                @foreach ($q as $key => $q)
                                    <div class="teacher__top d-md-flex align-items-end justify-content-between mb-20">
                                        <input type="text" hidden id="soalId" name="soalId"
                                            value="{{ $q->id }}">
                                        @if (Str::limit($q->soalexam_name, 3) == 'be_...')
                                            <div class="teacher__info" style="padding: 0; margin: 0">
                                                @if ($nomorurut !== null)
                                                    <h5>No. {{ $nomorurut + 1 }}</h5>
                                                @else
                                                    <h5>No. {{ $key + 1 }}</h5> 
                                                @endif

                                                <div class="blog__thumb w-img fix">
                                                    <img src="{{ asset($q->soalexam_name) }}" alt="">
                                                </div>
                                                <br>
                                            </div>
                                        @else
                                            <div class="teacher__info" style="padding: 0; margin: 0">
                                                @if ($nomorurut !== null)
                                                    <h5>No. {{ $nomorurut + 1 }} </h5>
                                                @else
                                                    <h5>No. {{ $key + 1 }}</h5>
                                                @endif
                                                <h5 style="font-size: 16px" class="text-capitalize">
                                                    {{ $q->soalexam_name }}
                                                </h5>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


@section('script')
    
@endsection
