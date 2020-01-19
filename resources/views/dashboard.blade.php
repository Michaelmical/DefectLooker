@extends('layouts.admin')

@push('ui')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-thumbtack"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Task Completed</span>
                            <span class="info-box-number">{{$countTask}}
{{--                  10--}}
{{--                  <small>%</small>--}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-atom"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Function Points</span>
                            <span class="info-box-number">{{$countFP}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-diagnoses"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Defects</span>
                            <span class="info-box-number">{{$countDefects}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Select Project</label>
                        <select class="form-control select2bs4" style="width: 100%;" id="selProj">
                            @foreach($existingProject as $aData)
                            <option value="{{ $aData->proj_id }}">&nbsp;{{ $aData->proj_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- /.col (LEFT) -->
                <div class="col-md-12">
                    <!-- LINE CHART -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Actual Defects Against Defects Threshold</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
{{--                                <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>--}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="lineChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col (RIGHT) -->
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="trBuild">
                                        <th class="dont"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="trMaxDefects">
                                        <td class="dont">Max Defects</td>
                                    </tr>
                                    <tr class="trActualDefects">
                                        <td class="dont">Actual Defects</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>


    </section>

@endsection

@push('addons')
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{asset('plugins/select2/js/select2.full.min.js')}}"></script>
<script>

    $('.select2').select2();
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    $('#selProj').on('change', function () {
        var iProjId = $(this).val();
        showLineChart(iProjId)
    });

    function showLineChart(proj_id) {
        $.ajax({
            url: '/showLineChart',
            data: {
                iProjID : proj_id
            },
            success : function (data) {
                displayLineChart(data.build, data.actual);
            }
        });
    }

    showLineChart($('#selProj').val());

    function displayLineChart(aData, aActual) {
        var aLabels = [];
        var aMaxDefects = [];
        var aAct = [];
        $.each(aData, function (index, value) {
            var sBuild = value.descr.split('.')[0];
            if ($.inArray(sBuild, aLabels) >= 0) {
                aMaxDefects[aLabels.indexOf(sBuild)] = parseFloat(aMaxDefects[aLabels.indexOf(sBuild)]) + parseFloat(value.allowable);
            } else {
                aLabels.push(sBuild);
                aMaxDefects.push(value.allowable);
                aAct.push(0);
            }
        });

        $.each(aActual, function (i, v) {
            var sBuild2 = v.descr.split('.')[0];
            if ($.inArray(sBuild2, aLabels) >= 0) {
                aAct[aLabels.indexOf(sBuild2)] = parseFloat(aAct[aLabels.indexOf(sBuild2)]) + parseFloat(v.actual);
            }
        });

        console.log(aLabels)
        console.log(aMaxDefects)
        console.log(aAct)
        $('.trBuild').empty();
        $('.trBuild').append('<th></th>');
        $.each(aLabels, function (ind, val) {
            $('.trBuild').append('<th>' + val + '</th>');
        });
        $('.trMaxDefects').empty();
        $('.trMaxDefects').append('<td>Max Defects</td>');
        $.each(aMaxDefects, function (ind, val) {
            $('.trMaxDefects').append('<td>' + val + '</td>');
        });
        $('.trActualDefects').empty();
        $('.trActualDefects').append('<td>Actual Defects</td>');
        $.each(aAct, function (ind, val) {
            $('.trActualDefects').append('<td>' + val + '</td>');
        });

        var areaChartData = {
            labels  : aLabels,
            datasets: [
                {
                    label               : 'Max Defects',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : true,
                    pointColor          : '#3b8bba',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : aMaxDefects
                },
                {
                    label               : 'Actual Defects',
                    backgroundColor     : 'rgba(210, 214, 222, 1)',
                    borderColor         : 'rgba(210, 214, 222, 1)',
                    pointRadius         : true,
                    pointColor          : 'rgba(210, 214, 222, 1)',
                    pointStrokeColor    : '#c1c7d1',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(220,220,220,1)',
                    data                : aAct
                },
            ]
        };

        var areaChartOptions = {
            maintainAspectRatio : false,
            responsive : true,
            legend: {
                display: true
            },
            scales: {
                xAxes: [{
                    gridLines : {
                        display : true,
                    }
                }],
                yAxes: [{
                    gridLines : {
                        display : true,
                    }
                }]
            }
        };

        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
        var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
        var lineChartData = jQuery.extend(true, {}, areaChartData)
        lineChartData.datasets[0].fill = false;
        lineChartData.datasets[1].fill = false;
        lineChartOptions.datasetFill = false

        var lineChart = new Chart(lineChartCanvas, {
            type: 'line',
            data: lineChartData,
            options: lineChartOptions
        })
    }

</script>
@endpush
