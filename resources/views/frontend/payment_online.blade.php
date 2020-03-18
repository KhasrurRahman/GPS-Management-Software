@extends('frontend.layout.app')
@section('title','Bill Payment')
@push('css')
      <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('content')

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

                                <h3 class="profile-username text-center">{{$all_user->name}}</h3>

                                <p class="text-muted text-center">{{$all_user->phone}}</p>
                        <a href="{{route('user_login')}}" class="btn btn-success btn-block mb-2"  style="color: white;font-weight: bold;">Login</a>
                                <ul class="list-group list-group-unbordered mb-3">
                                  <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{$all_user->email}}</a>
                                  </li>
                                    <li class="list-group-item">
                                    <b>User Type</b>
                                        @if($all_user->user_type == 1)
                                        <a class="float-right">Individual</a>
                                            @else
                                            <a class="float-right">Corporate</a>
                                      @endif
                                  </li>
                                    <li class="list-group-item">
                                    <b>Address</b> <a class="float-right">{{$all_user->par_add}}</a>
                                  </li>
                                  <li class="list-group-item">
                                    <b>Payment Status</b>
                                      @if($all_user->payment_status == 1)
                                      <a class="float-right"><span class="badge badge-success">Paid</span></a>
                                          @else
                                      <a class="float-right"><span class="badge badge-danger">UnPaid</span></a>
                                      @endif
                                  </li>
                                  <li class="list-group-item">
                                      @php
                use App\payment_history;$due_from = payment_history::where('user_id',$all_user->id)->where('payment_status',0)->orderBy('id','asc')->first();
                                      @endphp
                                      @if($due_from == null)
                                      <b>Next payment Date</b> <a class="float-right">{{date("F-Y", strtotime($all_user->next_payment_date))}}</a>
                                        @else
                                    <b>Due from</b> <a class="float-right">{{date("F-Y", strtotime($due_from->month_name))}}</a>
                                      @endif

                                  </li>

                                    <li class="list-group-item">
                                    <b>Monthly Bill</b> <a class="float-right">{{$all_user->monthly_bill}}</a>
                                  </li>
                                </ul>
                              </div>
                              <!-- /.card-body -->
                            </div>
                    </div>

         <div class="col-md-9 p-0">
            <div class="card h-100">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#payment" data-toggle="tab">Billing history</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">


         <div class="tab-pane active" id="payment">
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


                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
             </div>


            <!--// My Account Area -->


<!-- Modal -->
<div class="modal fade" id="payment_status" tabindex="-1" role="dialog" aria-labelledby="payment_statusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{route('bill_payment_pay',$all_user->id)}}" method="post">
            @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="payment_statusLabel">Pay Now</h5>
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
        <button type="submit" class="btn btn-primary">Pay</button>
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


     <script>
            function calculateAmount() {
                var months = document.getElementById("month").value;

                var monthly_bill ='{{$all_user->monthly_bill}}';
                var tot_price = months * monthly_bill;
                var divobj = document.getElementById('amount');
                divobj.value = tot_price;
            }
</script>
@endpush
