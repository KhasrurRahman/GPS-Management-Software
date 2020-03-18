
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
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{count($order)}}</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="fas fa-sort-amount-up-alt"></i>
              </div>
              <a href="{{route('admin.order.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{count($registered_user)}}</h3>

                <p>Total registered user</p>
              </div>
              <div class="icon">
                <i class="fas fa-users"></i>
              </div>
              <a href="{{route('admin.all_user.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$total_collected_amount}}</h3>

                <p>Total Collected Amount</p>
              </div>
              <div class="icon">
               <i class="far fa-money-bill-alt"></i>
              </div>
              <a href="{{route('admin.all_bill_schedule')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$total_device_sale}}</h3>

                  <p>Total Device Sale</p>
              </div>
              <div class="icon">
                <i class="fas fa-tablet"></i>
              </div>
              <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


            <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-orange">
              <div class="inner">
                <h3>{{$total_expair_user}}</h3>
                  <p>Total Expire user</p>
              </div>
              <div class="icon">
                <i class="fas fa-people-carry"></i>
              </div>
              <a href="{{route('admin.expire_user')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


            <div class="col-lg-3 col-6">
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{$total_due_user}}</h3>
                  <p>Total Due user</p>
              </div>
              <div class="icon">
                <i class="fas fa-people-carry"></i>
              </div>
              <a href="{{route('admin.due_user')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>



            <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-blue">
              <div class="inner">
                <h3>{{$today_collected_bill}}</h3>
                  <p>Today Collected Bill</p>
              </div>
              <div class="icon">
                <i class="fas fa-money-bill"></i>
              </div>
              <a href="{{route('admin.all_bill_schedule')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


            <div class="col-lg-3 col-6">
            <div class="small-box bg-fuchsia">
              <div class="inner">
                <h3>{{$total_device_sale_tk}}</h3>
                  <p>Total Device Sell Amount(Tk)</p>
              </div>
              <div class="icon">
                <i class="fas fa-people-carry"></i>
              </div>
              <a href="{{route('admin.device_transaction_history')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">

           <div class="col-md-12">
            <!-- Bar chart -->
            <!-- AREA CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Billing Chart (Last 30 days)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->

            <div class="col-md-12">
            <!-- Bar chart -->
            <!-- AREA CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Sales Graph (Last 30 days)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->

            <!-- /.card -->
          </div>
          <!-- /.col -->
          <!-- Left col -->




{{--            bill schedule--}}
<div class="col-md-12">
             <div class="card">
              <div class="card-header border-transparent">
                <h3 class="card-title">Todays Billing Schedule</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table m-0">
                    <thead>
                    <tr>
                  <th>Id</th>
                  <th>User Name</th>
                  <th>Schedule date</th>
                  <th>Note</th>
                  <th>Created time</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($schedule as $key=>$data)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>
                                @php($user = \App\AllUser::find($data->user_id))
                                {{$user->name}}
                            </td>
                            <td>{{date("jS  F Y", strtotime($data->date))}}</td>
                            <td>{{$data->note}}</td>
                            <td>{{date("jS  F Y - h:i:s A", strtotime($data->created_at))}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>User Name</th>
                  <th>Schedule date</th>
                  <th>Note</th>
                  <th>Created time</th>
                </tr>

                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>

        </div>
</div>

        <!-- /.row (main row) -->
@endsection
@push('js')


    <script>
  $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //--------------
      //- AREA CHART -
      //--------------

      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $('#areaChart').get(0).getContext('2d');

      var areaChartData = {
          labels: [

              @foreach($day_by_day_payment_history as $data)
              '{{date("M-j",strtotime($data->first()->created_at))}}',
              @endforeach
          ],
          datasets: [
              {
                  label: 'Digital Goods',
                  backgroundColor: 'rgb(40,167,69)',
                  borderColor: 'rgb(167,1,0)',
                  pointRadius: true,
                  pointColor: '#3b8bba',
                  pointStrokeColor: 'rgba(60,141,188,1)',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: [
                      @foreach($day_by_day_payment_history as $data2)
                      <?php echo $data2->sum('payment_this_date') ?>,
                      @endforeach
                  ]
              },
              // {
              //     label: 'Electronics',
              //     backgroundColor: 'rgba(210, 214, 222, 1)',
              //     borderColor: 'rgba(210, 214, 222, 1)',
              //     pointRadius: false,
              //     pointColor: 'rgba(210, 214, 222, 1)',
              //     pointStrokeColor: '#c1c7d1',
              //     pointHighlightFill: '#fff',
              //     pointHighlightStroke: 'rgba(220,220,220,1)',
              //     data: [65, 59, 80, 81, 56, 55, 40,65, 59, 80, 81, 56, 55, 40]
              // },
          ]
      };

      var areaChartOptions = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
              display: false
          },
          scales: {
              xAxes: [{
                  gridLines: {
                      display: false,
                  }
              }],
              yAxes: [{
                  gridLines: {
                      display: false,
                  }
              }]
          }
      }

      // This will get the first returned node in the jQuery collection.
      var areaChart = new Chart(areaChartCanvas, {
          type: 'line',
          data: areaChartData,
          options: areaChartOptions
      })
  });
  $(function () {
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //--------------
      //- AREA CHART -
      //--------------

      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $('#areaChart2').get(0).getContext('2d');

      var areaChartData = {
          labels: [

              @foreach($day_by_day_sales_history as $data)
              '{{date("M-j",strtotime($data->first()->created_at))}}',
              @endforeach
          ],
          datasets: [
              {
                  label: 'Digital Goods',
                  backgroundColor: 'rgb(23,162,184)',
                  borderColor: 'rgb(23,162,184)',
                  pointRadius: false,
                  pointColor: '#3b8bba',
                  pointStrokeColor: 'rgba(60,141,188,1)',
                  pointHighlightFill: '#fff',
                  pointHighlightStroke: 'rgba(60,141,188,1)',
                  data: [
                      @foreach($day_by_day_sales_history as $data2)
                      <?php echo $data2->sum('quantity') ?>,
                      @endforeach
                  ]
              },
              // {
              //     label: 'Electronics',
              //     backgroundColor: 'rgba(210, 214, 222, 1)',
              //     borderColor: 'rgba(210, 214, 222, 1)',
              //     pointRadius: false,
              //     pointColor: 'rgba(210, 214, 222, 1)',
              //     pointStrokeColor: '#c1c7d1',
              //     pointHighlightFill: '#fff',
              //     pointHighlightStroke: 'rgba(220,220,220,1)',
              //     data: [65, 59, 80, 81, 56, 55, 40,65, 59, 80, 81, 56, 55, 40]
              // },
          ]
      };

      var areaChartOptions = {
          maintainAspectRatio: false,
          responsive: true,
          legend: {
              display: false
          },
          scales: {
              xAxes: [{
                  gridLines: {
                      display: false,
                  }
              }],
              yAxes: [{
                  gridLines: {
                      display: false,
                  }
              }]
          }
      }

      // This will get the first returned node in the jQuery collection.
      var areaChart = new Chart(areaChartCanvas, {
          type: 'line',
          data: areaChartData,
          options: areaChartOptions
      })
  });
    </script>




@endpush

