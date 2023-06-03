@extends('be_layouts.be_master')


@section('content')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #ebebeb;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }
    </style>

    <div class="page has-sidebar-left height-full">
        <header class="blue accent-3 relative nav-sticky">
            <div class="container-fluid text-white">
                <div class="row p-t-b-10 ">
                    <div class="col">
                        <h4>
                            <i class="icon-box"></i>
                            Dashboard
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
                <div class="tab-pane animated fadeInUpShort  active" id="v-pills-1">
                    <div class="row my-3">
                        <div class="col-md-4" style="margin-bottom: 10px">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-stop-watch3 s-48"></span>
                                    </div>
                                    <div class="counter-title">Total User Online</div>
                                    <h5 id="total"></h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom: 10px">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-note-list s-48"></span>
                                    </div>
                                    <div class="counter-title">Total User Akses</div>
                                    <h5 id="total_akses"></h5>
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4" style="margin-bottom: 10px">
                            <div class="counter-box white r-5 p-3">
                                <div class="p-4">
                                    <div class="float-right">
                                        <span class="icon icon-inbox-document-text s-48"></span>
                                    </div>
                                    <small>Lihat Data User Akses</small>
                                    <input type="date" id="tanggal_akses" class="form-control" style="width:70%; height: 25px;">
                                </div>
                                <div class="progress progress-xs r-0">
                                    <div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="25"
                                        aria-valuemin="0" aria-valuemax="128"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4">
                        <figure class="highcharts-figure">
                            <div id="container" style="min-height: 405px; width:100%"></div>
                        </figure>
                    </div>

                    <div class="col-xl-8">
                        <figure class="highcharts-figure">
                            <div id="container2" style="min-height: 405px; width:100%"></div>
                        </figure>
                    </div>

                    <div class="col-md-12">
                        <div class="card my-3 no-b ">
                            <div class="card-header white b-0 p-3">
                                <div class="card-handle">
                                    <a data-toggle="collapse" href="#salesCard" aria-expanded="false"
                                        aria-controls="salesCard">
                                        <i class="icon-menu"></i>
                                    </a>
                                </div>
                                <small class="card-subtitle mb-2 text-muted">Display the last 4 online user (proses
                                    kalkulasi data dalam 30 sec & keep online in 2 min)</small>
                            </div>
                            <style>
                                table.dataTable td {
                                    padding: 5px;
                                }

                                table.dataTable thead {
                                    font-size: 16px !important;
                                }

                                td {
                                    text-align: left;
                                }
                            </style>

                            <div class="collapse show" id="salesCard">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover earning-box" id="tabel-user">
                                            <thead class="bg-light">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Username</th>
                                                    <th>Last Seen</th>
                                                    <th>Status</th>
                                                    <th>Waktu Login</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modaladd" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header" style="background-color: rgb(93, 154, 233);">
                    <h4 class="modal-title" style="font-size: 16px; color:white">DATA USER AKSES : <span class="text-uppercase" id="tanggal_akses_text"></span></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-12" style="margin-bottom: 10px" id="block-new-jurusan">
                            <table class="table table-hover earning-box" id="tabel-user-akses" style="width:100%">
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Waktu Login</th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


    <script>
        // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar
        // Create the chart
    </script>

    <script>
        $(document).ready(function() {
            $('#tanggal_akses').on('change',function(){
                $('#tanggal_akses_text').html(this.value);
                $('#modaladd').modal('show');
                var table = $('#tabel-user-akses').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: "/data-user-akses/"+this.value,
                    columns: [
                        {
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'username2',
                            name: 'username2'
                        },
                        {
                            data: 'login_time',
                            name: 'login_time',
                        }
                    ]
                });
            })

            $.ajax({
                type: 'GET',
                url: '/user-akses',
                success: function(response) {
                    if (response.total.length == 1) {
                        $('#total_akses').html('0' + response.total + ' User');
                    } else {
                        $('#total_akses').html(response.total + ' User');
                    }
                    Highcharts.chart('container2', {
                        chart: {
                            type: 'spline'
                        },
                        title: {
                            text: 'Realtime User Akses'
                        },
                        subtitle: {
                            text: 'Grafik user akses tiap hari dalam sepekan'
                        },
                        xAxis: {
                            categories: response.tanggal,
                            accessibility: {
                                description: 'Tanggal Akses'
                            }
                        },
                        yAxis: {
                            title: {
                                text: 'Total User Akses'
                            },
                            labels: {
                                formatter: function() {
                                    return this.value + '°';
                                }
                            }
                        },
                        tooltip: {
                            crosshairs: true,
                            shared: true
                        },
                        plotOptions: {
                            spline: {
                                marker: {
                                    radius: 4,
                                    lineColor: '#666666',
                                    lineWidth: 1
                                }
                            }
                        },
                        series: [{
                            name: 'User yang mengakses',
                            marker: {
                                symbol: 'square'
                            },
                            data: response.total

                        }]
                    });
                }
            });


            $.ajax({
                type: 'GET',
                url: '/total-user-online',
                success: function(response) {
                    let total = '' + response.data;
                    if (total.length == 1) {
                        $('#total').html('0' + total + ' User');
                    } else {
                        $('#total').html(total + ' User');
                    }

                    console.log(response);

                    Highcharts.chart('container', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            align: 'left',
                            text: 'Realtime Online User'
                        },
                        subtitle: {
                            align: 'left',
                            text: 'keep online for 2 min'
                        },
                        accessibility: {
                            announceNewData: {
                                enabled: true
                            }
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            title: {
                                text: 'Total online user'
                            }

                        },
                        legend: {
                            enabled: false
                        },
                        plotOptions: {
                            series: {
                                borderWidth: 0,
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.y:.0f}'
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                        },

                        series: [{
                            name: 'Browsers',
                            colorByPoint: true,
                            data: [{
                                    name: 'Online',
                                    y: response.data,
                                },
                                {
                                    name: 'Offline',
                                    y: response.offline,
                                },
                            ]
                        }],
                    });
                }
            });

            var table = $('#tabel-user').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: "/data-user-online",
                    columns: [
                        {
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'username2',
                            name: 'username2'
                        },
                        {
                            data: 'last_seen',
                            name: 'last_seen'
                        },
                        {
                            data: 'online',
                            name: 'online',
                        },
                        {
                            data: 'login_time',
                            name: 'login_time',
                        }
                    ]
                });


            total_user_online();
            last_4_online_user();
            chart();
            user_akses();

        })

        function total_user_online() {
            setInterval(function() {
                // your code goes here...
                $.ajax({
                    type: 'GET',
                    url: '/total-user-online',
                    success: function(response) {
                        let total = '' + response.data;
                        if (total.length == 1) {
                            $('#total').html('0' + total + ' User');
                        } else {
                            $('#total').html(total + ' User');
                        }
                    }
                });
            }, 60 * 1000); // 60 * 1000 milsec
        }

        function chart() {
            setInterval(function() {
                $.ajax({
                    type: 'GET',
                    url: '/total-user-online',
                    success: function(response) {
                        let total = '' + response.data;
                        if (total.length == 1) {
                            $('#total').html('0' + total + ' User');
                        } else {
                            $('#total').html(total + ' User');
                        }

                        console.log(response);

                        Highcharts.chart('container', {
                            chart: {
                                type: 'column'
                            },
                            title: {
                                align: 'left',
                                text: 'Realtime Online User'
                            },
                            subtitle: {
                                align: 'left',
                                text: 'keep online for 2 min'
                            },
                            accessibility: {
                                announceNewData: {
                                    enabled: true
                                }
                            },
                            xAxis: {
                                type: 'category'
                            },
                            yAxis: {
                                title: {
                                    text: 'Total online user'
                                }

                            },
                            legend: {
                                enabled: false
                            },
                            plotOptions: {
                                series: {
                                    borderWidth: 0,
                                    dataLabels: {
                                        enabled: true,
                                        format: '{point.y:.0f}'
                                    }
                                }
                            },

                            tooltip: {
                                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                            },

                            series: [{
                                name: 'Browsers',
                                colorByPoint: true,
                                data: [{
                                        name: 'Online',
                                        y: response.data,
                                    },
                                    {
                                        name: 'Offline',
                                        y: response.offline,
                                    },
                                ]
                            }],
                        });
                    }
                });
            }, 30 * 1000); // 60 * 1000 milsec
        }

        function last_4_online_user() {
            setInterval(function() {
                var table = $('#tabel-user').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    ajax: "/data-user-online",
                    columns: [
                        {
                            "data": null,
                            "sortable": false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'username2',
                            name: 'username2'
                        },
                        {
                            data: 'last_seen',
                            name: 'last_seen'
                        },
                        {
                            data: 'online',
                            name: 'online',
                        },
                        {
                            data: 'login_time',
                            name: 'login_time',
                        }
                    ]
                });
            }, 30 * 1000); // 60 * 1000 milsec
        }

        function user_akses() {
            setInterval(function() {
                $.ajax({
                    type: 'GET',
                    url: '/user-akses',
                    success: function(response) {
                        if (response.total.length == 1) {
                            $('#total_akses').html('0' + response.total + ' User');
                        } else {
                            $('#total_akses').html(response.total + ' User');
                        }
                        Highcharts.chart('container2', {
                            chart: {
                                type: 'spline'
                            },
                            title: {
                                text: 'Realtime User Akses'
                            },
                            subtitle: {
                                text: 'Grafik user akses tiap hari dalam sepekan'
                            },
                            xAxis: {
                                categories: response.tanggal,
                                accessibility: {
                                    description: 'Tanggal Akses'
                                }
                            },
                            yAxis: {
                                title: {
                                    text: 'Total User Akses'
                                },
                                labels: {
                                    formatter: function() {
                                        return this.value + '°';
                                    }
                                }
                            },
                            tooltip: {
                                crosshairs: true,
                                shared: true
                            },
                            plotOptions: {
                                spline: {
                                    marker: {
                                        radius: 4,
                                        lineColor: '#666666',
                                        lineWidth: 1
                                    }
                                }
                            },
                            series: [{
                                name: 'User yang mengakses',
                                marker: {
                                    symbol: 'square'
                                },
                                data: response.total

                            }]
                        });
                    }
                });
            }, 30 * 1000); // 60 * 1000 milsec
        }
    </script>
@endsection
