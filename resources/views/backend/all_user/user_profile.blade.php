@extends('backend.layout.app')
@section('title','User Details')
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
                      <b>Next Payment Date</b>
                       @if($user->next_payment_date == '-')
                           <a class="float-right">--</a>
                           @else
                          <a class="float-right">{{date("F-Y", strtotime($user->next_payment_date))}}</a>
                           @endif
                        @else
                    <b>Due from</b> <a class="float-right">{{date("F-Y", strtotime($due_from->month_name))}}</a>
                      @endif

                  </li>

                    <li class="list-group-item">
                    <b>Monthly Bill</b> <a class="float-right">{{$user->monthly_bill}}</a>
                  </li>
                    <li class="list-group-item">
                    <b>Device Price</b> <a class="float-right">{{$user->device_price}}</a>
                  </li>
                    <li class="list-group-item">
                    <b>Car</b> <a class="float-right">{{$user->car_number}}</a>
                  </li>

                    <li class="list-group-item">
                    <b>Take a Note</b><br>
                        <textarea name="user_note" id="user_note" rows="5" style="width: 100%" onkeyup="take_note($(this).val(),{{$user->id}})">{{$user->note}}</textarea>
                  </li>
                </ul>

@if(payment_history::where('user_id',$user->id)->exists())

                <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#payment_status"><b>Update Payment Status</b></a>
                <a href="#" class="btn btn-outline-warning btn-block" data-toggle="modal" data-target="#monthly_bill_status"><b>Update Monthly Bill</b></a>
                <a href="{{route('admin.full_order_history',$user->id)}}" class="btn btn-outline-success btn-block"><b>View full order history</b></a>
                <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#sms"><b>Send Sms</b></a>
                 @if(\App\payment_history::where('user_id',$user->id)->get()->count() == 1)
                <a href="#" class="btn btn-danger btn-block" data-toggle="modal" data-target="#update_due"><b>Update Due Date</b></a>
                 @endif
@else
<span class="badge badge-danger">There is no payment history for this user.<br>please Complete The order for this user</span>
@endif
              </div>
              <!-- /.card-body -->
            </div>
    </div>


    <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#payment" data-toggle="tab">Payment history</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Confirmation history</a></li>
                  <li class="nav-item"><a class="nav-link" href="#monthly_bill" data-toggle="tab">Monthly Bill update history</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="payment">
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
                  <th>Action</th>
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
                      {{$user_data->updated_at}}
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
                    <td>
                        @if(\App\payment_history::where('user_id',$user->id)->get()->count() !== 1)
                            @php
                                $last_history = \App\payment_history::where('user_id',$user->id)->orderBy('id', 'desc')->first()->id;
                            @endphp
                            @if($last_history == $user_data->id)
                            <a href="{{route('admin.delete_payment_history',$user_data->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            @endif
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
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
                  </div>



                  <!-- /.tab-pane -->
    <div class="tab-pane" id="timeline">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Bill Payment history</h3>
            </div>
                      <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Sub Admin Name</th>
                  <th>payment Amount</th>
                  <th>Payment For Month</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payment_confermation as $key=>$data)
                <tr>
                    @php
                    $admin_name = \App\User::where('id',$data->admin_id)->first();
                    @endphp
                  <td>{{$key+1}}</td>
                  <td>{{$admin_name->name}}</td>
                  <td>{{$data->updated_amount}} Tk</td>
                  <td>For {{$data->payment_for_month}} months</td>
                  <td>{{date("jS  F Y - h:i:s A", strtotime($data->created_at))}}</td>
                </tr>
                @endforeach

                </tbody>
                <tfoot>
                   <tr>
                      <th>Id</th>
                      <th>Sub Admin Name</th>
                      <th>payment Amount</th>
                      <th>Payment For Month</th>
                      <th>Date</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
                  </div>
             </div>
                  <!-- /.tab-pane -->
                    <!-- /.tab-pane -->
    <div class="tab-pane" id="monthly_bill">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Monthly Bill Update history</h3>
            </div>
                      <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Admin Name</th>
                  <th>updated Amount</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($monthly_bill_update_history as $key=>$data)
                <tr>
                    @php
                    $admin_name = \App\User::where('id',$data->admin_id)->first();
                    @endphp
                  <td>{{$key+1}}</td>
                  <td>{{$admin_name->name}}</td>
                  <td>{{$data->monthly_bill}} Tk</td>
                  <td>{{date("jS  F Y - h:i:s A", strtotime($data->created_at))}}</td>
                </tr>
                @endforeach

                </tbody>
                <tfoot>
                   <tr>
                      <th>Id</th>
                      <th>Admin Name</th>
                      <th>updated Amount</th>
                      <th>Date</th>
                    </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
                  </div>
             </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" action="{{route('update_user_info',$user->user_id)}}" method="post">
                        @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name<font color="red">*</font></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" placeholder="Name" value="{{$user->name}}" name="name" required>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail"  value="{{$user->email}}" autocomplete="off" name="email">
                        </div>
                      </div>

                        <div class="form-group row">
                        <label for="par_add" class="col-sm-2 col-form-label">Address details<font color="red">*</font></label>
                            <div class="col-sm-10">
                          <input type="text" class="form-control" id="par_add" name="par_add" placeholder="Enter your address details"  autocomplete="off" value="{{$user->par_add}}" required>
                                                    @if ($errors->has('par_add'))
                                                        <span class="text-danger">{{ $errors->first('par_add') }}</span>
                                                    @endif
                        </div>

                      </div>

                      <div class="form-group row">
                          <label for="phone" class="col-sm-2 col-form-label">Mobile Number<font color="red">*</font></label>
                              <div class="col-sm-10">
                              <span class="input-group-text">+88</span>

                               <input type="text" pattern=".{11,11}" max="11" class="form-control" id="phone" name="phone" placeholder="Enter your mobile number" autocomplete="off" value="{{$user->phone}}" required>
                                                        @if ($errors->has('phone'))
                                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                        @endif
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

                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
</div>





<!-- Modal -->
<div class="modal fade" id="payment_status" tabindex="-1" role="dialog" aria-labelledby="payment_statusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{route('admin.update_payment',$user->id)}}" method="post">
            @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="payment_statusLabel">Update Payment Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Number Of Month</label>
                    <input type="number" class="form-control" id="month" placeholder="Number Of Months" name="number_of_months" onkeyup="calculateAmount()">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">payment Amount</label>
                    <input readonly type="number" class="form-control" id="amount" placeholder="Amount" name="payment_this_date">
                </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
         </form>
    </div>
  </div>
</div>



<!-- Monthly bill -->
<div class="modal fade" id="monthly_bill_status" tabindex="-1" role="dialog" aria-labelledby="monthly_bill_statusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{route('admin.monthly_bill_update',$user->id)}}" method="post">
            @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="monthly_bill_statusLabel">Update Monthly Bill</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <div class="form-group">
                    <label for="exampleInputPassword1">Monthly Bill Amount</label>
                    <input type="number" class="form-control" id="month" placeholder="Number Of Months" name="monthly_bill" value="{{$user->monthly_bill}}">
                  </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
         </form>
    </div>
  </div>
</div>


<!--sms Modal -->
<div class="modal fade" id="sms" tabindex="-1" role="dialog" aria-labelledby="smsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{route('admin.send_personal_sms',$user->id)}}" method="get">
      <div class="modal-header">
        <h5 class="modal-title" id="smsLabel">Send Text Message to this User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Sms Body</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="sms"></textarea>
                      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send sms</button>
      </div>
        </form>

    </div>
  </div>
</div>


{{--    update due date--}}
    <!-- Modal -->
<div class="modal fade" id="update_due" tabindex="-1" role="dialog" aria-labelledby="update_dueLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="update_dueLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form role="form" action="{{route('admin.update_user_after_mistake')}}" method="post">
    @csrf
<div class="row">

                    <input type="hidden" class="form-control" id="Name" placeholder="Enter email" name="name" value="{{$user->name}}">
                    <input type="hidden" class="form-control" id="Name" placeholder="Enter email" name="user_id" value="{{$user->id}}">


                    <input type="hidden"  pattern=".{11,11}" max="11" class="form-control" id="phone" placeholder="Phone" name="phone" value="{{$user->phone}}">




                    <input type="hidden" class="form-control" id="Phone" placeholder="Alternative Phone" name="alter_phone" value="{{$user->phone}}">


                    <input type="hidden" class="form-control" id="Email" placeholder="Email" name="email" value="{{$user->email}}" >


                    <input type="hidden" class="form-control" id="Present Address" placeholder="Password" name="par_add" value="{{$user->par_add}}">



                        <select class="form-control" name="user_type" style="visibility: hidden">
                          <option value="1" {{ ( $user->user_type == 1) ? 'selected' : '' }}>Individual</option>
                          <option value="2" {{ ( $user->user_type == 2) ? 'selected' : '' }}>Corporate</option>
                        </select>



                    <input type="hidden" class="form-control" id="Name" placeholder="Car Number" name="car_number" value="{{$user->car_number}}">


                    <input type="hidden" class="form-control" id="Phone" placeholder="Car Model" name="car_model" value="{{$user->car_model}}">


                    <input type="hidden" class="form-control" id="Email" placeholder="installation Date" name="installation_date" value="{{$user->installation_date}}">


                    <input type="hidden" class="form-control"  placeholder="Device Price" name="device_price" value="{{$user->device_price}}">


                    <input type="hidden" class="form-control" id="Present Address" placeholder="Monthly Bill" name="monthly_bill" value="{{$user->monthly_bill}}">



                    <input type="date" class="form-control" id="due_date" placeholder="Due Date" name="due_date" style="margin-bottom: 10px">

</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">update</button>
</form>
      </div>
    </div>
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

    <script>
    function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>

 <script>
            function calculateAmount() {
                var months = document.getElementById("month").value;

                var monthly_bill ='{{$user->monthly_bill}}';
                var tot_price = months * monthly_bill;
                var divobj = document.getElementById('amount');
                divobj.value = tot_price;
            }


            function take_note(note,user_id) {
                   $.ajax({
                   url: "{{url('admin/user_note_save')}}/"+user_id,
                   type: "POST",
                   data: {
                       "_token": "{{ csrf_token() }}",
                       note: note,
                   },
                   success:function(res){
                        $('#user_note').load(location.href+(' #user_note'));
                        setTimeout(toastr.success("{{'Note Saved'}}"), 2000);
                   }

               });
            }
</script>
@endpush
