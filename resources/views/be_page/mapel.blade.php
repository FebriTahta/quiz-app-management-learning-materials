@extends('be_layouts.be_master')

@section('content')
    <style>
        .mapel_image {
            width: 100% !important;
            height: 140px !important;
            object-fit: cover;
        }
    </style>
    <div class="page has-sidebar-left bg-light height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row">
                    <div class="col">
                        <h3 class="my-3" style="font-size: 16px">
                            <i class="icon icon-book"></i> Mata Pelajaran
                        </h3>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid my-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-book text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title"><span class="" id="total_mapel">0</span> : MAPEL
                                    </div>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12" style="margin-top: 20px">
                    <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modaladd"><i
                            class="icon icon-plus"></i>Mapel Baru</button>
                    <a href="/admin-download-template-mapel" class="btn btn-xs btn-outline-success"><i
                            class="icon icon-download"></i>Template Mapel</a>
                    <button class="btn btn-xs btn-outline-info" data-toggle="modal" data-target="#modalimport"><i
                            class="icon icon-upload"></i>Import Mapel</button>


                    <style>
                        .center {
                            display: block;
                            margin-left: auto;
                            margin-right: auto;
                            width: 50%;
                        }
                    </style>
                    <div class="card my-3 no-b">
                        <div class="card-body">
                            <span>Daftar Pelajaran tersedia</span><br>
                            <small>Kelola daftar mapel yang tersedia pada data berikut ini berikut ini</small><br><br>
                            <div>
                                <div class="row data_mapel">
                                    <div class="col-md-4" id="mapel_kosong">
                                        <div class="card"
                                            style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; height: 225px; max-height: 225px">
                                            <div class="card-body">
                                                <div class="d-flex align-items-center">
                                                    <div class="center">
                                                        <img src="{{ asset('assets/lms-default-none.png') }}"
                                                            style="max-width: 150px" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item" style="color: red">
                                                    <i class="icon icon-book text-red"></i>Belum Ada Mapel yang Didaftarkan
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}

    <div class="modal fade" id="modaledit" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(181, 110, 238);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPDATE DATA</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formedit"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" class="form-control" name="id" id="id">
                            </div>
                            <div class="col-md-12 col-12 mb-3" id="block-new-jurusan" style="padding-right: 5px">
                                <input type="text" style="font-size: 14px" name="mapel_name" id="mapel_name"
                                    class="form-control" placeholder="nama mata pelajaran">
                            </div>
                            <div class="col-md-12" style="padding-right: 5px">
                                <div class="form-group">
                                    <code>(318 px x 159 px) boleh kosong</code>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="img" class="custom-file-input"
                                                id="inputGroupFile01" accept="image/*" onchange="showPreview2(event);">
                                            <p class="custom-file-label" id="label_img2" for="inputGroupFile01">Pilih Image
                                                Mapel</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="preview" style="max-width: 300px">
                                        <img style="max-width: 300px" id="inputGroupFile01-preview2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" id="btnedit" class="btn btn-sm btn-primary" value="Update">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladd" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">ADD DATA</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formadd"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-12 mb-3" id="block-new-jurusan" style="padding-right: 5px">
                                <input type="text" style="font-size: 14px" name="mapel_name" class="form-control"
                                    placeholder="nama mata pelajaran">
                            </div>
                            <div class="col-md-12" style="padding-right: 5px">
                                <div class="form-group">
                                    <code>(318 px x 159 px) boleh kosong</code>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="img" class="custom-file-input"
                                                id="inputGroupFile01" accept="image/*" onchange="showPreview(event);">
                                            <p class="custom-file-label" id="label_img" for="inputGroupFile01">Pilih
                                                Image Mapel</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="preview" style="max-width: 300px">
                                        <img style="max-width: 300px" id="inputGroupFile01-preview">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" id="btnadd" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaldel" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(255, 87, 87);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">REMOVE DATA</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formdel"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5><span>REMOVE MAPEL : </span> <span id="mapel_name"></span></h5>
                                <input type="hidden" class="form-control" name="id" id="id"
                                    value="new">
                                <code>Yakin menghapus mapel tersebut ?</code><br>
                                <code>mapel yang memiliki siswa / guru / hasil quiz / latihan / ujian tidak dapat dihapus
                                    oleh sistem</code>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" id="btndel" class="btn btn-sm btn-primary" value="Delete">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalimport" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="font-size: 16px;">IMPORT DATA</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form id="formimport" action="/admin-import-data-mapel" method="POST" enctype="multipart/form-data"> @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file" style="font-size: 14px">Import Excel File Template Mapel</label>
                            <input type="file" class="form-control" style="border: none" name="file" id="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" id="btndel" class="btn btn-sm btn-primary" value="Import">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("inputGroupFile01-preview");
                preview.src = src;
                preview.style.display = "block";
                $('#label_img').html(src.substr(0, 35) + '...');
            }
        }

        function showPreview2(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("inputGroupFile01-preview2");
                preview.src = src;
                preview.style.display = "block";
                $('#label_img2').html(src.substr(0, 35) + '...');
            }
        }

        $(document).ready(function() {

            get_data();
            total();
            // jurusan_dropdown();
            // table_default();

        })

        // end ready function
        function get_data() {
            $.ajax({
                type: 'GET',
                url: '/admin-get-mapel',
                success: function(response) {
                    if (response.data.length == 0) {
                        document.getElementById('mapel_kosong').style.display = 'block';
                    } else {
                        document.getElementById('mapel_kosong').style.display = 'none';
                        $.each(response.data, function(key, value) {
                            if (value.image === null || value.image === "") {
                                $(".data_mapel").append('<a class="col-md-4 mb-3" id="' + value.id +
                                    '">' +
                                    '<div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; height: 225px; max-height: 225px">' +
                                    '<div class="card-body">' +
                                    '<div class="d-flex align-items-center">' +
                                    '<div>' +
                                    '<img class="mapel_image" src="{{ asset('assets/lms-default.png') }}" alt="">' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '<ul class="list-group list-group-flush">' +
                                    '<li class="list-group-item">' +
                                    '<i class="icon icon-book text-light-blue"></i>' + value
                                    .mapel_name + '' +
                                    '<div class="float-right">' +
                                    '<button class="btn btn-xs btn-primary mr-1" data-toggle="modal" data-target="#modaledit"' +
                                    'data-mapel_name="' + value.mapel_name + '" data-id="' + value
                                    .id + '" data-image="' + value.image + '">...</button>' +
                                    '<button class="btn btn-xs btn-danger ' + value.id +
                                    '" data-target="#modaldel" data-toggle="modal"' +
                                    'data-id="' + value.id + '" data-mapel_name="' + value
                                    .mapel_name + '">...</button>' +
                                    '</div>' +
                                    '</li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</a>');
                            } else {
                                $(".data_mapel").append('<a class="col-md-4 mb-3" id="' + value.id +
                                    '">' +
                                    '<div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; height: 225px; max-height: 225px">' +
                                    '<div class="card-body">' +
                                    '<div class="d-flex align-items-center">' +
                                    '<div>' +
                                    '<img class="mapel_image" src="mapl_image/' + value.image +
                                    '" style="height:100px" alt="">' +
                                    '</div>' +
                                    '</div>' +
                                    '</div>' +
                                    '<ul class="list-group list-group-flush">' +
                                    '<li class="list-group-item">' +
                                    '<i class="icon icon-book text-light-blue"></i>' + value
                                    .mapel_name + '' +
                                    '<div class="float-right">' +
                                    '<button class="btn btn-xs btn-primary mr-1" data-toggle="modal" data-target="#modaledit"' +
                                    'data-mapel_name="' + value.mapel_name + '" data-id="' + value
                                    .id + '" data-image="' + value.image + '">...</button>' +
                                    '<button class="btn btn-xs btn-danger ' + value.id +
                                    '" data-target="#modaldel" data-toggle="modal"' +
                                    'data-id="' + value.id + '" data-mapel_name="' + value
                                    .mapel_name + '">...</button>' +
                                    '</div>' +
                                    '</li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</a>');
                            }

                        })
                    }
                }
            });
        }

        function total() {
            $.ajax({
                type: 'GET',
                url: '/admin-total-mapel',
                success: function(response) {
                    $('#total_mapel').html(response.total);
                }
            });
        }

        $('#modaldel').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var mapel_name = button.data('mapel_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #mapel_name').html(mapel_name);
        })

        $('#formdel').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-remove-mapel",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btndel').attr('disabled', 'disabled');
                    $('#btndel').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        var oTable = $('#example').dataTable();
                        oTable.fnDraw(false);
                        $('#modaldel').modal('hide');
                        $("#formdel")[0].reset();
                        $('#btndel').val('REMOVE');
                        $('#btndel').attr('disabled', false);
                        total();
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        // remove elemen data berdasarkan id yang dihapus
                        $('.' + response.id).parents('a').remove();
                        if (response.jumlah === 0) {
                            document.getElementById('mapel_kosong').style.display = 'block';
                        }
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

        $('#formadd').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-post-mapel",
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
                        $('#modaladd').modal('hide');
                        $("#formadd")[0].reset();
                        $('#btnadd').val('Submit');
                        $('#btnadd').attr('disabled', false);
                        document.getElementById('mapel_kosong').style.display = 'none';
                        total();
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        var preview = document.getElementById("inputGroupFile01-preview");
                        preview.style.display = "none";
                        $('#label_img').html("Pilih Image Mapel");
                        if (response.image === null || response.image === "") {
                            $(".data_mapel").prepend('<a class="col-md-4 mb-3" id="' + response.data
                                .id + '">' +
                                '<div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; height: 225px; max-height: 225px">' +
                                '<div class="card-body">' +
                                '<div class="d-flex align-items-center">' +
                                '<div>' +
                                '<img src="{{ asset('assets/lms-default.png') }}" style="max-width: 100%" alt="">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<ul class="list-group list-group-flush">' +
                                '<li class="list-group-item">' +
                                '<i class="icon icon-book text-light-blue"></i>' + response.data
                                .mapel_name + '' +
                                '<div class="float-right">' +
                                '<button class="btn btn-xs btn-primary mr-1" data-toggle="modal" data-target="#modaledit"' +
                                'data-mapel_name="' + response.data.mapel_name + '" data-id="' +
                                response.data.id + '" data-image="' + response.image +
                                '">...</button>' +
                                '<button class="btn btn-xs btn-danger ' + response.data.id +
                                '" data-target="#modaldel" data-toggle="modal"' +
                                'data-id="' + response.data.id + '" data-mapel_name="' + response
                                .data.mapel_name + '">...</button>' +
                                '</div>' +
                                '</li>' +
                                '</ul>' +
                                '</div>' +
                                '</a>');
                        } else {
                            $(".data_mapel").prepend('<a class="col-md-4 mb-3" id="' + response.data
                                .id + '">' +
                                '<div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; height: 225px; max-height: 225px">' +
                                '<div class="card-body">' +
                                '<div class="d-flex align-items-center">' +
                                '<div>' +
                                '<img class="mapel_image" src="mapl_image/' + response.image +
                                '" style="max-width: 100%" alt="">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '<ul class="list-group list-group-flush">' +
                                '<li class="list-group-item">' +
                                '<i class="icon icon-book text-light-blue"></i>' + response.data
                                .mapel_name + '' +
                                '<div class="float-right">' +
                                '<button class="btn btn-xs btn-primary mr-1" data-toggle="modal" data-target="#modaledit"' +
                                'data-mapel_name="' + response.data.mapel_name + '" data-id="' +
                                response.data.id + '" data-image="' + response.image +
                                '">...</button>' +
                                '<button class="btn btn-xs btn-danger ' + response.data.id +
                                '" data-target="#modaldel" data-toggle="modal"' +
                                'data-id="' + response.data.id + '" data-mapel_name="' + response
                                .data.mapel_name + '">...</button>' +
                                '</div>' +
                                '</li>' +
                                '</ul>' +
                                '</div>' +
                                '</a>');
                        }


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

        $('#modaledit').on('show.bs.modal', function(event) {
            var preview = document.getElementById("inputGroupFile01-preview2");
            preview.style.display = "none";
            $('#label_img2').html("Pilih Image Mapel");
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var mapel_name = button.data('mapel_name')
            var image = button.data('image')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #mapel_name').val(mapel_name);
            var preview = document.getElementById("inputGroupFile01-preview2");
            if (image !== null && image !== "") {
                preview.src = 'mapl_image/' + image;
                preview.style.display = "block";
                $('#label_img2').html(image);
            } else {}

        })

        $('#formedit').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-update-mapel",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnedit').attr('disabled', 'disabled');
                    $('#btnedit').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {

                        $('#modaledit').modal('hide');
                        $("#formedit")[0].reset();
                        $('#btnedit').val('UPDATE');
                        $('#btnedit').attr('disabled', false);
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                        $.each(response.semua, function(key, value) {
                            $('.' + value.id).parents('a').remove();
                        })
                        get_data();
                        // if (response.image === null || response.image === "") {
                        //     $(".data_mapel").prepend('<a class="col-md-4 mb-3" id="'+response.data.id+'">'
                        //         +'<div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; height: 225px; max-height: 225px">'
                        //             +'<div class="card-body">'
                        //                 +'<div class="d-flex align-items-center">'
                        //                     +'<div>'
                        //                         +'<img src="{{ asset('assets/lms-default.png') }}" style="max-width: 100%" alt="">'
                        //                     +'</div>'
                        //                 +'</div>'
                        //             +'</div>'
                        //         +'<ul class="list-group list-group-flush">'
                        //             +'<li class="list-group-item">'
                        //                 +'<i class="icon icon-book text-light-blue"></i>'+response.data.mapel_name+''
                        //                 +'<div class="float-right">'
                        //                     +'<button class="btn btn-xs btn-primary mr-1" data-toggle="modal" data-target="#modaledit"'
                        //                     +'data-mapel_name="'+response.data.mapel_name+'" data-id="'+response.id+'" data-image="'+response.image+'">...</button>'
                        //                     +'<button class="btn btn-xs btn-danger '+response.data.id+'" data-target="#modaldel" data-toggle="modal"'
                        //                     +'data-id="'+response.data.id+'" data-mapel_name="'+response.data.mapel_name+'">...</button>'
                        //                 +'</div>'
                        //             +'</li>'
                        //         +'</ul>'
                        //     +'</div>'
                        //     +'</a>');
                        // }else{
                        //     $(".data_mapel").prepend('<a class="col-md-4 mb-3" id="'+response.data.id+'">'
                        //         +'<div class="card" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; height: 225px; max-height: 225px">'
                        //             +'<div class="card-body">'
                        //                 +'<div class="d-flex align-items-center">'
                        //                     +'<div>'
                        //                         +'<img class="mapel_image" src="mapl_image/'+response.image+'" style="max-width: 100%" alt="">'
                        //                     +'</div>'
                        //                 +'</div>'
                        //             +'</div>'
                        //         +'<ul class="list-group list-group-flush">'
                        //             +'<li class="list-group-item">'
                        //                 +'<i class="icon icon-book text-light-blue"></i>'+response.data.mapel_name+''
                        //                 +'<div class="float-right">'
                        //                     +'<button class="btn btn-xs btn-primary mr-1" data-toggle="modal" data-target="#modaledit"'
                        //                     +'data-mapel_name="'+response.data.mapel_name+'" data-id="'+response.id+'" data-image="'+response.image+'">...</button>'
                        //                     +'<button class="btn btn-xs btn-danger '+response.data.id+'" data-target="#modaldel" data-toggle="modal"'
                        //                     +'data-id="'+response.data.id+'" data-mapel_name="'+response.data.mapel_name+'">...</button>'
                        //                 +'</div>'
                        //             +'</li>'
                        //         +'</ul>'
                        //     +'</div>'
                        //     +'</a>');
                        // }

                    } else {
                        $('#btnedit').val('SUBMIT!');
                        $('#btnedit').attr('disabled', false);
                        toastr.error(response.message);
                        swal({
                            title: "MAAF!",
                            text: response.message,
                            type: "error"
                        });
                    }
                },
            });
        });
    </script>
@endsection
