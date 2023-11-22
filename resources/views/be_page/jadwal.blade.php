@extends('be_layouts.be_master')

@section('content')
    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            Jadwal<p id="gets"></p>
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
                    {{-- <a class="btn-fab absolute fab-right-bottom btn-imary" data-toggle="control-sidebar">
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
                                    <div class="counter-title">Mapel & Kelas Terjadwal</div>
                                    <h5 class="sc-counter mt-3">
                                        @php
                                        $total = [];
                                            foreach ($hari as $item) {
                                                # code...
                                                $total [] = $item->mapelmaster_count;
                                            }
                                        $tot = array_sum($total);
                                        @endphp
                                        {{$tot}}
                                    </h5>
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
                            <h5>JADWAL PELAJARAN</h5>
                            <small>Berikut merupakan daftar jadwal matapelajaran dalam satu minggu</small>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example"
                                    class="responsive nowrap table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            @foreach ($hari as $item)
                                                <th>{{$item->hari_ind}}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody class="text-capitalize">
                                        {{-- data --}}
                                        <tr>
                                            @foreach ($hari as $item)
                                                @if ($item->mapelmaster_count > 0)
                                                <td>
                                                    @foreach ($item->mapelmaster as $i)
                                                    {{$i->mapel->mapel_name}} 
                                                    @if ($i->kelas)
                                                        {{$i->kelas->angkatan->tingkat->tingkat_name}}    
                                                        {{$i->kelas->kelas_name}}
                                                    @else
                                                        {{$i->delete()}}
                                                    @endif
                                                    : {{$i->guru->guru_name}} 
                                                    <br>
                                                    @endforeach
                                                </td>
                                                @else
                                                    <td style="color:red"> kosong</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 50px; margin-bottom: 100px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body" style="background: white">
                                    <h5>JADWAL PELAJARAN HARI INI</h5>
                                        <small>Hanya menampilkan daftar pelajaran hari ini {{date('l | d M Y - H:i')}}</small>
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="responsive nowrap table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead style="background-color: white">
                                                <tr>
                                                    <th>No</th>
                                                   <th>
                                                    {{date('l | d M Y')}}
                                                   </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-capitalize">
                                                @if (count($jadwal_hari_ini) > 0)
                                                    @foreach ($jadwal_hari_ini as $key=> $item)
                                                    <tr>
                                                        <td>
                                                            {{$key+1}}
                                                        </td>
                                                        <td>
                                                            {{$item->mapel->mapel_name}} |
                                                            {{$item->kelas->angkatan->tingkat->tingkat_name}} 
                                                            {{$item->kelas->kelas_name}}
                                                            : {{$item->guru->guru_name}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>1</td>
                                                        <td>kosong</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card-body" style="background: white">
                                    <h5>NO ACTION / MATERI</h5>
                                        <small>dafatar guru yang tidak melakukan action hari ini {{date('l | d M Y - H:i')}}</small>
                                    <div class="table-responsive">
                                        <table id="example"
                                            class="responsive nowrap table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead style="background-color: white">
                                                <tr>
                                                    <th>No</th>
                                                   <th>
                                                    {{date('l | d M Y')}}
                                                   </th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-capitalize">
                                                @if (count($no_materi) > 1)
                                                    @foreach ($no_materi as $key=> $item)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{$item}}</td>    
                                                    </tr>        
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td>1</td>
                                                        <td>Semua Guru Melakukan Action</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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

    
@endsection
