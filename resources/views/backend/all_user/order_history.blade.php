@extends('backend.layout.app')
@section('title','User Order History')
@push('css')
<!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','User Details')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="row">
    <div class="col-md-3">
        <a href="{{route('admin.all_user.show',$user->id)}}" class="btn btn-success btn-block mb-2"><b>Back To Profile</b></a>
        <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="{{asset('public/assets/backend/img/avatar5.png')}}" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$user->name}}</h3>

                <p class="text-muted text-center">{{$user->phone}}</p>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{$user->email}}</a>
                  </li>
                    <li class="list-group-item">
                    <b>User Type</b>
                        @if($user->user_type == 1)
                        <a class="float-right">Individual</a>
                            @else
                            <a class="float-right">Corporate</a>
                      @endif
                  </li>
                    <li class="list-group-item">
                    <b>Address</b> <a class="float-right">{{$user->par_add}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Payment Status</b>
                      @if($user->payment_status == 1)
                      <a class="float-right"><span class="badge badge-success">Paid</span></a>
                          @else
                      <a class="float-right"><span class="badge badge-danger">UnPaid</span></a>
                      @endif
                  </li>
                  <li class="list-group-item">
                      @php
use App\payment_history;$due_from = payment_history::where('user_id',$user->id)->where('payment_status',0)->orderBy('id','asc')->first();
                      @endphp
                      @if($due_from == null)
                      <b>Next payment Date</b> <a class="float-right">{{date("F-Y", strtotime($user->next_payment_date))}}</a>
                        @else
                    <b>Due from</b> <a class="float-right">{{date("F-Y", strtotime($due_from->month_name))}}</a>
                      @endif

                  </li>

                    <li class="list-group-item">
                    <b>Monthly Bill</b> <a class="float-right">{{$user->monthly_bill}}</a>
                  </li>
                </ul>
                <a href="{{route('admin.full_order_history',$user->id)}}" class="btn btn-outline-success btn-block"><b>Installation history</b></a>
              </div>
              <!-- /.card-body -->
            </div>
    </div>


    <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#payment" data-toggle="tab">Repair and Installation History</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="payment">
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">Full Order History</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Technician Name</th>
                  <th>Given device/Repair</th>
                  <th>status</th>
                  <th>completed Date</th>
                </tr>
                </thead>
                <tbody>

                @foreach($orders as $key=>$data)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>
                      @php($technician_name=\App\Technician::find($data->technician_id ))
                      <a href="{{route('admin.technician.show',$technician_name->id)}}">{{$technician_name->name}}</a>
                  </td>
                    <td>
                      @php($devices=\App\technician_device_stock::where('assign_id',$data->id)->get())
                      @if(count($devices) == 0)
                          <span>only for repair</span>
                          @else

                          @foreach($devices as $key=>$devices_data)

                                {{$key+1}}. <span class="right badge badge-success">{{$devices_data->device_model}}</span>-> {{$devices_data->quantity}} Peace <br>
                      @endforeach
                      @endif

                  </td>
                    <td>
                      @if($data->status == 0)
                          <span class="right badge badge-danger">incomplete</span>
                      @elseif($data->status == 2)
                          <span class="right badge badge-warning">Not Completed</span>
                          @else
                          <span class="right badge badge-success">Complete</span>
                      @endif
                  </td>

                    <td>
                        {{date("jS  F Y - h:i:s A", strtotime($data->updated_at))}}
                    </td>
                </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Technician Name</th>
                  <th>Given device/Repair</th>
                  <th>status</th>
                  <th>completed Date</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>


                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{$user->name}}" name="name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email" {{$user->email}} value="email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">phone</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName2" placeholder="phone" value="{{$user->phone}}" name="phone">
                        </div>
                      </div>
                        <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="Password" class="form-control" id="myInput" placeholder="Password" value="{{$user->password}}" name="Password">
                            <input type="checkbox" onclick="myFunction()">Show Password
                        </div>
                      </div>


                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>





</div>




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
