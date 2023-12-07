@extends('be_layouts.be_master')


@section('content')
    <style>
        .highcharts-figure,
        .highcharts-data-table table {
            min-width: auto;
            max-width: 100%;
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
            max-width: 100px;
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
                            Parameter Online User
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
                <div class="loading text-center mt-5">
                    <h1>Loading ...</h1>
                </div>

                <div class="tab-pane animated fadeInUpShort  active" id="v-pills-1">
                    <div class="row my-3">
                        <div class="col-md-12" style="margin-bottom: 10px">
                            <figure class="highcharts-figure">
                                <div id="container"></div>
                            </figure>
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
        

        (async () => {

            // setInterval(function() {
                $.ajax({
                    type: 'GET',
                    url: '/data-user-online-tiap-kelas',
                    success: function(response) {
                        $('.loading').addClass('d-none');

                        var kelasNames = response.total_perkelas.map(function(item) {
                            return item.kelas_name;
                        });
                        var totalOnline = response.total_perkelas.map(function(item) {
                            return item.total;
                        });

                        bar_chart(kelasNames, totalOnline)                        
                    }
                });
            // }, 120 * 1000); // 60 * 1000 milsec
    
        })();


        function bar_chart(kelasNames, totalOnline) {
            Highcharts.chart('container', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Parameter Siswa Online',
                    align: 'left'
                },
                subtitle: {
                    text: 'Catatan : <a ' +
                        'href="#siswa_online"' +
                        '>siswa online dengan behavior aktifitas siswa selama 2 menit kebelakang</a> <br> <p class="text-danger">Apabila kosong, belum ada siswa yang beraktifitas</p>',
                    align: 'left'
                },
                xAxis: {
                    categories: kelasNames,
                    title: {
                        text: null
                    },
                    gridLineWidth: 1,
                    lineWidth: 0,
                    labels: {
                        step: 1, // Atur langkah antara label
                        style: {
                            fontSize: '12px' // Atur gaya label
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Online (siswa)',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    },
                    gridLineWidth: 0
                },
                tooltip: {
                    valueSuffix: ' siswa'
                },
                plotOptions: {
                    bar: {
                        borderRadius: '50%',
                        dataLabels: {
                            enabled: true
                        },
                        pointPadding: 0.1, // Atur jarak antara batang
                        groupPadding: 0.1, // Atur jarak antara grup batang
                        pointWidth: 30 // Atur lebar batang
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -40,
                    y: 100,
                    floating: true,
                    borderWidth: 1,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
                    shadow: true
                },
                credits: {
                    enabled: false
                },
                series: [{
                    name: 'Total Siswa Online',
                    data: totalOnline
                }]
            });
        }
   </script>
@endsection
