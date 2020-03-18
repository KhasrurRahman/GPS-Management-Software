@extends('frontend.layout.app')
@section('title','Dashboard')
@push('css')
      <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('content')

@if(session()->has('message'))
    <div class="alert alert-success text-center">
        {{ session()->get('message') }}
    </div>
@endif
  <!-- My Account Area -->
           <div class="container">
            <div class="tm-section tm-my-account-area bg-white tm-padding-section" style="background: #166d65 !important">

                   <div class="row">

                    <div class="col-md-3 p-0">
                        <div class="card card-primary card-outline h-100">
                              <div class="card-body box-profile">
                                <div class="text-center">
                                  <img class="profile-user-img img-fluid img-circle" src="{{asset('public/assets/backend/img/avatar5.png')}}" alt="User profile picture" style="border-radius: 20%">
                                </div>

                                <h3 class="profile-username text-center">{{$user_info->name}}</h3>

                                <p class="text-muted text-center">{{$user_info->phone}}</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                  <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{$user_info->email}}</a>
                                  </li>
                                    <li class="list-group-item">
                                    <b>User Type</b>
                                        @if($user_info->user_type == 1)
                                        <a class="float-right">Individual</a>
                                            @else
                                            <a class="float-right">Corporate</a>
                                      @endif
                                  </li>
                                    <li class="list-group-item">
                                    <b>Address</b> <a class="float-right">{{$user_info->par_add}}</a>
                                  </li>
                                  <li class="list-group-item">
                                    <b>Payment Status</b>
                                      @if($user_info->payment_status == 1)
                                      <a class="float-right"><span class="badge badge-success">Paid</span></a>
                                          @else
                                      <a class="float-right"><span class="badge badge-danger">UnPaid</span></a>
                                      @endif
                                  </li>
                                  <li class="list-group-item">
                                      @php
                use App\payment_history;$due_from = payment_history::where('user_id',$user_info->id)->where('payment_status',0)->orderBy('id','asc')->first();
                                      @endphp
                                      @if($due_from == null)
                                      <b>Next payment Date</b>
                                          @if($user_info->next_payment_date == '-')
                                          <a class="float-right">--</a>
                                          @else
                                          <a class="float-right">{{date("F-Y", strtotime($user_info->next_payment_date))}}</a>
                                          @endif
                                        @else
                                    <b>Due from</b> <a class="float-right">{{date("F-Y", strtotime($due_from->month_name))}}</a>
                                      @endif

                                  </li>

                                    <li class="list-group-item">
                                    <b>Monthly Bill</b> <a class="float-right">{{$user_info->monthly_bill}}</a>
                                  </li>
                                </ul>
                                  <a href="" data-toggle="modal" class="btn btn-warning btn-block" data-target="#post_a_complain" style="color: white;font-weight: bold;">Place a Complain</a>
                              </div>
                              <!-- /.card-body -->
                            </div>
                    </div>

         <div class="col-md-9 p-0">
            <div class="card h-100">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Order History</a></li>
                  <li class="nav-item"><a class="nav-link" href="#payment" data-toggle="tab">Billing history</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                  <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Change Password</a></li>
                   <li class="nav-item mt-2"><a class="btn-sm btn-danger" href="{{ route('logout') }}" data-toggle="tab" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" style="color: white">Log Out</a></li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                </form>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">


                                      <!-- /.tab-pane -->
    <div class="active tab-pane" id="timeline">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Order History</h3>
            </div>
                      <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Package Name</th>
                  <th>Device quantity</th>
                  <th>Total Amount</th>
                  <th>Payment Status</th>
                  <th>Order Status</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>

                @foreach($package_order as $key=>$data)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>
                      @php($package_name=\App\Price_categaroy::find($data->package_id ))
                      {{$package_name->name}}
                  </td>

                    <td>
                        1
                    </td>
                    <td>
                        @php($amount=\App\Payment::find($data->transaction_id ))
                      {{$amount->amount}}
                    </td>
                    <td>
                        {{$data->payment_status}}
                    </td>

                    <td>
                      @if($data->order_status == 0)
                          <span class="right badge badge-danger">Pending</span>
                      @elseif($data->order_status == 1)
                          <span class="right badge badge-warning">processing</span>
                          @elseif($data->order_status = 2)
                          <span class="right badge badge-success">Complete</span>
                      @endif
                  </td>

                    <td>
                        {{date("jS  F Y - h:i:s A", strtotime($data->created_at))}}
                    </td>
                </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Package Name</th>
                  <th>Device quantity</th>
                  <th>Total Amount</th>
                  <th>Payment Status</th>
                  <th>Order Status</th>
                  <th>Date</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
                  </div>
             </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="payment">
         <div class="card">
            <div class="card-header">
              <h3 class="card-title">Full payment history</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Month Name</th>
                  <th>Payment Amount</th>
                  <th>Due</th>
                  <th>Payment Date</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payment as $key=>$user_data)
                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{date("F-Y", strtotime($user_data->month_name))}}</td>
                  <td>
                      @if($user_data->payment_this_date == null)
                          <span>---</span>
                          @else
                      {{$user_data->payment_this_date}}
                      @endif
                  </td>
                  <td>{{$user_data->total_due}}</td>
                  <td>{{date("jS  F Y - h:i:s A",strtotime($user_data->created_at))}}</td>
                  <td>
                      @if($user_data->payment_status == 0)
                          <span class="badge badge-danger">Due</span>
                          @else
                          <span class="badge badge-success">Paid</span>
                          @endif
                  </td>
                </tr>
                @endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Month Name</th>
                  <th>Payment Amount</th>
                  <th>Due</th>
                  <th>Invoice Date</th>
                    <th>Status</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
                  </div>





                <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="{{route('update_user_info',$user_info->user_id)}}" method="post">
                        @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name<font color="red">*</font></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{$user_info->name}}" name="name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail"  value="{{$user_info->email}}" autocomplete="off" name="email">
                        </div>
                      </div>

                        <div class="form-group row">
                        <label for="par_add" class="col-sm-2 col-form-label">Address details<font color="red">*</font></label>
                            <div class="col-sm-10">
                          <input type="text" class="form-control" id="par_add" name="par_add" placeholder="Enter your address details"  autocomplete="off" value="{{$user_info->par_add}}" required>
                                                    @if ($errors->has('par_add'))
                                                        <span class="text-danger">{{ $errors->first('par_add') }}</span>
                                                    @endif
                        </div>

                      </div>

                      <div class="form-group row">
                          <label for="phone" class="col-sm-2 col-form-label">Mobile Number<font color="red">*</font></label>
                              <div class="col-sm-10">
{{--                              <span class="input-group-text">+88</span>--}}

                               <input type="text" pattern=".{11,11}" max="11" class="form-control" id="phone" name="phone" placeholder="Enter your mobile number" autocomplete="off" value="{{$user_info->phone}}" required readonly>
                            </div>
                         </div>

                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>


                    <div class="tab-pane" id="password">
                        <form class="form-horizontal" method="POST" action="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }} row">
                            <label for="new-password" class="col-sm-2 col-form-label">Current Password</label>

                            <div class="col-sm-10">
                                <input id="current-password" type="password" class="form-control" name="current-password" required>

                                @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }} row">
                            <label for="new-password" class="col-md-4 control-label">New Password</label>

                            <div class="col-sm-10">
                                <input id="new-password" type="password" class="form-control" name="new-password" required>

                                @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new-password-confirm" class="col-md-4 control-label">Confirm New Password</label>

                            <div class="col-sm-10">
                                <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
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


            <!--// My Account Area -->


<!-- complain model -->
<div class="modal fade" id="post_a_complain" tabindex="-1" role="dialog" aria-labelledby="post_a_complainLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


<form action="{{route('user.post_complain',$user_info->id)}}" method="post">

        @csrf

      <div class="modal-header">
        <h5 class="modal-title" id="post_complainLabel">Place a complain</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <div class="form-group">
                 <label for="exampleInputPassword1">Complain Description</label>
                <textarea type="text" class="form-control"  placeholder="Complain Description" name="Complain_description"></textarea>
                  </div>
            </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send</button>
      </div>

</form>


    </div>
  </div>
</div>




@endsection
@push('js')
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
