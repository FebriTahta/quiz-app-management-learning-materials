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
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 pb-20">
                            <div class="teacher__details-thumb p-relative w-img">
                                <div class="events__sidebar-widget white-bg">
                                    <div class="events__sponsor" style="text-align: center">
                                        <h3 class="events__sponsor-title">
                                            {{-- <h4>{{$quiz->ujian_datetimeend }} ({{ $quiz->ujian_lamapengerjaan }}:00 MENIT)</h4> --}}
                                            <h5 id="counter"></h5>
                                        </h3>

                                        <div class="events__sponsor-info">
                                            <h3>
                                                Note : {{ $siswa->siswa_name }}
                                                <br>
                                                ( {{ $kelas->angkatan->tingkat->tingkat_name }}
                                                {{ $kelas->jurusan->jurusan_name }}
                                                {{ $kelas->kelas_name }} )
                                            </h3>
                                            <h4><span>Periksa jawaban siswa sebagai berikut</span></h4>
                                        </div>
                                        <div class="events__sponsor-info button-nav">
                                            @foreach ($soal as $i => $s)
                                                @php
                                                    $jawabanku_ada = \App\Models\Jawabanexamurai::where('kelas_id', $kelas->id)
                                                    ->where('siswa_id', $siswa->id)
                                                    ->where('examurai_id', $s->examurai_id)->where('soalexamurai_id', $s->id)->first();
                                                @endphp

                                                <a id="btnQuiz-{{ $i+1 }}" href="/periksa-jawaban-uraian-siswa-next/{{ $siswa->id }}/{{ $kelas->id }}/{{ $guru->id }}/{{ $s->examurai_id }}/{{ $s->id }}/{{ $i }}"
                                                    type="button"style="margin: 7px"
                                                    @if ($jawabanku_ada?->jawabanku)
                                                    class="btn btn-sm btn-success"
                                                    @else
                                                    class="btn btn-sm btn-outline-secondary"
                                                    @endif
                                                    ><span
                                                    style="font-size: 12px">{{ $i + 1 }}</span>
                                                </a>
                                            @endforeach
                                            <hr>
                                            
                                            <a href="/" style="margin: 7px"
                                                class="btn btn-sm btn-block btn-suuccess">KEMBALI</a>
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
                                {{-- @if ($message = Session::get('success')) --}}
                                    
                                {{-- @endif --}}
                                   
                                {{-- @if ($message = Session::get('error')) --}}
                                    
                                {{-- @endif --}}

                                @if (count($q) > 0)
                                    @foreach ($q as $key => $q)
                                        @php
                                            $status_diperiksa = App\Models\Jawabanexamurai::where('kelas_id',$kelas->id)
                                            ->where('siswa_id',$siswa->id)->where('guru_id',$guru->id)->where('examurai_id',$q->examurai_id)
                                            ->where('soalexamurai_id',$q->id)->first();
                                        @endphp

                                        @if ($status_diperiksa?->nilaiku == null)
                                            <div class="alert alert-danger alert-block" style="line-height: 20px">
                                                <strong style="font-size: 12px">Belum diperiksa</strong>
                                            </div>
                                        @else
                                            <div class="alert alert-success alert-block">
                                                <strong>Sudah diperiksa</strong>
                                            </div>
                                        @endif
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
                                                    <h5 style="font-size: 28px" class="text-capitalize">
                                                        {{ $q->soalexam_name }}
                                                    </h5>
                                                    
                                                </div>
                                            @endif
                                        </div>
                                        <div class="soal_multi">
                                            <label for="jawabanku">jawaban :</label>
                                            @php
                                                $jawabanku_ada2 = \App\Models\Jawabanexamurai::where('kelas_id', $kelas->id)
                                                ->where('siswa_id', $siswa->id)
                                                ->where('examurai_id', $s->examurai_id)->where('soalexamurai_id', $q->id)->first();
                                            @endphp
                                            <br>
                                            @if ($jawabanku_ada2 !== null)
                                                {{-- <textarea name="jawabanku" class="form-control" id="summernote" cols="30" rows="5">{{  $jawabanku_ada2->jawabanku  }}</textarea> --}}
                                                <h5>{!! $jawabanku_ada2->jawabanku !!}</h5>
                                                @else
                                                <h5 style="color: red">Belum Diisi</h5>
                                                {{-- <textarea name="jawabanku" class="form-control" id="summernote" cols="30" rows="5"></textarea> --}}
                                            @endif
                                        </div>
                                        <hr>
                                        <div class="submit-btn" style="margin-top: 10px; text-align: right">
                                            @if ($jawabanku_ada2 !== null)
                                            <form action="/submit-periksa-uraian" method="POST" style="margin-bottom: 10px">@csrf
                                                <input type="hidden" class="form-control" name="siswa_id" value="{{ $siswa->id }}">
                                                <input type="hidden" class="form-control" name="kelas_id" value="{{ $kelas->id }}">
                                                <input type="hidden" class="form-control" name="examurai_id" value="{{ $examurai_id }}">
                                                <input type="hidden" class="form-control" name="soalexamurai_id" value="{{ $q->id }}">
                                                <input type="hidden" class="form-control" name="status" value="benar">
                                                <input type="submit" style="width: 150px" class="btn btn-sm btn-success" id="btnadd" value="Jawaban Benar">
                                            </form>
                                            <form action="/submit-periksa-uraian" method="POST" style="margin-bottom: 10px">@csrf
                                                <input type="hidden" class="form-control" name="siswa_id" value="{{ $siswa->id }}">
                                                <input type="hidden" class="form-control" name="kelas_id" value="{{ $kelas->id }}">
                                                <input type="hidden" class="form-control" name="examurai_id" value="{{ $examurai_id }}">
                                                <input type="hidden" class="form-control" name="soalexamurai_id" value="{{ $q->id }}">
                                                <input type="hidden" class="form-control" name="status" value="benar">                                                
                                                <input type="submit" style="width: 150px" class="btn btn-sm btn-danger" id="btnadd" value="Jawaban Salah">
                                            </form>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
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
    {{-- <script src="https://cdn.tiny.cloud/1/sf8wtfyqsqfp1nkw5lb10g9epv8jxif4o6nlcr4dipnta0ko/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>

        // tinymce.init({
            
        //     selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
        //     // plugins: 'code table lists',
        //     plugins: 'image',
        //     menubar: 'insert',
        //     toolbar: 'image',
        //     // image_list: [{
        //     //         title: 'My image 1',
        //     //         value: 'https://www.example.com/my1.gif'
        //     //     },
        //     //     {
        //     //         title: 'My image 2',
        //     //         value: 'http://www.moxiecode.com/my2.gif'
        //     //     }
        //     // ],
        //     height: 300,
        //     toolbar: 'image | undo redo | formatselect| bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
        // });
        // $('#summernote').summernote({
        //         height: 200
        // });

        $(document).ready(function() {
            $('#summernote').summernote({
                blockquoteBreakingLevel: 0,
                lineHeights : 0,
                height: 200,
            });
            
        });

            // Summernote Plugin: Soft breaks only
    // ------------------------------------------------------------------------------------------------------------------ //
    
    // Allow Summernote to not auto-generate p tags
    $.summernote.dom.emptyPara = "<div>" + "\n" + "</div>";
    
    // Initiate plugin
    $.extend($.summernote.plugins, {
        'brenter': function (context) {
            var self = this,
                ui = $.summernote.ui,
                $note = context.layoutInfo.note,
                $editor = context.layoutInfo.editor,
                options = context.options,
                lang = options.langInfo;

            this.events = {
                'summernote.enter': function (we, e) {
                    context.invoke('editor.pasteHTML', '\n');
                    e.preventDefault();
                },
                'insertParagraph': function (evt) {
                    if (evt.which === 13 || evt.keyCode === 13)
                        evt.shiftKey = true;
                },
                // Do not allow div wrapper to be removed
                'summernote.codeview.toggled': function (we, e) {
                    var isCodeview = context.invoke('codeview.isActivated');
                    if (!isCodeview) {
                        if (!$(this).val().startsWith('<div>')) {
                            $editor.find('.note-editable').wrapInner("<div></div>");
                        }
                    }
                }
            };

            this.initialize = function () {
            };
            this.destroy = function () {
                this.$panel.remove();
                this.$panel = null;
            };
        }
    });
        
        $('#formadd').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/menjawab-uraian",
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
                        $('#btnadd').val('Update Jawaban');
                        $('#btnadd').attr('disabled', false);
                        toastr.success(response.message);
                        var btn = document.getElementById('btnQuiz-' + response.soal_id);
                        btn.classList.remove("btn-outline-secondary");   
                        btn.classList.add("btn-success");
                    } else {
                        $('#btnadd').val('Submit Jawaban');
                        $('#btnadd').attr('disabled', false);
                        toastr.error(response.message);
                        $('#errList').html("");
                        $('#errList').addClass('alert alert-danger');
                        $.each(response.errors, function(key, err_values) {
                            $('#errList').append('<div>' + err_values + '</div>');
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    </script>
    {{-- <script>
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
    </script> --}}
@endsection
