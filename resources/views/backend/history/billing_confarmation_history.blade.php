@extends('backend.layout.app')
@section('title','Billing History')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Billing History')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="card">
            <div class="card-header">
                <form action="{{route('admin.billing_history_search_date')}}" method="post">
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
                  <th>Bill Collected By</th>
                  <th>Pay Amount</th>
                  <th>Number of Months</th>
                  <th>Customer</th>
                  <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>

            @foreach($billing as $key=>$data)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        @php($admin_name = \App\User::find($data->admin_id))
                        {{$admin_name->name}}
                    </td>
                    <td>{{$data->updated_amount}}</td>
                    <td>{{$data->payment_for_month}} Months</td>
                    <td>
                        @php($user = \App\AllUser::find($data->user_id))
                        <a href="{{route('admin.all_user.show',$user->id)}}">{{$user->name}}</a>
                    </td>
                    <td>{{date("jS  F Y",strtotime($data->created_at))}}</td>
                </tr>
            @endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Bill Collected By</th>
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
