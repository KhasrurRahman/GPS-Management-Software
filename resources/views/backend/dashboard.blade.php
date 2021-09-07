@extends('backend.layout.app')
@section('title','Dashboard')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Dashboard')
@section('link',route('admin.adminDashboard'))
@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3 class="count">{{count($order)}}</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sort-amount-up-alt"></i>
                </div>
                <a href="{{route('admin.order.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3 class="count">{{count($registered_user)}}</h3>

                    <p>Total registered user</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{route('admin.all_user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3 class="count">{{$total_collected_amount}}</h3>

                    <p>Total Collected Amount</p>
                </div>
                <div class="icon">
                    <i class="far fa-money-bill-alt"></i>
                </div>
                <a href="{{route('admin.billing_history')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
{{--        <div class="col-lg-3 col-6">--}}
{{--            <!-- small box -->--}}
{{--            <div class="small-box bg-danger">--}}
{{--                <div class="inner">--}}
{{--                    <h3 class="count">{{$total_device_sale}}</h3>--}}

{{--                    <p>Total Device Sale</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fas fa-tablet"></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('admin.device_sell_history')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}


        <div class="col-lg-4 col-6">
            <div class="small-box bg-gradient-orange">
                <div class="inner">
                    <h3 class="count">{{$total_expair_user}}</h3>
                    <p>Total Expire user</p>
                </div>
                <div class="icon">
                    <i class="fas fa-people-carry"></i>
                </div>
                <a href="{{route('admin.all_user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <div class="col-lg-4 col-6">
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3 class="count">{{$total_due_user}}</h3>
                    <p>Total Due user</p>
                </div>
                <div class="icon">
                    <i class="fas fa-people-carry"></i>
                </div>
                <a href="{{route('admin.due_user')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <div class="col-lg-4 col-6">
            <div class="small-box bg-gradient-blue">
                <div class="inner">
                    <h3 class="count">{{$today_collected_bill}}</h3>
                    <p>Today Collected Bill</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill"></i>
                </div>
                <a href="{{route('admin.billing_history')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>


{{--        <div class="col-lg-3 col-6">--}}
{{--            <div class="small-box bg-fuchsia">--}}
{{--                <div class="inner">--}}
{{--                    <h3 class="count">{{$total_device_sale_tk}}</h3>--}}
{{--                    <p>Total Device Sell Amount(Tk)</p>--}}
{{--                </div>--}}
{{--                <div class="icon">--}}
{{--                    <i class="fas fa-people-carry"></i>--}}
{{--                </div>--}}
{{--                <a href="{{route('admin.device_transaction_history')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
{{--            </div>--}}
{{--        </div>--}}
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        @include('backend.technician.dashboard_report')


    </div>

@endsection
@push('js')
    <script>
        var background = ["rgba(255, 99, 132, 0.6)", "rgba(54, 162, 235, 0.6)", "rgba(255, 206, 86, 0.6)", "rgb(74,179,29,0.6)", "rgba(153, 102, 255, 0.6)", "rgba(179,61,85,0.6)", "rgb(176,20,93,0.6)", "rgb(28,151,208,0.6)", "rgba(75, 192, 192, 0.6)", "rgba(153, 102, 255, 0.6)", "rgb(229,121,27,0.6)", "rgb(235,60,54,0.6)", "rgb(53,186,24,0.6)", "rgb(8,37,79,0.6)", "rgba(153, 102, 255, 0.6)", "rgba(179,61,85,0.6)", "rgb(7,33,165,0.6)", "rgb(25,27,29,0.6)", "rgb(116,44,196,0.6)", "rgb(96,7,102,0.6)", "rgba(255, 99, 132, 0.6)", "rgba(54, 162, 235, 0.6)", "rgb(100,110,21,0.6)", "rgb(31,134,58,0.6)", "rgba(92,0,255,0.6)", "rgb(131,23,113,0.6)", "rgb(96,233,56,0.6)", "rgb(28,151,208,0.6)", "rgb(190,170,10,0.6)", "rgba(67,22,155,0.6)", "rgb(229,121,27,0.6)", "rgba(117,26,24,0.6)", "rgb(53,186,24,0.6)", "rgb(8,37,79,0.6)", "rgba(153, 102, 255, 0.6)", "rgb(246,0,255)", "rgb(62,167,33,0.6)", "rgb(153,9,9,0.6)", "rgb(11,185,217,0.6)", "rgb(96,7,102,0.6)","rgba(255, 99, 132, 0.6)", "rgba(54, 162, 235, 0.6)", "rgba(255, 206, 86, 0.6)", "rgb(74,179,29,0.6)", "rgba(153, 102, 255, 0.6)", "rgba(179,61,85,0.6)", "rgb(176,20,93,0.6)", "rgb(28,151,208,0.6)", "rgba(75, 192, 192, 0.6)", "rgba(153, 102, 255, 0.6)", "rgb(229,121,27,0.6)", "rgb(235,60,54,0.6)", "rgb(53,186,24,0.6)", "rgb(8,37,79,0.6)", "rgba(153, 102, 255, 0.6)", "rgba(179,61,85,0.6)", "rgb(7,33,165,0.6)", "rgb(25,27,29,0.6)", "rgb(116,44,196,0.6)", "rgb(96,7,102,0.6)", "rgba(255, 99, 132, 0.6)", "rgba(54, 162, 235, 0.6)", "rgb(100,110,21,0.6)", "rgb(31,134,58,0.6)", "rgba(92,0,255,0.6)", "rgb(131,23,113,0.6)", "rgb(96,233,56,0.6)", "rgb(28,151,208,0.6)", "rgb(190,170,10,0.6)", "rgba(67,22,155,0.6)", "rgb(229,121,27,0.6)", "rgba(117,26,24,0.6)", "rgb(53,186,24,0.6)", "rgb(8,37,79,0.6)", "rgba(153, 102, 255, 0.6)", "rgb(246,0,255)", "rgb(62,167,33,0.6)", "rgb(153,9,9,0.6)", "rgb(11,185,217,0.6)", "rgb(96,7,102,0.6)",];
        background = background.sort(() => Math.random() - 0.5);

        // payment chart
        $.ajax({
            url: "{{url('/dashboardreport')}}/onlinepayment",
            type: "GET",
            data: {},
            success: function (response) {
                var ctx = document.getElementById('payment_history').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: response.lebel,
                        datasets: [{
                            label: 'Total Amount',
                            data: response.data,
                            backgroundColor: background,
                            borderColor: ['rgba(255,99,132,1)',],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
        });
        
        // manual payment chart
        $.ajax({
            url: "{{url('/dashboardreport')}}/manual_payment",
            type: "GET",
            data: {},
            success: function (response) {
                var ctx = document.getElementById('manual_payment_history').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: response.lebel,
                        datasets: [{
                            label: 'Total Amount',
                            data: response.data,
                            backgroundColor: background,
                            borderColor: ['rgba(255,99,132,1)',],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
        });


        $('.count').each(function () {
            $(this).prop('Counter', 0).animate({
                Counter: $(this).text()
            }, {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                    $(this).text(Math.ceil(now));
                }
            });
        });
    </script>




@endpush

