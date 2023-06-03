@extends('be_layouts.be_master')

@section('content')
    <div class="page has-sidebar-left bg-light height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row">
                    <div class="col">
                        <h3 class="my-3" style="font-size: 16px">
                            <i class="icon icon-group"></i> Siswa
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
                                        <span class="icon icon-group text-light-blue s-48"></span>
                                    </div>
                                    <div class="counter-title"><span class="" id="total_jurusan">0</span> : SISWA
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
                    <button class="btn btn-xs btn-primary" data-toggle="modal" data-target="#modaladd"><i
                            class="icon icon-plus"></i>Siswa Baru</button>
                    <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modaladd"><i
                            class="icon icon-upload"></i>Import Siswa</button>
                    <button class="btn btn-xs btn-outline-success"><i
                            class="icon icon-download"></i>Unduh Template</button>

                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-8 mb-2">
                            <select name="" id="dropdown-jurusan" class="form-control"
                                style="font-size: 12px"></select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <button class="btn btn-sm btn-info" style="font-size: 12px" id="reset"><i
                                    class="icon icon-cancel"></i> reset</button>
                        </div>
                    </div>

                    <div class="card my-3 no-b">
                        <div class="card-body">
                            <span>Daftar kelas yang tersedia</span><br>
                            <small>Kelola daftar kelas yang tersedia pada tabel berikut ini</small><br><br>
                            <table id="example" class="table table-bordered table-hover table-striped data-tables">
                                <thead>
                                    <tr>
                                        <th style="width: 7%;font-weight: bold">No</th>
                                        <th style="font-weight: bold">Kelas</th>
                                        <th style="font-weight: bold">Siswa</th>
                                        <th style="font-weight: bold; width: 14%">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 12px"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
