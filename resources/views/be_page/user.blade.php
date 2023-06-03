@extends('be_layouts.be_master')

@section('content')
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            User<p id="gets"></p>
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <ul class="nav responsive-tab nav-material nav-material-white" id="v-pills-tab">
                        <li>
                            <a class="nav-link active" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1">
                                <i class="icon icon-home2"></i>Today</a>
                        </li>
                    </ul>
                    {{-- <a class="btn-fab absolute fab-right-bottom btn-primary" data-toggle="control-sidebar">
                        <i class="icon icon-menu"></i>
                    </a> --}}
                </div>
            </div>
        </header>
        <div class="container-fluid relative animatedParent animateOnce">
            <div class="tab-content pb-3" id="v-pills-tabContent">
                <!--Today Tab Start-->
                <div class="tab-pane animated fadeInUpShort show active" id="v-pills-1">
                    <div class="row my-3">
                        <div class="col-md-4" style="margin-bottom: 10px">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-note-list text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title">Semua User</div>
                                    <h5 class="sc-counter mt-3">{{ $total_user }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8" style="margin-bottom: 10px">
                            <div class="counter-box white r-5 p-3">
                                <div class="">
                                    <p>Unduh data user</p>
                                    <form action="/admin-download-user-kelas" method="POST" enctype="multipart/form-data">@csrf
                                    <div class="row">
                                            <div class="col-md-12" style="width: 100%">
                                                <select name="kelas_id" id="kelas_id" class="form-control" style="width: 100%" required>
                                                    <option value="" style="width: 100%">:: Pilih Kelas ::</option>
                                                    @foreach ($kelas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->angkatan->tingkat->tingkat_name }} {{ $item->jurusan->jurusan_name }} {{ $item->kelas_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4" style="margin-top:10px">
                                                <input type="hidden" id="form_kelas_id" name="id" required>
                                                <button type="submit" class="btn btn-xs btn-primary">Unduh</button>
                                                
                                            </div>
                                        
                                    </div>
                                </form>        
                                </div>
                            </div>
                        </div>
                    </div>
                    <style>
                        td {
                        text-align: left;
                        }
                    </style>
                    <div class="white">
                        <div class="card-body">
                            <button class="btn btn-sm btn-success" style="width:150px" data-toggle="modal"
                            data-target="#modaladd"><i class="fa fa-plus"></i> user baru</button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="responsive nowrap table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">No</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Opsi</th>
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

    <div class="modal fade bs-example-modal-xl-2" id="modaladd" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel" style="color: white">USER BARU</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formadd">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="radio" class="radio" name="userbaru" id="userguru" value="userguru" checked><label>Guru Baru</label><br>
                            <input type="radio" class="radio" name="userbaru" id="usersiswa" value="usersiswa"><label>Siswa Baru</label>
                        </div>
                        <hr>
                        <div class="div guru" id="divguru">
                            <div class="form-group">
                                <input type="text" class="form-control mb-10" name="guru_name" placeholder="Nama Guru" >
                            </div>
                            <div class="form-group" >
                                <input type="text" class="form-control mb-10" name="guru_nip" placeholder="NIP Guru" >
                            </div>
                        </div>
                        <div class="div siswa" id="divsiswa" style="display: none">
                            <div class="form-group" >
                                <input type="text" class="form-control mb-10" name="siswa_name" placeholder="Nama Siswa" >
                            </div>
                            <div class="form-group" >
                                <input type="text" class="form-control mb-10" name="siswa_nik" placeholder="NIK Siswa" >
                            </div>
                            <div class="form-group" >
                                <select name="angkatan_id" class="form-control">
                                    @foreach ($angkatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->angkatan_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btnadd" class="btn btn-sm btn-primary" value="SUBMIT">
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-example-modal-xl-2" id="modaldel" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">HAPUS USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formdel">@csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control text-capitalize" name="id" id="id"
                            placeholder="id" required>
                        <p>Yakin akan menghapus "USER" Tersebut ?</p>
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

    <div class="modal fade bs-example-modal-xl-2" id="modaledit" tabindex="-1" role="dialog"
        aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myExtraLargeModalLabel">UPDATE DATA USER</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formedit">@csrf
                    <div class="modal-body">
                        
                            <div class="card-body" style="margin: auto; ">
                                <div class="form" style="margin-top: 30px">

                                    <div class="form-group">
                                        <label><b>Username </b></label>
                                        <input type="hidden" class="form-control" name="id" id="id">
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Role </b></label>
                                        <select name="role" class="form-control" id="role" required>
                                            <option value=""></option>
                                            <option value="admin">Admin</option>
                                            <option value="guru">Guru</option>
                                            <option value="siswa">Siswa</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label><b>Password </b></label>
                                        <input type="text" class="form-control" id="pass" name="pass"
                                            required>
                                    </div>


                                </div>
                            </div>
                            
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="btnedit" class="btn btn-sm btn-primary" value="UPDATE">
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
        $('#kelas_id').on('change', function () {
            var id = this.value;
            $('#form_kelas_id').val(id);
        })
        $(document).ready(function() {

            $('#modaldel').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
            })

            $('#modaledit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var id = button.data('id')
                var username = button.data('username')
                var role = button.data('role')
                var pass = button.data('pass')
                var modal = $(this)
                modal.find('.modal-body #id').val(id);
                modal.find('.modal-body #username').val(username);
                modal.find('.modal-body #role').val(role);
                modal.find('.modal-body #pass').val(pass);
            })

            $('#formdel').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "/hapus-user",
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
                            $('#btndel').val('REMOVE');
                            $('#modaldel').modal('hide');
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
                    url: "/admin-user-baru",
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
                    url: "/update-user",
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

            var table = $('#example').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: "/admin-daftar-user",
                columns: [{
                        "width": 10,
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'pass',
                        name: 'pass'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'opsi',
                        name: 'opsi'
                    },
                ]
            });
        });

        $('input[name=userbaru]').on('change', function () {
            if (this.value == 'usersiswa') {
                document.getElementById('divguru').style.display = 'none';
                document.getElementById('divsiswa').style.display = 'block';
            }else{
                document.getElementById('divguru').style.display = 'block';
                document.getElementById('divsiswa').style.display = 'none';
            }
        })
    </script>
@endsection
