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
                {{-- <form id="formQuiz"> --}}
                    <div class="row">
                        <div class="col-xxl-8 col-xl-8 col-lg-8 pb-20">
                            <div class="top border-bottom text-center">
                                <div class="counter-div">
                                    <h3 class="events__sponsor-title mb-0">
                                        <h5 class="mb-0" id="counter" style="color: darkgray"></h5>
                                    </h3>
                                </div>
                                <div class="note">
                                    <i style="font-size:12px; color: darkgray">usahakan selesaikan seluruh soal sebelum batas waktu pengerjaan habis</i>
                                </div>
                            </div>
                            <div class="teacher__wrapper events__sidebar-widget white-bg">
                                <div class="teacher__top d-md-flex align-items-end justify-content-between mb-20">
                                    @if (Str::limit($q->soalexam_name, 3) == 'be_...')
                                        <div class="teacher__info" style="padding: 0; margin: 0">
                                            <h5>No. {{ $indx }}</h5>
                                            <div class="blog__thumb w-img fix">
                                                <img src="{{ asset($q->soalexam_name) }}" alt="" style="width:100%">
                                            </div>
                                            <br>
                                            <span></span>
                                        </div>
                                    @else
                                        <div style="padding: 0; margin: 0">
                                            <h5 class="mb-20">No. {{ $index }}</h5>
                                            <h6 style="font-size: 14px" style="font-weight: 100">{{ $q->soalexam_name }}</h6>
                                        </div>
                                    @endif
                                </div>
                                <h4 style="font-size: 14px; color:darkgray">Multiple Choice : </h4>
                                <div class="soal_multi">
                                    <div class="option">
                                        <ul>
                                            <li style="line-height: 30px">
                                                <div class="row">
                                                    @foreach ($q->optionexam as $key => $opt)
                                                        <div class="form-group col-md-1 col-2">
                                                            <input id="jawabanId" name="jawabanId" type="radio"
                                                                onclick="postExam({{ $quiz->id }},{{ $q->id }},{{ $opt->id }},{{ $opt->optionexam_true }},{{ $mapel_id }},{{ $kelas_id }})"
                                                                value="{{ $opt->id }}"
                                                                {{ $q->jawabanSiswa == $opt->id ? 'checked' : '' }}><span>
                                                                {{ $opts[$key] }}</span>
                                                        </div>
                                                        <div class="form-group col-md-11 col-10">
                                                            @if (Str::limit($opt->optionexam_name, 3) == 'be_...')
                                                                <img src="{{ asset($opt->optionexam_name) }}" alt="" style="max-width:100%">
                                                            @else
                                                                <span style="font-size:14px">{{ $opt->optionexam_name }}</span>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <form id="formQuiz">
                                    <input type="text" hidden id="soalId" name="soalId" value="{{ $q->id }}">
                                    <input type="hidden" value="{{auth()->user()->siswa->id}}" id="siswa_id">
                                    <input type="hidden" value="{{$quiz->id}}" id="exam_id">
                                    <input type="hidden" value="{{$kelas_id}}" id="kelas_id">
                                    <input type="hidden" value="{{$mapel_id}}" id="mapel_id">
                                </form>
                            </div>
                            <div class="navigation-soal pb-100" style="margin-top: 20px">
                                @if ($index > 1)
                                    <button class="btn btn-sm btn-primary" onclick=soalke({{$index-1}}) style="float: left; min-width:100px">
                                        <i class="fa fa-chevron-circle-left"></i> Prev
                                    </button>
                                @endif
                                @if ($index < $quizCount)
                                    <button  class="btn btn-sm btn-primary" style="float: right;min-width:100px" onclick=soalke({{$index+1}})>
                                        Next <i class="fa fa-chevron-circle-right"></i>
                                    </button>
                                @else
                                    <button class="finish_exam btn btn-sm btn-success" style="float: right;min-width:100px">Finish <i class="fa fa-flag"></i></button>
                                @endif
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 pb-20">
                            <div class="top border-bottom text-center">
                                <div class="counter-div">
                                    <h3 class="events__sponsor-title mb-0">
                                        <h5 class="mb-0" style="color: darkgray">
                                            INDIKATOR SOAL
                                        </h5>
                                        <div class="note">
                                            <i style="font-size:12px; color: darkgray">usahakan semua soal ujian telah terjawab</i>
                                        </div>
                                    </h3>
                                </div>
                            </div>
                            <div class="teacher__details-thumb p-relative w-img">
                                <div class="events__sidebar-widget white-bg">
                                    <div class="events__sponsor" style="text-align: center">
                                        <div class="events__sponsor-info button-nav">
                                            @foreach ($quizPanel as $i => $panel)
                                                @if ($panel->optionexam_id == null)
                                                    <a href="{{ route('doExam', [
                                                            'exam_id' => $quiz->id,
                                                            'byPanel' => $panel->soalexam_id,
                                                            'mapel_id' => $mapel_id,
                                                            'kelas_id'=> $kelas_id,
                                                        ]) }}"
                                                        id="btnQuiz-{{ $panel->soalexam_id }}" type="button"
                                                        style="margin: 7px; width:35px" class="btn btn-sm btn-outline-secondary soalke-{{$i+1}}">
                                                        <span style="font-size: 12px">{{ $i + 1 }}</span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('doExam', [
                                                            'exam_id' => $quiz->id,
                                                            'byPanel' => $panel->soalexam_id,
                                                            'mapel_id' => $mapel_id,
                                                            'kelas_id'=> $kelas_id,
                                                        ]) }}"type="button"
                                                        style="margin: 7px; width:35px" class="btn btn-sm btn-success soalke-{{$i+1}}">
                                                        <span style="font-size: 12px">{{ $i + 1 }}</span> 
                                                    </a>
                                                @endif
                                            @endforeach
                                            <hr>
                                            <button class="finish_exam btn btn-sm btn-success" style="margin: 7px;min-width:100px">Finish <i class="fa fa-flag"></i></button>
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
                    </div>
                {{-- </form> --}}
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
            var countDownDate = new Date(@json($quiz->exam_datetimeend)).getTime();

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
                    var siswa_id = $('#siswa_id').val()
                    var exam_id = $('#exam_id').val()
                    var kelas_id = $('#kelas_id').val()
                    var mapel_id = $('#mapel_id').val()
                    clearInterval(x);
                    document.getElementById("counter").innerHTML = "Tersisa: EXPIRED";
                    $.ajax({
                        type: "GET",
                        url: '/submit-nilai-exam/'+siswa_id+'/'+exam_id+'/'+kelas_id+'/'+mapel_id,
                        success: function(response) {
                            toastr.success(response.message);
                            if (response.message) {
                                window.location.replace("/");
                                swal({
                                    title: "Waktu habis",
                                    html: 'Ujian berakhir. Redirecting... ',
                                    type: "info",
                                });
                                document.getElementById("formQuiz").submit();
                                window.location.href= '/';
                            }
                        }
                    });
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

        $(document).ready(function() {
            var siswa_id = $('#siswa_id').val()
            var exam_id = $('#exam_id').val()
            var kelas_id = $('#kelas_id').val()
            var mapel_id = $('#mapel_id').val()
            $('.finish_exam').on('click', function (e) {
                
                e.preventDefault()
                swal({
                    title: 'Finish!',
                    text: "Menyelesaikan proses akumulasi nilai Ujian!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Kirim!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value == true) {
                        $.ajax({
                            type: "GET",
                            url: '/submit-nilai-exam/'+siswa_id+'/'+exam_id+'/'+kelas_id+'/'+mapel_id,
                            success: function(response) {
                                toastr.success(response.message);
                                if (response.message) {
                                    window.location.replace("/");
                                }
                            }
                        });
                    }
                })
            })
        });

        function soalke(soal)
        {
            var tombol = document.getElementsByClassName('soalke-'+soal)[0];
            tombol.click();
        }
        
        this.startQuiz();

        function postExam(ujianId, soalId, jawabanId, optionexam_true, mapel_id, kelas_id) {
            // alert(jawabanId+'-'+optionexam_true)
            console.log(soalId + ":" + jawabanId);
            let data = {
                _token: "{{ csrf_token() }}",
                mapel_id: mapel_id,
                kelas_id: kelas_id,
                exam_id: ujianId,
                soalexam_id: soalId,
                jawabanId: jawabanId,
                optionexam_true: optionexam_true,
            };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route('postExam') }}',
                data: data, // serializes the form's elements.
                success: function(data) {
                    if (data.status == 200) {
                        toastr.success(data.data);
                    }
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
