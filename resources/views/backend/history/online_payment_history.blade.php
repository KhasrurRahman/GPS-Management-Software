@extends('backend.layout.app')
@section('title','Online Payment History')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Online Payment History')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="card">
            <div class="card-header">
                <form action="{{route('admin.payment_by_online_search_date')}}" method="post">
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
                        <input type="date" class="form-control" name="start_date" required>
                      </div>
                    </div>


                    <div class="col-0">
                        <div class="form-group">
                        <label for="exampleInputPassword1">End date:</label>
                      </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                        <input type="date" class="form-control" name="end_date" required>
                      </div>
                    </div>
                    <div class="col-2">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Search</button>
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
                  <th>Pay Amount</th>
                  <th>Number of Months</th>
                  <th>Customer</th>
                  <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>

            @foreach($online_payment as $key=>$data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$data->amount}}</td>
                    <td>{{$data->number_of_months}} Months</td>
                    <td>
                     
                        @php($user = \App\AllUser::where('user_id',$data->user_id)->first())
                        <a href="{{route('admin.all_user.show',$user->id)}}">{{$user->name}}
                    </td>
                    <td>{{date("jS  F Y",strtotime($data->created_at))}}</td>
                </tr>
            @endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th style="background: #0d8d2d">Total: {{$total_pay_amount}}</th>
                  <th>Number of Months</th>
                  <th>Customer</th>
                  <th>Payment Date</th>
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
