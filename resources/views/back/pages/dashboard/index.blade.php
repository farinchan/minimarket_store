@extends('back.app')

@section('content')
    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  flex-column-fluid ">
        <div id="kt_app_content_container" class="app-container  container-fluid ">
            <div class="row g-5 gx-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-6 mb-md-5 mb-xl-10">
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            @include('back/partials/widgets/cards/_widget-8')
                            @include('back/partials/widgets/cards/_widget-5')
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 col-xl-6 mb-xxl-10">
                            @include('back/partials/widgets/cards/_widget-9')
                            @include('back/partials/widgets/cards/_widget-7')
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    @include('back/partials/widgets/maps/_widget-1')
                </div>
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    <div class="card card-flush h-md-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Transaksi Online Bulanan</span>
                                <span class="text-gray-500 pt-2 fw-semibold fs-6">Total transaksi online selama 30 hari
                                    terakhir</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-center">
                            <div id="chart_1" class="w-100"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    <div class="card card-flush h-md-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Barang Terjual Online Bulanan</span>
                                <span class="text-gray-500 pt-2 fw-semibold fs-6">Total barang terjual selama 30 hari
                                    terakhir</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-center">
                            <div id="chart_2" class="w-100"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    <div class="card card-flush h-md-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Transaksi Offline Bulanan</span>
                                <span class="text-gray-500 pt-2 fw-semibold fs-6">Total transaksi offline selama 30 hari
                                    terakhir</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-center">
                            <div id="chart_3" class="w-100"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <div class="col-xxl-6 mb-5 mb-xl-10">
                    <div class="card card-flush h-md-100">
                        <div class="card-header pt-7">
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Barang Terjual Offline Bulanan</span>
                                <span class="text-gray-500 pt-2 fw-semibold fs-6">Total barang terjual selama 30 hari
                                    terakhir</span>
                            </h3>
                        </div>
                        <div class="card-body d-flex flex-center">
                            <div id="chart_4" class="w-100"></div>
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
@endsection

@section('scripts')
    <script>
        var chart_minggu = new ApexCharts(document.querySelector("#chart_minggu"), {
            series: [{
                name: 'Transaksi Online',
                data: [0, 0, 0, 0, 0, 0, 0]
            }, {
                name: 'Transaksi Offline',
                data: [0, 0, 0, 0, 0, 0, 0]
            }],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['minggu', 'senin', 'selasa', 'rabu', 'kamis', 'jumat', 'sabtu'],
            },
            yaxis: {
                title: {
                    text: 'Rp. (Total Transaksi)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "Rp. " + val ;
                    }
                }
            }
        });
        chart_minggu.render();

        var chart_1 = new ApexCharts(document.querySelector("#chart_1"), {
            series: [{
                name: 'Transaksi (Rp.)',
                data: [0]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            // dataLabels: {
            //     enabled: true
            // },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Total Transaksi',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['x'],
            }
        });
        chart_1.render();

        var chart_2 = new ApexCharts(document.querySelector("#chart_2"), {
            series: [{
                name: 'Barang',
                data: [0]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Total Barang Terjual',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['x'],
            }
        });
        chart_2.render();

        var chart_3 = new ApexCharts(document.querySelector("#chart_3"), {
            series: [{
                name: 'Transaksi (Rp.)',
                data: [0]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Total Transaksi',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['x'],
            }
        });

        chart_3.render();

        var chart_4 = new ApexCharts(document.querySelector("#chart_4"), {
            series: [{
                name: 'Barang',
                data: [0]
            }],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: true
            },
            stroke: {
                curve: 'straight'
            },
            title: {
                text: 'Total Barang Terjual',
                align: 'left'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: ['x'],
            }
        });

        chart_4.render();


        $.ajax({
            url: "{{ route('back.ajax-dashboard') }}",
            type: "GET",
            success: function(response) {
                console.log(response);

                chart_minggu.updateSeries([
                    {
                        name: 'Transaksi Online',
                        data: response.mingguan.transaksi_online.map(function(item) {
                            return item.total;
                        })
                    },
                    {
                        name: 'Transaksi Offline',
                        data: response.mingguan.transaksi_offline.map(function(item) {
                            return item.total;
                        })
                    }
                ]);

                chart_1.updateSeries([{
                    data: response.transaksi_online_bulanan.map(function(item) {
                        return item.total;
                    }).reverse()
                }]);
                chart_1.updateOptions({
                    xaxis: {
                        categories: response.transaksi_online_bulanan.map(function(item) {
                            return item.date;
                        }).reverse()
                    }
                });
                chart_2.updateSeries([{
                    data: response.item_online_bulanan.map(function(item) {
                        return item.total;
                    }).reverse()
                }]);
                chart_2.updateOptions({
                    xaxis: {
                        categories: response.item_online_bulanan.map(function(item) {
                            return item.date;
                        }).reverse()
                    }
                });
                chart_3.updateSeries([{
                    data: response.transaksi_offline_bulanan.map(function(item) {
                        return item.total;
                    }).reverse()
                }]);

                chart_3.updateOptions({
                    xaxis: {
                        categories: response.transaksi_offline_bulanan.map(function(item) {
                            return item.date;
                        }).reverse()
                    }
                });

                chart_4.updateSeries([{
                    data: response.item_offline_bulanan.map(function(item) {
                        return item.total;
                    }).reverse()
                }]);

                chart_4.updateOptions({
                    xaxis: {
                        categories: response.item_offline_bulanan.map(function(item) {
                            return item.date;
                        }).reverse()
                    }
                });
            }
        });
    </script>
@endsection
