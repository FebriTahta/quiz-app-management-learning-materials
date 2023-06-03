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
                                            <h4>{{$quiz->ujian_datetimeend }} ({{ $quiz->ujian_lamapengerjaan }}:00 MENIT)</h4>
                                            <h5 id="counter"></h5>
                                        </h3>

                                        <div class="events__sponsor-info">
                                            <h3>Note : </h3>
                                            <h4><span>Usahakan selesaikan seluruh soal sebelum batas waktu pengerjaan
                                                    habis</span></h4>
                                        </div>
                                        <div class="events__sponsor-info button-nav">
                                            @foreach ($quizPanel as $i => $panel)
                                                @if ($panel->optionmulti_id == null)
                                                    <a href="{{ route('doQuiz', [
                                                        'ujian_id' => $quiz->id,
                                                        'byPanel' => $panel->soalmulti_id,
                                                        'mapelmaster_id' => $mapelmaster_id,
                                                        'materi_id'=> $materi_id,
                                                    ]) }}"
                                                        id="btnQuiz-{{ $panel->soalmulti_id }}" type="button"
                                                        style="margin: 7px" class="btn btn-sm btn-outline-secondary"> <span
                                                            style="font-size: 12px">{{ $i + 1 }}</span> </a>
                                                @else
                                                    <a href="{{ route('doQuiz', [
                                                        'ujian_id' => $quiz->id,
                                                        'byPanel' => $panel->soalmulti_id,
                                                        'mapelmaster_id' => $mapelmaster_id,
                                                        'materi_id'=> $materi_id,
                                                    ]) }}"type="button"
                                                        style="margin: 7px" class="btn btn-sm btn-success">
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
                                    @if (Str::limit($q->soal_name, 3) == 'be_...')
                                        <div class="teacher__info" style="padding: 0; margin: 0">
                                            <h5>No. {{ $indx }}</h5>
                                            <div class="blog__thumb w-img fix">
                                                <img src="{{ asset($q->soal_name) }}" alt="">
                                            </div>
                                            <br>
                                            
                                        </div>
                                    @else
                                        <div class="teacher__info" style="padding: 0; margin: 0">
                                            <h5>No. {{ $index }}</h5>
                                            <h5 style="font-size: 16px" class="text-capitalize">{{ $q->soal_name }}
                                            </h5>
                                            
                                        </div>
                                    @endif
                                </div>
                                <h4 style="font-size: 18px">Pilihan Jawaban :</h4>
                                <div class="soal_multi">
                                    <h4 style="font-weight: 400"></h4>
                                    <div class="option">
                                        <ul>
                                            <li style="line-height: 30px">
                                                <div class="row">
                                                    @foreach ($q->optionMulti as $key => $opt)
                                                        <div class="form-group col-md-1 col-2">
                                                            <input id="jawabanId" name="jawabanId" type="radio"
                                                                onclick="postQuiz({{ $quiz->id }},{{ $q->id }},{{ $opt->id }},{{ $opt->option_true }},{{ $mapelmaster_id }}, {{ $materi_id }})"
                                                                value="{{ $opt->id }}"
                                                                {{ $q->jawabanSiswa == $opt->id ? 'checked' : '' }}><span>
                                                                {{ $opts[$key] }}</span>
                                                        </div>
                                                        <div class="form-group col-md-11 col-10">
                                                            <span>{{ $opt->option_name }}</span>
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


@section('script')
    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script>
        function startQuiz() {
            var countDownDate = new Date(@json($quiz->ujian_datetimeend)).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get todays date and time
                var now = new Date().getTime();

                // Find the distance between now an the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                // var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Output the result in an element with id="demo"
                document.getElementById("counter").innerHTML = "Tersisa: " + hours + " Jam " +
                    minutes + " Menit";

                // If the count down is over, write some text 
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("counter").innerHTML = "Tersisa: EXPIRED";
                    swal({
                        title: "Waktu habis",
                        html: 'Ujian berakhir. Redirecting... ',
                        type: "info",
                    });
                    document.getElementById("formQuiz").submit();
                    window.location.href= '/';
                }
            }, 1000);

        }
        // function disable refresh page
        function disableF5(e) {
            if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) {
                e.preventDefault();
            }
        };

        $(document).on("keydown", this.disableF5);
        $(document).ready(function() {});
        this.startQuiz();

        function postQuiz(ujianId, soalId, jawabanId, option_true, mapelmaster_id, materi_id) {
            console.log(soalId + ":" + jawabanId);
            let data = {
                _token: "{{ csrf_token() }}",
                mapelmaster_id: mapelmaster_id,
                materi_id: materi_id,
                ujianId: ujianId,
                soalId: soalId,
                jawabanId: jawabanId,
                option_true: option_true,
            };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('postQuiz') }}',
                data: data, // serializes the form's elements.
                success: function(data) {
                    var btn = document.getElementById('btnQuiz-' + soalId);
                    if (btn !== null) {
                        btn.classList.remove("btn-outline-secondary");   
                        btn.classList.add("btn-success");
                    }
                }
            });
        }
    </script>
@endsection
