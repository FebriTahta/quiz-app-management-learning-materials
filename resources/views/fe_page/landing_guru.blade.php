@extends('fe_layouts.master2')

@section('fe_content')
    <main>

        <!-- instructor details area start -->
        <section class="teacher__area pt-100 pb-110">
            <div class="page__title-shape">
                <img class="page-title-shape-5 d-none d-sm-block"
                    src="{{ asset('fe_assets/assets/img/page-title/page-title-shape-1.png') }}" alt="">
                <img class="page-title-shape-6" src="{{ asset('fe_assets/assets/img/page-title/page-title-shape-6.png') }}"
                    alt="">
                <img class="page-title-shape-3" src="{{ asset('fe_assets/assets/img/page-title/page-title-shape-3.png') }}"
                    alt="">
                <img class="page-title-shape-7" src="{{ asset('fe_assets/assets/img/page-title/page-title-shape-4.png') }}"
                    alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="teacher__details-thumb p-relative w-img pr-30">
                            @if ($guru->detailguru)
                            <img src="{{ asset('guru_image/'.$guru->detailguru->img_guru) }}" alt="">
                            @else
                            <img src="{{ asset('fe_assets/assets/img/teacer-details-1.jpg') }}" alt="">
                            @endif
                            <div class="teacher__details-shape">
                                <img class="teacher-details-shape-1"
                                    src="{{ asset('fe_assets/assets/img/teacher/details/shape/shape-1.png') }}"
                                    alt="">
                                <img class="teacher-details-shape-2"
                                    src="{{ asset('fe_assets/assets/img/teacher/details/shape/shape-2.png') }}"
                                    alt="">
                            </div>
                            <div class="row" style="margin-top: 20px;">
                                <div class="col-md-4 col-4">
                                    <button data-bs-toggle="modal" data-user_id="{{ $guru->user_id }}"
                                        data-username="{{ $guru->user->username }}" data-pass="{{ $guru->user->pass }}"
                                        data-bs-target="#modaluser" style="width: 100%"
                                        class="btn btn-sm btn-outline-info">user / pass</button>
                                </div>
                                <div class="col-md-4 col-4">
                                    <button style="width: 100%" data-bs-toggle="modal" data-guru_id="{{ $guru->id }}"
                                       @if ($guru->detailguru)
                                       data-wa_guru="{{ $guru->detailguru->wa_guru }}"
                                       @else
                                       data-wa_guru=""
                                       @endif
                                       data-bs-target="#modalphoto" class="btn btn-sm btn-outline-primary">photo</button>
                                </div>
                                <div class="col-md-4 col-4">
                                    <button data-bs-target="#modalbio" data-bs-toggle="modal" data-guru_id="{{ $guru->id }}"
                                     style="width: 100%" class="btn btn-sm btn-outline-success">my bio</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-8 col-xl-8 col-lg-8">
                        <div class="teacher__wrapper">
                            <div class="teacher__top d-md-flex align-items-end justify-content-between">
                                <div class="teacher__info">
                                    <h4 class="text-capitalize">{{ $guru->guru_name }}</h4>
                                    <span>Guru SMK 1 Krian Sidoarjo</span> <br>
                                </div>
                            </div>
                            <div class="teacher__bio">
                                <h3>Short Bio</h3>
                                @if ($guru->quote !== null)
                                    <p>{{ $guru->quote }}</p>
                                @else
                                <p>Bapak memiliki tujuan pribadi dalam hidup, yaitu ikut serta mencerdaskan anak bangsa
                                    dibidang ilmu teknologi dan komunikasi dengan cara menjadi guru di salah satu sekolah
                                    kebanggaan Bapak
                                    yaitu SMK 1 Krian. Dengan mengikuti seluruh arahan bapak dengan baik, kalian akan
                                    menjadi manusia yang maju dibidang IPTEK
                                </p>
                                @endif
                               
                            </div>

                        </div>

                    </div>
                </div>
                <div class="teacher__courses pt-55">
                    <div class="section__title-wrapper mb-30">
                        <div class="course__tab-inner grey-bg-2 mb-50">
                            <div class="course__sort d-flex justify-content-sm-end">
                                <div class="course__sort-inner">
                                    <select id="search_mapel">
                                        <option>Search Mapel</option>
                                        @foreach ($guru->mapelmaster as $item)
                                            <option style="max-width: 100%" value="/mapel/{{ Crypt::encrypt($item->id) }}">
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


                    </div>

                    <div class="teacher__course-wrapper">
                        <div class="row">
                            @foreach ($guru->mapelmaster as $item)
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4">
                                    <div class="course__item white-bg mb-30 fix">
                                        <div class="course__thumb w-img p-relative fix">
                                            @if ($item->image == null || $item->image == '')
                                            <a href="/mapel/{{ Crypt::encrypt($item->id) }}">
                                                <img src="{{ asset('assets/lms-default.png') }}" alt=""
                                                    style="max-height: 100%; border-radius: 10px; margin-top: 15px">
                                            </a>
                                            @else
                                            <a href="/mapel/{{ Crypt::encrypt($item->id) }}">
                                                <img src="{{ asset('mapl_image/' . $item->image . '') }}" alt="">
                                            </a>
                                            @endif
                                        </div>
                                        <div class="course__content" style="max-height: 120px">
                                            <div class="course__meta d-flex align-items-center justify-content-between">
                                                <div class="course__lesson mr-20">
                                                    <span style="margin-right: 10px"><i
                                                            class="far fa-book-alt"></i>{{ $item->docs->count() }}-Docs</span>
                                                    <span style="margin-right: 10px"><i
                                                            class="far fa-video"></i>{{ $item->vids->count() }}-Video</span>
                                                    <span style="margin-right: 10px"><i
                                                            class="far fa-pencil-alt"></i>{{ $item->ujian->count() }}-Soal</span>
                                                </div>
                                            </div>
                                            <h3 class="course__title"><a
                                                    href="/mapel/{{ Crypt::encrypt($item->id) }}">{{ $item->kelas->angkatan->angkatan_name }}
                                                    {{ $item->kelas->angkatan->tingkat->tingkat_name }}
                                                    {{ $item->kelas->jurusan->jurusan_name }}
                                                    {{ $item->kelas->kelas_name }} : {{ $item->mapel->mapel_name }}</a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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

    <div class="modal fade" id="modalphoto" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPDATE PHOTO</h4>
                </div>
                <form id="formupdatephoto" enctype="multipart/form-data"> @csrf
                    @if ($guru->detailguru)
                        <input type="hidden" id="formupdate" value="/update-photo-guru2">
                    @else
                        <input type="hidden" id="formupdate" value="/update-photo-guru">
                    @endif
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="guru_id" id="guru_id" class="form-control">
                                    <div class="custom-file">
                                        
                                        <input type="file" name="img_guru" class="custom-file-input"
                                            id="inputGroupFile01" accept="image/*" onchange="showPreview(event);">
                                        <p class="custom-file-label form-control" readonly style="margin-top: 20px" id="label_img" for="inputGroupFile01">Chose
                                            Image</p>
                                    </div>
                                    <div class="preview" style="max-width: 100%; margin-top: 20px; margin-bottom: 20px">
                                        @if ($guru->detailguru)
                                            <input type="hidden" name="id" id="id" value="{{ $guru->detailguru->id }}">
                                            <img style="max-width: 300px" id="inputGroupFile01-preview" src="{{ asset('guru_image/'.$guru->detailguru->img_guru) }}">
                                        @else
                                            <img style="max-width: 300px" id="inputGroupFile01-preview" src="">
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="wa_guru" name="wa_guru" placeholder="nomor whatsapp guru">
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

    <div class="modal fade" id="modalbio" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPDATE BIO</h4>
                </div>
                <form id="formbio" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="guru_id" id="guru_id" class="form-control">
                                </div>
                                <div class="form-group">
                                    @if ($guru->quote !== null)
                                        <textarea name="quote" id="quote" class="form-control" cols="30" rows="10">{{ $guru->quote }}</textarea>
                                        @else
                                        <textarea name="quote" id="quote" class="form-control" cols="30" rows="10"></textarea>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodalbio" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnbio" class="btn btn-sm btn-primary" value="Submit">
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

        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("inputGroupFile01-preview");
                preview.src = src;
                preview.style.display = "block";
                $('#label_img').html(src.substr(0, 30));
            }
        }

        $('#search_mapel').on('change', function () {
            if (this.value !== null) {
                window.location = this.value;
            }
        })

        function reload() {
            location.reload();
        }

        $('#closemodaluser').on('click', function() {
            $('#modaluser').modal('hide');
        })
        $('#closemodalphoto').on('click', function() {
            $('#modalphoto').modal('hide');
        })
        $('#closemodalbio').on('click', function() {
            $('#modalbio').modal('hide');
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

        $('#modalphoto').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var guru_id = button.data('guru_id')
            var wa_guru = button.data('wa_guru')
            var modal = $(this)
            modal.find('.modal-body #guru_id').val(guru_id);
            modal.find('.modal-body #wa_guru').val(wa_guru);
        })

        $('#modalbio').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var guru_id = button.data('guru_id')
            var modal = $(this)
            modal.find('.modal-body #guru_id').val(guru_id);
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

        $('#formbio').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/update-bio",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnbio').attr('disabled', 'disabled');
                    $('#btnbio').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        $('#btnbio').val('Submit');
                        $('#btnbio').attr('disabled', false);
                        $('#modalbio').modal('hide');
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        reload();

                    } else {
                        $('#btnbio').val('Submit');
                        $('#btnbio').attr('disabled', false);
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
