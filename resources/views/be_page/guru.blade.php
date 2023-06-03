@extends('be_layouts.be_master')

@section('content')
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row">
                    <div class="col">
                        <h3 class="my-3" style="font-size: 16px">
                            <i class="icon icon-group"></i> Guru
                        </h3>
                    </div>
                </div>
            </div>
        </header>

        <div class="container-fluid relative animatedParent animateOnce">
            <div class="tab-content pb-3" id="v-pills-tabContent">
                <!--Today Tab Start-->
                <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                    <div class="row my-3">
                        <div class="col-md-4 mb-2">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-group text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title"><span class="" id="total_guru">0</span> : GURU
                                    </div>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="block-navigasi" style="margin-bottom: 20px">
                        {{-- <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modaladd"><i
                                class="icon icon-plus"></i>Guru</button> --}}
                        <button class="btn btn-xs btn-outline-success" data-toggle="modal" data-target="#modalimportguru"><i
                                class="icon icon-upload"></i>Import Guru</button>
                        <a href="/admin-download-template-guru" class="btn btn-xs btn-outline-primary"><i
                                class="icon icon-download"></i>Template Guru</a>
                                {{-- <button class="btn btn-xs btn-outline-success" data-toggle="modal" data-target="#modalimportquiz"><i
                                    class="icon icon-upload"></i>Import Quiz</button>
                        <a href="/admin-download-template-quiz" class="btn btn-xs btn-outline-primary"><i
                                class="icon icon-download"></i>Template Quiz</a> --}}
                    </div>

                    <style>
                        table.dataTable td {
                            padding: 5px;
                        }

                        table.dataTable thead {
                            font-size: 16px !important;
                            a
                        }

                        td {
                        text-align: left;
                        }
                    </style>
                    <div class="card my-3 no-b" style="background: transparent">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="white">
                        <div class="card-body">
                            <span>Daftar Guru yang terdaftar</span><br>
                            <small>Kelola daftar guru dengan menambahkan maupun menghapuskannya pada tabel berikut
                                ini</small><br><br>

                            <div class="table-responsive">
                                <table id="example"
                                    class="display responsive nowrap table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">No</th>
                                            <th>Image</th>
                                            <th>Guru</th>
                                            <th>Quote</th>
                                            <th>Status</th>
                                            <th style="width: 15%">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        {{-- data --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Today Tab End-->
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalimportguru" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">IMPORT DATA GURU</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin-import-data-guru" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file" style="font-size: 14px">Import Excel File Template Guru</label>
                            <input type="file" class="form-control" style="border: none" name="file" id="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" id="btnimportsiswa" class="btn btn-sm btn-primary" value="Import">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="modalimportquiz" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">IMPORT DATA QUIZ</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="/admin-import-data-quiz" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="file" style="font-size: 14px">Import Excel File Template Quiz</label>
                            <input type="file" class="form-control" style="border: none" name="file" id="file">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                        <input type="submit" id="btnimportsiswa" class="btn btn-sm btn-primary" value="Import">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-xl-2" id="modaldel" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">HAPUS LOMBA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formdel">@csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control text-capitalize" name="id" id="id"
                            placeholder="id" required>
                        <p>Yakin akan menghapus Event / Lomba tersebut ?</p>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btndel" class="btn btn-sm btn-primary" value="REMOVE">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script>
        $(document).ready(function() {

            $('#modaldel').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })

            $('#formdel').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/backend-event-delete",
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
                            toastr.warning(response.message);
                            swal({
                                title: "SUCCESS!",
                                text: response.message,
                                type: "warning"
                            });
                        } else {
                            $("#formdel")[0].reset();
                            $('#btndel').val('REMOVE');
                            $('#btndel').attr('disabled', false);
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

            $('#formadd').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/backend-kategori-store",
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
                            var oTable = $('#example').dataTable();
                            oTable.fnDraw(false);
                            $('#modaladd').modal('hide');
                            $("#formadd")[0].reset();
                            $('#btnadd').val('SUBMIT');
                            $('#btnadd').attr('disabled', false);
                            toastr.success(response.message);
                            swal({
                                title: "SUCCESS!",
                                text: response.message,
                                type: "success"
                            });
                        } else {
                            $("#formadd")[0].reset();
                            $('#btnadd').val('SUBMIT!');
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

            $('#formedit').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/backend-kategori-store",
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
                            var oTable = $('#example').dataTable();
                            oTable.fnDraw(false);
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
                        } else {
                            $("#formedit")[0].reset();
                            $('#btnedit').val('SUBMIT!');
                            $('#btnedit').attr('disabled', false);
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



            total();
            tabel_guru();
        });


        function total() {
            $.ajax({
                type: 'GET',
                url: '/admin-total-guru',
                success: function(response) {
                    $('#total_guru').html(response.data);
                    if (response.data > 0) {
                        toastr.success(response.message);
                    } else {
                        toastr.warning(response.message);
                    }
                }
            });
        }

        function tabel_guru() {
            var table = $('#example').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: "/admin-guru",
                columns: [{
                        "width": 10,
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'photos',
                        name: 'photos'
                    },
                    {
                        data: 'guru_name',
                        name: 'guru_name'
                    },
                    {
                        data: 'quote',
                        name: 'quote'
                    },
                    {
                        data: 'stats',
                        name: 'guru_status'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
        }
    </script>
@endsection
