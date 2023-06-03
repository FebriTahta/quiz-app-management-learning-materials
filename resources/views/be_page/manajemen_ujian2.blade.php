@extends('be_layouts.be_master')

@section('content')
    <div class="page has-sidebar-left bg-light height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row">
                    <div class="col">
                        <h3 class="my-3" style="font-size: 16px">
                            <i class="icon icon-class"></i> UJIAN URAIAN
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
                                        <span class="icon icon-note-list text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title"><span class="" id="total_jurusan">0</span> : UJIAN URAIAN
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

                <style>
                    table.dataTable td {
                        padding: 5px;
                    }

                    table.dataTable thead {
                        font-size: 16px !important;
                    }
                </style>
                <div class="col-md-12" style="margin-top: 20px">
                    <a href="/admin-download-template-examurai" class="btn btn-xs btn-primary" ><i
                            class="icon icon-download"></i>Download Template Ujian</a>

                    <a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modalimportquiz"><i
                            class="icon icon-upload"></i>
                        Import From Template</a>

                    <div class="card my-3 no-b">
                        <div class="card-body">
                            <span>Angkatan yang terdaftar</span><br>
                            <small>Kelola daftar angkatan tersedia pada tabel berikut ini</small><br><br>
                            <table id="example"
                                class="table table-bordered table-hover table-striped data-tables display responsive nowrap">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th style="width: 7%;font-weight: bold">No</th>
                                        <th style="font-weight: bold">Mapel</th>
                                        <th style="font-weight: bold">Kelas</th>
                                        <th style="font-weight: bold">Jenis Ujian</th>
                                        <th style="font-weight: bold">Status Ujian</th>
                                        <th style="font-weight: bold; width: 7%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 12px" class="text-uppercase"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}
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
                            <div class="col-md-6 col-6" style="padding-left: 5px">
                                <input type="number" style="font-size: 14px" name="angkatan_name" class="form-control"
                                    placeholder="tahun angkatan">
                            </div>
                            <div class="col-md-6 col-6" style="padding-left: 5px">
                                <select style="font-size: 14px" name="tingkat_id" class="form-control"
                                    id="dropdown-tingkat"></select>
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

    <div class="modal fade" id="modaltemplateujian" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">JUMLAH SOAL BARU</h4>
                </div>
                <form id="formaddujian"> @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <input type="number" class="form-control" name="number_soal" id="number_soal"
                                    placeholder="Jumlah soal" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="closemodaladdujian" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <a href="#" class="btn btn-sm btn-outline-primary" id="btnaddujian">Download</a>
                        {{-- <input type="submit" id="btnaddujian" class="btn btn-sm btn-primary" value="Submit"> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                                <input type="hidden" class="form-control" id="id" name="id">
                            </div>
                            <div class="col-md-12 col-12" style="padding-left: 5px">
                                <input type="number" style="font-size: 14px" id="angkatan_name" name="angkatan_name"
                                    class="form-control" placeholder="tahun angkatan">
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

    <div class="modal fade" id="modalimportquiz" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">IMPORT DATA UJIAN</h4>
                </div>
                <form action="/admin-import-data-examurai" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group mb-20">
                                <select name="mapel_id" id="mapel_id" class="form-control text-uppercase" required>
                                    <option value="">:: MATA PELAJARAN ::</option>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}">{{ $item->mapel_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-20">
                                <select name="examurai_jenis" id="exam_jenis" class="form-control text-uppercase" required>
                                    <option value="">:: JENIS UJIAN ::</option>
                                    <option value="UTS SEMESTER 1">UTS SEMESTER 1</option>
                                    <option value="UTS SEMESTER 2">UTS SEMESTER 2</option>
                                    <option value="UAS SEMESTER 1">UAS SEMESTER 1</option>
                                    <option value="UAS SEMESTER 2">UAS SEMESTER 2</option>
                                </select>
                            </div>
                            <div class="form-group mb-20">
                                <select name="examurai_status" id="exam_status" class="form-control text-uppercase" required>
                                    <option value="">:: STATUS UJIAN ::</option>
                                    <option value="aktif">AKTIF (TAMPIL)</option>
                                    <option value="off">NON AKTIF (TIDAK TAMPIL)</option>
                                </select>
                            </div>
                            <div class="form-group mb-20">
                                <input type="number" class="form-control" id="exam_lamapengerjaan"
                                    name="examurai_lamapengerjaan" placeholder="Lama Pengerjaan (in minute)" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-20">
                                        <label for="exam_datetimestart">Waktu Dimulai</label>
                                        <input class="form-control" type="datetime-local" id="exam_datetimestart"
                                            name="examurai_datetimestart" placeholder="Waktu mulai" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-20">
                                        <label for="exam_datetimeend">Waktu Selesai</label>
                                        <input class="form-control" type="datetime-local" id="exam_datetimeend"
                                            name="examurai_datetimeend" placeholder="Waktu berakhir" required>
                                    </div>
                                </div>
                            </div>
                            <label for="file" style="font-size: 14px">Import Excel File Template Ujian</label>
                            <input type="file" class="form-control" style="border: none" name="file"
                                id="file" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnclosemodalquiz" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnimportsiswa" class="btn btn-sm btn-primary" value="Import">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaleditexam" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPDATE DATA UJIAN</h4>
                </div>
                <form id="formeditexam" method="POST" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="form-group mb-20">
                                <input type="hidden" name="id" id="id">
                                <select name="mapel_id" id="mapel_id" class="form-control text-uppercase" required>
                                    <option value="">:: MATA PELAJARAN ::</option>
                                    @foreach ($mapel as $item)
                                        <option value="{{ $item->id }}">{{ $item->mapel_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-20">
                                <select name="examurai_jenis" id="exam_jenis" class="form-control text-uppercase" required>
                                    <option value="">:: JENIS UJIAN ::</option>
                                    <option value="UTS SEMESTER 1">UTS SEMESTER 1</option>
                                    <option value="UTS SEMESTER 2">UTS SEMESTER 2</option>
                                    <option value="UAS SEMESTER 1">UAS SEMESTER 1</option>
                                    <option value="UAS SEMESTER 2">UAS SEMESTER 2</option>
                                </select>
                            </div>
                            <div class="form-group mb-20">
                                <select name="examurai_status" id="exam_status" class="form-control text-uppercase" required>
                                    <option value="">:: STATUS UJIAN ::</option>
                                    <option value="aktif">AKTIF (TAMPIL)</option>
                                    <option value="off">NON AKTIF (TIDAK TAMPIL)</option>
                                </select>
                            </div>
                            <div class="form-group mb-20">
                                <input type="number" class="form-control" id="exam_lamapengerjaan"
                                    name="examurai_lamapengerjaan" placeholder="Lama Pengerjaan (in minute)" required>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-20">
                                        <label for="exam_datetimestart">Waktu Dimulai</label>
                                        <input class="form-control" type="datetime-local" id="exam_datetimestart"
                                            name="examurai_datetimestart" placeholder="Waktu mulai" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-20">
                                        <label for="exam_datetimeend">Waktu Selesai</label>
                                        <input class="form-control" type="datetime-local" id="exam_datetimeend"
                                            name="examurai_datetimeend" placeholder="Waktu berakhir" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnclosemodalquiz" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btneditexam" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalkelas" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">MANAJEMEN KELAS</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-md-6 col-6">
                            <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modaladdkelas"
                                style="width: 100%">Tambah Kelas</button>
                        </div>
                        <div class="form-group col-md-6 col-6">
                            <button class="btn btn-sm btn-danger"data-toggle="modal" data-target="#modalupkelas"
                                style="width: 100%">Up / Rm Kelas</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnclosemodalquiz" class="btn btn-sm btn-default"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladdkelas" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">TAMBAH KELAS</h4>
                </div>
                <div class="modal-body">
                    <table id="example2"
                        class="display responsive nowrap table table-bordered table-hover table-striped data-tables">
                        <thead>
                            <tr>
                                <th style="5%"><input type="checkbox" id="master"></th>
                                <th style="font-weight: bold">Tingkat</th>
                                <th style="font-weight: bold">Kelas</th>
                                <th style="font-weight: bold">Jurusan</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnclosemodalquiz" class="btn btn-sm btn-default"
                        data-dismiss="modal">Close</button>
                    <button type="button" id="btnaddkelasexam" class="btn btn-sm btn-primary"
                        data-dismiss="modal">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalupkelas" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">UPDATE KELAS</h4>
                </div>
                <div class="modal-body">
                    <table id="example3"
                        class="display responsive nowrap table table-bordered table-hover table-striped data-tables">
                        <thead>
                            <tr>
                                <th style="5%"><input type="checkbox" id="master"></th>
                                <th style="font-weight: bold">Tingkat</th>
                                <th style="font-weight: bold">Kelas</th>
                                <th style="font-weight: bold">Jurusan</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 12px"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnclosemodalquiz" class="btn btn-sm btn-default"
                        data-dismiss="modal">Close</button>
                        <button type="button" id="btnupkelasexam" class="btn btn-sm btn-primary"
                        data-dismiss="modal">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalhapusexam" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(236, 122, 122);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">HAPUS UJIAN</h4>
                </div>
                <form method="POST" id="formhapusexam" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="id" name="id">
                        <p>Anda yakin akan menghapus Ujian tersebut ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnclosemodalquiz" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnhapusexam" class="btn btn-sm btn-danger" value="Hapus">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalkonfirmadd" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(122, 200, 236);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">KONFIRMASI ADD KELAS</h4>
                </div>
                <form method="POST" id="formkonfirmadd" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="idexam" name="idexam">
                        <input type="hidden" class="form-control" id="idkelas" name="kelas_id">
                        <p>Anda yakin akan menambahkan exam / ujian ke kelas tersebut</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnclosemodalquiz" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnkonfirmadd" class="btn btn-sm btn-primary" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalkonfirmup" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(236, 122, 160);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">KONFIRMASI REMOVE KELAS</h4>
                </div>
                <form method="POST" id="formkonfirmup" enctype="multipart/form-data">@csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="idexam2" name="idexam2">
                        <input type="hidden" class="form-control" id="idkelas2" name="kelas_id2">
                        <p>Anda yakin akan menghapus exam / ujian ke kelas tersebut</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnclosemodalquiz" class="btn btn-sm btn-default"
                            data-dismiss="modal">Close</button>
                        <input type="submit" id="btnkonfirmup" class="btn btn-sm btn-danger" value="Remove">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            total();
            table_default();
            tingkat_dropdown();

        })
        $('#master').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk").prop('checked', true);
            } else {
                $(".sub_chk").prop('checked', false);
            }
        });

        $('#master2').on('click', function(e) {
            if ($(this).is(':checked', true)) {
                $(".sub_chk2").prop('checked', true);
            } else {
                $(".sub_chk2").prop('checked', false);
            }
        });

        $('#btnaddkelasexam').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            if (allVals.length <= 0) {
                alert("PILIH DATA KELAS TERLEBIH DAHULU");
            } else {
                var join_selected_values = allVals.join(',');
                $('#modalkonfirmadd').modal('show');
                $('#idexam').val(id);
                $('#idkelas').val(join_selected_values);
            }
        }); 

        $('#btnupkelasexam').on('click', function(e) {
            var allVals2 = [];
            $(".sub_chk2:checked").each(function() {
                allVals2.push($(this).attr('data-id'));
            });
            if (allVals2.length <= 0) {
                alert("PILIH DATA KELAS TERLEBIH DAHULU");
            } else {
                var join_selected_values2 = allVals2.join(',');
                $('#modalkonfirmup').modal('show');
                $('#idexam2').val(id);
                $('#idkelas2').val(join_selected_values2);
            }
        });


        $('#btnaddujian').on('click', function() {
            var number_soal;
            number_soal = document.getElementById('number_soal').value;
            var modal = $(this)
            $("#btnaddujian").attr("href", "/guru-download-template-ujian/" + number_soal)
            $('#modaltemplateujian').modal('hide');
        })
        // end ready function
        function tingkat_dropdown() {
            $.ajax({
                type: 'GET',
                url: '/admin-tingkat-dropdown',
                success: function(response) {
                    $('#dropdown-tingkat').html('<option value="">-- Pilih Tingkatan --</option>')
                    $.each(response.data, function(key, value) {
                        $('#dropdown-tingkat').append('<option value="' + value.id + '">' + value
                            .tingkat_name + '</option>')
                    });

                    val_dropdown2 = null;
                }
            });
        }

        function table_default() {
            var table = $('#example').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: "/admin-manajemen-ujian-urai",
                columns: [{
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'mapel',
                        name: 'mapel.mapel_name'
                    },
                    {
                        data: 'kelas',
                        name: 'kelas'
                    },
                    {
                        data: 'examurai_jenis',
                        name: 'examurai_jenis'
                    },
                    {
                        data: 'examurai_status',
                        name: 'examurai_status'
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



        function total() {
            $.ajax({
                type: 'GET',
                url: '/admin-total-exam-urai',
                success: function(response) {
                    $('#total_jurusan').html(response.data);
                }
            });
        }

        $('#formkonfirmup').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-remove-exam-kelas2",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnkonfirmup').attr('disabled', 'disabled');
                    $('#btnkonfirmup').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        var oTable = $('#example').dataTable();
                        oTable.fnDraw(false);
                        $('#modalkonfirmup').modal('hide');
                        $("#formkonfirmup")[0].reset();
                        $('#btnkonfirmup').val('Remove');
                        $('#btnkonfirmup').attr('disabled', false);
                        total();
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                    } else {
                        $('#btnkonfirmup').val('Submit');
                        $('#btnkonfirmup').attr('disabled', false);
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
        
        $('#formkonfirmadd').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-add-exam-kelas2",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnkonfirmadd').attr('disabled', 'disabled');
                    $('#btnkonfirmadd').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        var oTable = $('#example').dataTable();
                        oTable.fnDraw(false);
                        $('#modalkonfirmadd').modal('hide');
                        $("#formkonfirmadd")[0].reset();
                        $('#btnkonfirmadd').val('Submit');
                        $('#btnkonfirmadd').attr('disabled', false);
                        total();
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                    } else {
                        $('#btnkonfirmadd').val('Submit');
                        $('#btnkonfirmadd').attr('disabled', false);
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

        $('#formadd').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-post-angkatan",
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
                        $('#btnadd').val('Submit');
                        $('#btnadd').attr('disabled', false);
                        total();
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
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

        $('#formhapusexam').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-remove-exam-urai",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btnhapusexam').attr('disabled', 'disabled');
                    $('#btnhapusexam').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        var oTable = $('#example').dataTable();
                        oTable.fnDraw(false);
                        $('#modalhapusexam').modal('hide');
                        $("#formhapusexam")[0].reset();
                        $('#btnhapusexam').val('Submit');
                        $('#btnhapusexam').attr('disabled', false);
                        total();
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                    } else {
                        $('#btnhapusexam').val('Submit');
                        $('#btnhapusexam').attr('disabled', false);
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

        $('#formeditexam').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-import-data-examurai",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#btneditexam').attr('disabled', 'disabled');
                    $('#btneditexam').val('Process...');
                },
                success: function(response) {
                    if (response.status == 200) {
                        var oTable = $('#example').dataTable();
                        oTable.fnDraw(false);
                        $('#modaleditexam').modal('hide');
                        $("#formeditexam")[0].reset();
                        $('#btneditexam').val('Submit');
                        $('#btneditexam').attr('disabled', false);
                        total();
                        toastr.success(response.message);
                        swal({
                            title: "SUCCESS!",
                            text: response.message,
                            type: "success"
                        });
                    } else {
                        $('#btneditexam').val('Submit');
                        $('#btneditexam').attr('disabled', false);
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

        // $(document).ready(function() {
        var id;
        $('#modalkelas').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            id = button.data('id')
            var modal = $(this)
            // modal.find('.modal-body #id').val(id);
        })

        $('#modaladdkelas').on('show.bs.modal', function(event) {

            var table = $('#example2').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: '/admin-kelas-keseluruhan2/' + id,
                columns: [
                    {
                        data: 'check',
                        name: 'check',
                        orderable: false,
                    },
                    {
                        data: 'angkatan_kelas',
                        name: 'angkatan_kelas'
                    },
                    {
                        data: 'kelas_name',
                        name: 'kelas_name'
                    },
                    {
                        data: 'kelas_jurusan',
                        name: 'kelas_jurusan'
                    },
                ]
            });
        })

        $('#modalupkelas').on('show.bs.modal', function(event) {

            var table = $('#example3').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                ajax: '/admin-kelas-saatini2/' + id,
                columns: [
                    {
                        data: 'check',
                        name: 'check',
                        orderable: false,
                    },
                    {
                        data: 'angkatan_kelas',
                        name: 'angkatan_kelas'
                    },
                    {
                        data: 'kelas_name',
                        name: 'kelas_name'
                    },
                    {
                        data: 'kelas_jurusan',
                        name: 'kelas_jurusan'
                    },
                ]
            });
        })

        $('#modaledit').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var angkatan_name = button.data('angkatan_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #angkatan_name').val(angkatan_name);
        })

        $('#modalhapusexam').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
        })

        $('#modaleditexam').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var mapel_id = button.data('mapel_id')
            var exam_jenis = button.data('exam_jenis')
            var exam_lamapengerjaan = button.data('exam_lamapengerjaan')
            var exam_datetimestart = button.data('exam_datetimestart')
            var exam_datetimeend = button.data('exam_datetimeend')
            var exam_status = button.data('exam_status')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #mapel_id').val(mapel_id);
            modal.find('.modal-body #exam_jenis').val(exam_jenis);
            modal.find('.modal-body #exam_lamapengerjaan').val(exam_lamapengerjaan);
            modal.find('.modal-body #exam_datetimestart').val(exam_datetimestart);
            modal.find('.modal-body #exam_datetimeend').val(exam_datetimeend);
            modal.find('.modal-body #exam_status').val(exam_status);
        })


        $('#formedit').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: "/admin-post-angkatan",
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
        //     });
    </script>
@endsection
