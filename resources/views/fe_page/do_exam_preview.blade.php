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
                <form id="formQuiz">
                    <div class="row">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 pb-20">
                            <div class="teacher__details-thumb p-relative w-img">
                                <div class="events__sidebar-widget white-bg">
                                    <div class="events__sponsor" style="text-align: center">
                                        <h3 class="events__sponsor-title">
                                            <h5>{{$quiz->ujian_datetimeend }} 
                                                {{-- ({{ $quiz->ujian_datetimeend }}:00 MENIT) --}}
                                            </h5>
                                            <h5 id="counter"></h5>
                                        </h3>

                                        <div class="events__sponsor-info">
                                            <h3>Note : </h3>
                                            <h4><span>Usahakan selesaikan seluruh soal sebelum batas waktu pengerjaan
                                                    habis</span></h4>
                                        </div>
                                        <div class="events__sponsor-info button-nav">
                                            @foreach ($quizPanel as $i => $panel)
                                                @if ($panel->optionexam_id == null)
                                                    <a href="{{ route('doExamPrev', [
                                                        'exam_id' => $quiz->id,
                                                        'byPanel' => $panel->id,
                                                        'ke'=> $i+1,
                                                    ]) }}"
                                                        id="btnQuiz-{{ $panel->id }}" type="button"
                                                        style="margin: 7px; width:35px" class="btn btn-sm btn-outline-secondary"> <span
                                                            style="font-size: 12px">{{ $i + 1 }}</span></a>
                                                @else
                                                    <a href="{{ route('doExamPrev', [
                                                        'exam_id' => $quiz->id,
                                                        'byPanel' => $panel->id,
                                                        'ke'=> $i+1,
                                                    ]) }}"type="button"
                                                        style="margin: 7px; width:35px" class="btn btn-sm btn-success">
                                                        <span style="font-size: 12px">{{ $i + 1 }}</span> </a>
                                                @endif
                                            @endforeach
                                            <hr>
                                            <a href="/" style="margin: 7px"
                                                class="btn btn-sm btn-block btn-suuccess">FINISH</a>
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
                                {{-- @if (count($q) > 0) --}}
                                <div class="teacher__top d-md-flex align-items-end justify-content-between mb-20">
                                    <input type="text" hidden id="soalId" name="soalId" value="{{ $q->id }}">
                                    @if (Str::limit($q->soalexam_name, 3) == 'be_...')
                                        <div class="teacher__info" style="padding: 0; margin: 0">
                                            <h5>Preview Soal. {{ $ke }}</h5>
                                            <div class="blog__thumb w-img fix">
                                                <img src="{{ asset($q->soalexam_name) }}" alt="" style="width:100%">
                                            </div>
                                            <br>
                                        </div>
                                    @else
                                        <div class="teacher__info" style="padding: 0; margin: 0">
                                            <h5>Preview Soal. {{ $ke }}</h5>
                                            <h5 style="font-size: 28px" class="text-capitalize">{{ $q->soalexam_name }}
                                            </h5>
                                        </div>
                                    @endif
                                </div>
                                <h4 style="font-size: 18px">Pilihan Jawaban </h4>
                                <div class="soal_multi">
                                    <h4 style="font-weight: 400"></h4>
                                    <div class="option">
                                        <ul>
                                            <li style="line-height: 30px">
                                                <div class="row">
                                                    @foreach ($q->optionexam as $key => $opt)
                                                        <div class="form-group col-md-1 col-2">
                                                            <input id="jawabanId" name="jawabanId" type="radio"><span></span>
                                                        </div>
                                                        <div class="form-group col-md-11 col-10">
                                                            @if (Str::limit($opt->optionexam_name, 3) == 'be_...')
                                                                <img src="{{ asset($opt->optionexam_name) }}" alt="" style="max-width:100%">
                                                            @else
                                                                <span>{{ $opt->optionexam_name }}</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main>
@endsection