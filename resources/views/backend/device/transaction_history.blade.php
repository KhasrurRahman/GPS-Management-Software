@extends('backend.layout.app')
@section('title','Transaction history')
@push('css')
          <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Transaction history')
@section('link',route('admin.adminDashboard'))
@section('content')



<div class="card">

            <div class="card-header" >
                <form action="{{route('admin.device_transaction_history_date')}}" method="post">
                    @csrf
                <div class="row">
                    <h5>Filter By date:</h5>
                    <div class="col-0">
                        <div class="form-group">
                        <label for="exampleInputPassword1">Start date:</label>
                      </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                        <input type="date" class="form-control" name="start_date">
                      </div>
                    </div>


                    <div class="col-0">
                        <div class="form-group">
                        <label for="exampleInputPassword1">End date:</label>
                      </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                        <input type="date" class="form-control" name="end_date">
                      </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search </button>
                      </div>
                    </div>

                </div>

                 </form>

            </div>


            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Order for</th>
                  <th>Technician</th>
                  <th>Device uses</th>
                  <th>Device Costing</th>
                  <th>Installation Cost</th>
                  <th>Sell Price</th>
                  <th>Profit/loss</th>
                  <th>Time</th>
                  <th>Completed date</th>
                </tr>
                </thead>
                <tbody>
@foreach($transaction_hisytory as $key=>$data)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>
                      @php($user = \App\AllUser::find($data->user_id))
                      <a href="{{route('admin.all_user.show',$user->id)}}">{{$user->name}}</a>

                  </td>
                  <td>
                       @php($technician = \App\Technician::find($data->technician_id))
                      <a href="{{route('admin.technician.show',$technician->id)}}">{{$technician->name}}</a>

                  </td>
                  <td>
                      @php($device_uses = \App\technician_device_stock::where('assign_id',$data->assign_id)->get())
                      @foreach($device_uses as $key=>$device_uses_data)
                        {{$key+1}}. <span class="right badge badge-success">{{$device_uses_data->device_model}}</span> -> {{$device_uses_data->quantity}} Peace <br>
                      @endforeach
                  </td>
                  <td>{{$data->device_costing}}</td>
                  <td>{{$data->installation_cost}}</td>
                  <td>{{$data->sell_price}}</td>
                  <td>{{$data->profit_or_loss}}
                      @if($data->profit_or_loss > 0)
                      <span class="right badge badge-warning">Profit</span>
                          @else
                       <span class="right badge badge-danger">loss</span>
                      @endif
                  </td>
                    <td>{{$data->created_at->diffForHumans()}}</td>
                    <td>{{date("jS  F Y - h:i:s A", strtotime($data->created_at))}}</td>
                </tr>
@endforeach



                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Order for</th>
                  <th>Technician</th>
                  <th>Device uses</th>
                      <th class="bg-fuchsia">Total: {{$total_device_costing}}</th>
                  <th class="bg-primary">Total: {{$total_installation_cost}}</th>
                  <th class="bg-gradient-danger">Total: {{$total_sell_price}}</th>
                  <th class="bg-info">Total: {{$total_profit_loss}}</th>
                  <th>Time</th>
                  <th>Completed date</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->









@endsection
@push('js')

        <!-- DataTables -->
<script src="{{asset('public/assets/backend/plugins/datatables/jquery.dataTables.js')}}"></script>
 <script src="{{asset('public/assets/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>




@endpush
