@extends('backend.layout.app')
@section('title','Complain')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Complain')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="card">
            <div class="card-header">
{{--              <h3 class="card-title">Total User: <span class="badge badge-secondary">{{$user->count()}}</span></h3>--}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Customer Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Complain description</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($complain as $key=>$data)

                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            {{\App\AllUser::find($data->user_id)->name}}
                        </td>
                        <td>{{\App\AllUser::find($data->user_id)->phone}}</td>
                        <td>{{\App\AllUser::find($data->user_id)->email}}</td>
                        <td>{{$data->description}}</td>
                        <td>
                            @if($data->status !== 'Solved')
                                <span class="badge badge-warning">Not Solve</span>
                                @else
                                <span class="badge badge-warning">Solved</span>
                            @endif

                        </td>
                        <td>
                            @if($data->status !== 'Solved')
                                <a class="btn btn-success btn-sm" href="{{route('admin.solve_complain',$data->id)}}">
                                      <i class="fas fa-procedures">
                                      </i>
                                      Solve it
                                </a>
                                @else
                                <a class="btn btn-secondary btn-sm" href="#" disabled="">
                                      <i class="fas fa-procedures">
                                      </i>
                                      Solved
                                </a>
                            @endif
                        </td>
                    </tr>



                 @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Customer Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Complain description</th>
                  <th>Status</th>
                  <th>Action</th>
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
