@extends('backend.layouts.template')

@section('pageTitle','Dashboard')

@push('customCss')

@endpush

@section('content')
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->

        <!-- BEGIN PAGE BAR -->
        <div class="page-bar" style="padding:10px 0px;">
            <div class="col-md-1 label-control"><span style="margin-top: 7px;font-size: 16px;font-weight: bold;">Filter</span></div>
            <form method="GET" action="{{route('admin.dashboard')}}">
                <div class="col-md-4">
                    <div class="input-group input-date-range" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                        <input id="dateFrom" name="dateFrom" type="text" value="{{@$dateFrom}}" class="datepickerinput form-control">
                        <span class="input-group-addon">To</span>
                        <input id="dateTo" name="dateTo" type="text" value="{{@$dateTo}}" class="datepickerinput form-control">
                    </div>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-success">Filter</button>
                </div>
            </form>
            <div class="col-md-6 label-control pull-right" style="text-align: right;">
                <span style="margin-top: 7px;font-size: 16px;font-weight: bold;">{{date('D, d F Y')}}</span>
            </div>
        </div>
        <!-- END PAGE BAR -->
        <!-- page content -->
        <div class="row portlet-body">
            <div class="col-lg-12 text-center">
                <br>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 blue" href="{{route('admin.products')}}">
                        <div class="visual">
                            <i class="fa fa-tag"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$product)}}</span>
                            </div>
                            <div class="desc">Produk</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 green" href="{{route('admin.orders')}}">
                        <div class="visual">
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$order)}}</span>
                            </div>
                            <div class="desc">Pesanan</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 yellow" href="{{route('admin.orders')}}">
                        <div class="visual">
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$income)}}</span>
                            </div>
                            <div class="desc">Total Pemasukan</div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a class="dashboard-stat dashboard-stat-v2 red" href="{{route('admin.orders')}}">
                        <div class="visual">
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="details">
                            <div class="number">
                                <span>{{number_format(@$outcome)}}</span>
                            </div>
                            <div class="desc">Total Modal</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="container"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>

@endsection

@push('customJs')

    <script src="{{url('backend/assets/global/highchart/highcharts.js')}}"></script>
    <script src="{{url('backend/assets/global/highchart/series-label.js')}}"></script>
    <script src="{{url('backend/assets/global/highchart/exporting.js')}}"></script>
    <script src="{{url('backend/assets/global/highchart/export-data.js')}}"></script>

    <script>
        var label = [];
        var value = [];

        @foreach($chart as $crt)
        label.push('{{$crt['periode']}}');
        value.push({{$crt['value']}});
        @endforeach
        Highcharts.chart('container', {
            chart: {
                type: 'line'
            },
            title: {
                text: 'Grafik Pesanan Selama Setahun'
            },
            subtitle: {
                text: 'Jumlah'
            },
            xAxis: {
                categories: label
            },
            yAxis: {
                title: {
                    text: 'Total Pesanan'
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                }
            },
            tooltip: {
                //pointFormat: "Rp {point.y:.2f}"
            },
            series: [{
                name: 'Order',
                data: value
            }]
        });
    </script>
@endpush
