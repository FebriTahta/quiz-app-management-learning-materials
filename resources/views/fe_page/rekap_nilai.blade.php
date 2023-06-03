@extends('fe_layouts.master')

@section('fe_content')
    <main>
        <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
            data-background="{{ asset('fe_assets/assets/img/page-title.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="page__title-wrapper mt-110">
                            <h3 class="page__title">{{ $siswa->kelas->kelas_name }}
                                {{ $siswa->kelas->jurusan->jurusan_name }}
                                {{ $siswa->kelas->angkatan->tingkat->tingkat_name }}
                                "{{ $siswa->kelas->angkatan->angkatan_name }}"</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Rekap Nilai</li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $siswa->siswa_name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="course__area pt-120 pb-120">
            <div class="container">
                <div class="course__tab-inner mb-50" style="background-color: rgb(247, 247, 247)">
                    <style>
                        @media only screen and (max-width: 600px) {
                            .center input {
                                margin-bottom: 50px;
                                max-width: 100%;
                            }
                            .center {
                                padding-left: 20px;
                                padding-right: 20px;
                            }
                        }

                        @media only screen and (min-width: 601px) {
                            .center input {
                                margin-bottom: 40px;
                                max-width: 200px;
                            }
                        }
                    </style>
                    <div class="divr center">
                        <div class="center">
                            <input type="text" id="myCustomSearchBox" class="form-control" placeholder="Search here.....">
                        </div>
                    </div>
                    <div class="course__sort" style="width: 100%">
                        <table id="example" class="display responsive nowrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th style="width: 7%">No</th>
                                    <th>Ujian</th>
                                    <th>Jenis Ujian</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- data --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    {{-- <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            tabel_rekap();
        })

        function tabel_rekap() {
            
            var table = $('#example').DataTable({
                "dom":"lrtip", //to hide default searchbox but search feature is not disabled hence customised searchbox can be made.
                destroy: true,
                processing: true,
                "bLengthChange": false,
                serverSide: true,
                ajax: "/rekap-nilai",
                columns: [{
                        "width": 10,
                        "data": null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'exam_name',
                        name: 'exam_name'
                    },
                    {
                        data: 'exam_jenis',
                        name: 'exam_jenis'
                    },
                    {
                        data: 'nilai',
                        name: 'nilai'
                    },
                ]
            });

            $('#myCustomSearchBox').keyup(function() {
                table.search($(this).val()).draw(); // this  is for customized searchbox with datatable search feature.
            })
        }
    </script>
@endsection
