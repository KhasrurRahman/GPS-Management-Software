@extends('backend.layout.app')
@section('title','Device Sell History')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Device Sell History')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="card">
    <div class="card-header float-right">
              <h3 class="card-title">Total Sell price: <span class="badge badge-success">{{$total_sell_price}}</span></h3>
            </div>

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Device Model</th>
                  <th>Sell price</th>
                  <th>Assigned Technician</th>
                  <th>Customer</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>

                @foreach($device_history as $key=>$data)

                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>
                                        @php($devices = \App\technician_device_stock::where('assign_id',$data->assign_id)->get())

                                        @foreach($devices as $key=>$devices_data)
                                          {{$key+1}}. <span class="right badge badge-success">{{$devices_data->device_model}}</span> -> {{$devices_data->quantity}} Peace <br>
                                      @endforeach
                                    </td>
                                    <td>
                                        {{$data->sell_price}}
                                    </td>
                                    <td>
                                        @php($technician = \App\Technician::find($data->technician_id))
                                        <a href="{{route('admin.technician.show',$technician->id)}}">{{$technician->name}}</a>
                                    </td>
                                    <td>
                                        @php($assign_id = \App\Assign_technician_device::find($data->assign_id)->user_id)
                                        @php($user = \App\AllUser::find($assign_id))
                                        <a href="{{route('admin.all_user.show',$user->id)}}">{{$user->name}}</a>
                                    </td>
                                    <td>{{date("jS  F Y",strtotime($data->created_at))}}</td>
                                </tr>

                @endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Device Model</th>
                  <th></th>
                  <th>Assign Technician</th>
                  <th>Customer</th>
                  <th>Date</th>
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
