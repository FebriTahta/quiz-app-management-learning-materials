@extends('be_layouts.be_master')

@section('content')
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            Unduh hasil Ujian Pilihan Ganda<p id="gets"></p>
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
                                <div class="">
                                    <p>Pilih kelas</p>
                                    {{-- <form action="/admin-download-user-kelas" method="POST" enctype="multipart/form-data">@csrf --}}
                                    <div class="row">
                                            <div class="col-md-12" style="width: 100%">
                                                <select name="kelas_id" id="kelas_id" class="form-control" style="width: 100%" required>
                                                    <option value="" style="width: 100%">:: Pilih Kelas ::</option>
                                                    @foreach ($kelas as $item)
                                                        <option value="{{ $item->id }}">{{ $item->kelas_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        
                                    </div>
                                {{-- </form>         --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8" style="margin-bottom: 10px">
                            <div class="counter-box white r-5 p-3">
                                <div class="">
                                    <div class="row">
                                        <div class="col-md-6" style="width: 100%">
                                            <p>Tanggal awal</p>
                                            <input type="date" id="tgl_awal" class="form-control">
                                        </div>
                                        <div class="col-md-6" style="width: 100%">
                                            <p>Tanggal akhir</p>
                                            <input type="date" id="tgl_akhir" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" style="margin-bottom: 10px">
                            <button class="btn btn-xs btn-primary" id="proses" style="width:100%">Proses Data</button>
                        </div>
                    </div>
                    <style>
                        td {
                        text-align: left;
                        }
                    </style>
                    <div class="white">
                        <div class="card-body">
                            <form action="/unduh-hasil-ujian-pilgan" method="POST">@csrf
                                <input type="hidden" id="kelas_id2" name="kelas_id" class="form-control">
                                <input type="hidden" id="tgl_awal2" name="tgl_awal" class="form-control">
                                <input type="hidden" id="tgl_akhir2" name="tgl_akhir" class="form-control">
                                <button type="submit" class="btn btn-sm btn-success" id="download" style="width:200px; display: none"><i class="icon icon-download"></i> Unduh Data Ujian Pilihan Ganda</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="responsive nowrap table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">No</th>
                                            <th>Nama Ujian</th>
                                            <th>Tanggal</th>
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

    
@endsection

@section('script')
    <!-- Toast -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <script>

        $('#proses').on('click', function(){ 
            var kelas_id = $('#kelas_id').val();
            var tgl_awal = $('#tgl_awal').val();
            var tgl_akhir = $('#tgl_akhir').val();
            if (!!kelas_id && !!tgl_awal && !!tgl_akhir) {
                    document.getElementById('download').style.display = 'block';
                    var table = $('#example').DataTable({
                        destroy: true,
                        processing: true,
                        serverSide: true,
                        ajax: '/proses-data-ujian-pilgan/'+kelas_id+'/'+tgl_awal+'/'+tgl_akhir,
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
                                data: 'tanggal',
                                name: 'tanggal'
                            },
                        ]
                    });
                
            }else{
                alert('pastikan parameter proses pencarian data ujian lengkap');
            }
        })

        $('#kelas_id').on('change',function(){
            $('#kelas_id2').val(this.value);
        })

        $('#tgl_awal').on('change',function(){
            $('#tgl_awal2').val(this.value);
        })

        $('#tgl_akhir').on('change',function(){
            $('#tgl_akhir2').val(this.value);
        })
    </script>
@endsection
