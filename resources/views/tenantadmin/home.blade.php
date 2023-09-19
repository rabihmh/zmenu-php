<x-tenant-admin-layout title="Home">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Earnings (Monthly)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{$earnings}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--        <!-- Earnings (Monthly) Card Example -->--}}
        {{--        <div class="col-xl-3 col-md-6 mb-4">--}}
        {{--            <div class="card border-left-success shadow h-100 py-2">--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="row no-gutters align-items-center">--}}
        {{--                        <div class="col mr-2">--}}
        {{--                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">--}}
        {{--                                Earnings (Annual)--}}
        {{--                            </div>--}}
        {{--                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>--}}
        {{--                        </div>--}}
        {{--                        <div class="col-auto">--}}
        {{--                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}

        {{--        <!-- Earnings (Monthly) Card Example -->--}}
        {{--        <div class="col-xl-3 col-md-6 mb-4">--}}
        {{--            <div class="card border-left-info shadow h-100 py-2">--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="row no-gutters align-items-center">--}}
        {{--                        <div class="col mr-2">--}}
        {{--                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks--}}
        {{--                            </div>--}}
        {{--                            <div class="row no-gutters align-items-center">--}}
        {{--                                <div class="col-auto">--}}
        {{--                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>--}}
        {{--                                </div>--}}
        {{--                                <div class="col">--}}
        {{--                                    <div class="progress progress-sm mr-2">--}}
        {{--                                        <div class="progress-bar bg-info" role="progressbar"--}}
        {{--                                             style="width: 50%" aria-valuenow="50" aria-valuemin="0"--}}
        {{--                                             aria-valuemax="100"></div>--}}
        {{--                                    </div>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                        <div class="col-auto">--}}
        {{--                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        @foreach($ordersCountByStatus as $count)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    {{$count['status']}} Orders
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$count['count']}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>

                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Orders Overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-primary"></i> Pending
                                        </span>
                        <span class="mr-2">
                                            <i class="fas fa-circle text-success"></i> Canceled
                                        </span>
                        <span class="mr-2">
                                            <i class="fas fa-circle text-info"></i> Completed
                                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $count_array=[];
    @endphp
    @foreach($ordersCountByStatus as $count)
        @php
            $count_array[] = $count['count'];
        @endphp
    @endforeach

    @push('js')
        <script>
            let earnings = @json($earningsByMonth);
            let count_array =@json($count_array)
        </script>
        <script src="{{asset('dashboard/vendor/chart.js/Chart.min.js')}}"></script>
        <script src="{{asset('dashboard/js/demo/chart-area-demo.js')}}"></script>
        <script src="{{asset('dashboard/js/demo/chart-pie-demo.js')}}"></script>
    @endpush
</x-tenant-admin-layout>
