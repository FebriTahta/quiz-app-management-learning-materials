@extends('fe_layouts.master')

@section('fe_content')
    <main>
        <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center"
            data-background="{{ asset('fe_assets/assets/img/page-title.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="page__title-wrapper mt-110">
                            <h3 class="page__title">{{ $kelas->kelas_name }}
                                {{ $kelas->jurusan->jurusan_name }}
                                {{ $kelas->angkatan->tingkat->tingkat_name }}
                                "{{ $kelas->angkatan->angkatan_name }}"</h3>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Rekap Nilai (Uraian)</li>
                                    <li class="breadcrumb-item active" aria-current="page">{{ $guru->guru_name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="course__area pt-120 pb-120">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 pb-20">
                        <div class="teacher__details-thumb p-relative w-img">
                            <div class="blocl">
                                @if (auth()->user()->guru->detailguru)
                                    <img src="{{ asset('guru_image/' . $guru->detailguru->img_guru) }}"
                                        alt="">
                                @else
                                    <img src="{{ asset('fe_assets/assets/img/teacer-details-1.jpg') }}" alt="">
                                @endif
                            </div>
                            <div class="events__sidebar-widget white-bg">
                                <div class="events__sponsor">
                                    <h3 class="events__sponsor-title" style="text-transform: capitalize">Name :
                                        {{ auth()->user()->guru->guru_name }}</h3>
                                </div>
                                <hr>
                                <div class="events__sponsor">
                                    <div class="events__sponsor-info">
                                        <h3>Overview :</h3>
                                        <h4><span>Berikut adalah daftar Ujian Pilihan Ganda Aktif yang harus
                                                diselesaikan.</span></h4>
                                        <h4><span>Dengan total : 
                                            @php
                                                $total = [];
                                                foreach ($uraian as $key => $i){
                                                    if ($i->mapel_id == $mapel->id) {
                                                        $total[] = $key;
                                                    }
                                                }
                                                $to = array_sum($total);
                                            @endphp 
                                            {{ $to }}
                                            Uraian.</span></h4>
                                    </div>
                                </div>
                                <hr>

                            </div>
                            <div class="teacher__details-shape">
                                <img class="teacher-details-shape-1"
                                    src="{{ asset('fe_assets/assets/img/teacher/details/shape/shape-1.png') }}"
                                    alt="">
                                <img class="teacher-details-shape-2"
                                    src="{{ asset('fe_assets/assets/img/teacher/details/shape/shape-2.png') }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-8 col-xl-8 col-lg-8">
                        <div class="teacher__wrapper">

                            <div class="teacher_bio" style="margin-top: 10px">
                                <div class="course__tab mb-45">
                                    <ul class="nav nav-tabs" id="courseTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="review-tab" data-bs-toggle="tab"
                                                data-bs-target="#review" type="button" role="tab"
                                                aria-controls="review" aria-selected="false"> <i
                                                    class="icon_ribbon_alt"></i>
                                                <span>URAIAN</span>
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="course__tab-content mb-95">
                                <div class="tab-content" id="courseTabContent">
                                    <div class="tab-pane fade show active" id="review" role="tabpanel"
                                        aria-labelledby="curriculum-tab">
                                        <div class="course__curriculum">
                                            @foreach ($uraian as $key => $item)
                                                @if ($item->mapel_id == $mapel->id)
                                                <div class="accordion" id="course__accordion{{ $key }}"
                                                    style="margin-top: 20px">
                                                    <div class="accordion-item mb-20">
                                                        <h2 class="accordion-header" id="week-01">
                                                            <button class="accordion-button text-uppercase"
                                                                type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#x" aria-expanded="true"
                                                                aria-controls="week-01-content">
                                                                {{ $item->examurai_name }}
                                                            </button>
                                                        </h2>

                                                        <div id="x"
                                                            @if ($key == '0') class="accordion-collapse collapse show"
                                                                @else
                                                                class="accordion-collapse collapse show" @endif
                                                            aria-labelledby="week-01"
                                                            data-bs-parent="#course__accordion{{ $key }}">
                                                            <div class="accordion-body">
                                                                <div
                                                                    class="course__curriculum-content d-sm-flex justify-content-between align-items-center">
                                                                    <div class="course__curriculum-info">
                                                                        <p>Deskripsi :</p>
                                                                        <h3> <span>Start : 
                                                                            {{ \Carbon\Carbon::parse($item->examurai_datetimestart)->format('l - m F') }} ({{ $item->examurai_lamapengerjaan }} menit)
                                                                        </span></h3><br>
                                                                        <span>Keterangan :
                                                                            @if ($item->jawabanexamurai->count() < 1)
                                                                                Belum ada yang mengerjakan
                                                                            @else
                                                                                @php
                                                                                    $siswa_yang_mengerjakan = App\Models\Jawabanexamurai::where('kelas_id',$kelas->id)->where('guru_id', $guru->id)->select('siswa_id')->distinct()->get();
                                                                                @endphp
                                                                                Dikerjakan {{ $siswa_yang_mengerjakan->count() }}
                                                                                siswa
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                    <div class="course__curriculum-meta">
                                                                        <button class="btn btn-sm btn-info text-white" data-bs-toggle="modal"
                                                                        data-bs-target="#modaldaftaruraian" data-examurai_id="{{ $item->id }}"
                                                                        data-guru_id="{{ $guru->id }}" data-kelas_id="{{ $kelas->id }}">Periksa Jawaban</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- modal daftar uraian siswa --}}
    <div class="modal fade" id="modaldaftaruraian" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h4 class="modal-title" style="font-size: 16px; color:white">DAFTAR SISWA : <span id="header_tugas_name" class="text-uppercase"></span></h4>
                </div>
                <div class="modal-body">
                    <table id="example"
                    class="display responsive nowrap" style="width: 100%">
                        <thead>
                            <tr>
                                <th style="width: 10%">No</th>
                                <th>Nama Siswa</th>
                                <th>Nilai</th>
                                <th style="width: 10%">...</th>
                            </tr>
                        </thead>
                        <tbody class="text-capitalize">
                            {{-- data --}}
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="closemodaldaftaruraian" class="btn btn-sm btn-default"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.colVis.min.js"></script>

<script>
    $('#modaldaftaruraian').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var examurai_id = button.data('examurai_id')
        var guru_id = button.data('guru_id')
        var kelas_id = button.data('kelas_id')
        var modal = $(this)
        var table = $('#example').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: '/daftar-uraian-siswa/'+examurai_id+'/'+kelas_id+'/'+guru_id,
            columns: [{
                    "width": 10,
                    "data": null,
                    "sortable": false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: 'siswa_name',
                    name: 'siswa_name'
                },
                {
                    data: 'nilai',
                    name: 'nilai'
                },
                {
                    data: 'opsi',
                    name: 'opsi'
                },
            ]
        });
        
    });

    $('#closemodaldaftaruraian').on('click', function() {
        $('#modaldaftaruraian').modal('hide');
    });
</script>
@endsection
