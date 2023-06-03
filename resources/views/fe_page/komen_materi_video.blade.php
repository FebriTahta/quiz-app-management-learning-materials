@extends('fe_layouts.master2')

@section('fe_content')
    <section class="contact__area pt-115 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xxl-4 offset-xxl-1 col-xl-4 col-lg-5 mb-50">
                    <div class="contact__info white-bg p-relative z-index-1">
                        <div class="contact__shape">
                            <img class="contact-shape-1" src="{{ asset('fe_assets/assets/img/contact/contact-shape-1.png') }}"
                                alt="">
                            <img class="contact-shape-3"
                                src="{{ asset('fe_assets/assets/img/contact/contact-shape-3.png') }}" alt="">
                        </div>
                        <div class="form-group white-bg">
                            <iframe src="{{ $video->vids_link }}" style="width: 100%" height="200"
                                frameborder="0"></iframe>
                        </div>
                        <div class="contact__info-inner white-bg">
                            <ul>
                                <li>
                                    <div class="contact__info-item d-flex align-items-start mb-35">
                                        <div class="contact__info-icon mr-15">
                                            <i class="fa fa-play" style="color: blue"></i>
                                        </div>
                                        <div class="contact__info-text">
                                            <h4>Nama materi </h4>
                                            <p><a>{{ $video->vids_name }}</a></p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="contact__info-item d-flex align-items-start mb-35">
                                        <div class="contact__info-icon mr-15">
                                            <i style="color: blue" class="fa fa-newspaper"></i>
                                        </div>
                                        <div class="contact__info-text">
                                            <h4>Deskripsi</h4>
                                            <p>{{ $video->vids_desc }}</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-xl-7 col-lg-6 offset-xl-1 offset-lg-1">
                    <div class="contact__wrapper daftar_komen">
                        <div class="form-group" style="text-align: center">
                            <p>---- Daftar Komentar ----</p>
                        </div>
                        <div class="form-group" style="text-align: left; margin-bottom: 20px">
                            <button class="btn btn-outline-primary btn-sm"><i class="fa fa-undo"></i> reload</button>
                        </div>
                        {{-- <div class="blog__author-3 d-sm-flex grey-bg mb-20 " style="padding: 20px"> --}}
                        {{-- daftar komen disini --}}
                        {{-- </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-xxl-12" style="max-width: 100%">
                           <div class="basic-pagination wow fadeInUp mt-30 animated" data-wow-delay=".2s" style="max-width: 100%; visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                              <ul class="d-flex align-items-center pagination" style="max-width: 100%"> 
                                 {{-- pagination --}}
                              </ul>
                           </div>
                        </div>
                     </div>
                </div>

                <div class="col-xxl-12 col-xl-12 col-lg-12 offset-xl-12 offset-lg-12" style="margin-top: 20px">
                    <hr>
                    <div class="contact__wrapper">
                        <div class="section__title-wrapper mb-40"></div>
                        <div class="contact__form">
                            <form id="formadd">@csrf
                                <div class="row">
                                    <div class="col-xxl-12">
                                        <div class="contact__form-input">
                                            <input type="hidden" name="mapelmaster_id"
                                                value="{{ $video->mapelmaster_id }}">
                                            <input type="hidden" name="materi_id" value="{{ $video->materi_id }}">
                                            <input type="hidden" name="vids_id" value="{{ $video->id }}">
                                            <input type="hidden" name="siswa_id" value="{{ auth()->user()->siswa->id }}">
                                            <textarea placeholder="Enter Your Message" name="komen"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-xxl-12">
                                        <div class="contact__btn">
                                            <input type="submit" id="btnadd" class="e-btn" value="Post Comment">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <input type="hidden" id="vids_id" value="{{ $video->id }}">
@endsection


@section('script')
    <script>
        var vids_id;
        $(document).ready(function() {
            vids_id = $('#vids_id').val();
            display_komen();
        })

        function bersihkan() {
            $('.komenan').remove();
        }

        function display_komen() {
            $.ajax({
                type: 'GET',
                url: '/display-komen/' + vids_id,
                success: function(response) {
                    if (response.data.length == 0) {
                        toastr.warning('belum ada komentar');
                    } else {
                        toastr.success(response.message);
                        console.log(response.data);
                        

                        // refresh all
                        $.each(response.data.data, function(key, value) {
                            $(".daftar_komen").append('<a class="komenan" id="' + value.id + '">' +
                                '<div class="blog__author-3 d-sm-flex grey-bg mb-20 " style="padding: 15px"><div class="blog__author-thumb-3 mr-20">' +
                                '<img src="{{ asset('fe_assets/assets/img/blog/author/blog-author-1.jpg') }}" alt="">' +
                                '</div>' +
                                '<div class="blog__author-content">' +
                                '<h4 style="font-size: 14px">' + value.siswa.siswa_name + '</h4>' +
                                '<span style="font-size: 12px">Siswa</span>' +
                                '<p style="font-size: 14px">' + value.komen + '</p>' +
                                '</div></div></a>');
                        })
                    }
                }
            });
        }

        $('#formadd').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/post-comment-video",
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
                        // bersihkan();
                        // display_komen();
                        $(".daftar_komen").append('<a class="komenan" id="' + response.data.id + '">' +
                            '<div class="blog__author-3 d-sm-flex grey-bg mb-20 " style="padding: 15px"><div class="blog__author-thumb-3 mr-20">' +
                            '<img src="{{ asset('fe_assets/assets/img/blog/author/blog-author-1.jpg') }}" alt="">' +
                            '</div>' +
                            '<div class="blog__author-content">' +
                            '<h4 style="font-size: 14px">' + response.data.siswa.siswa_name + '</h4>' +
                            '<span style="font-size: 12px">Siswa</span>' +
                            '<p style="font-size: 14px">' + response.data.komen + '</p>' +
                            '</div></div></a>');
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
    </script>
@endsection
