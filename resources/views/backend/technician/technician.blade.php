@extends('backend.layout.app')
@section('title','All Technician')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','All Technician')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="card">
            <div class="card-header">
              <h3 class="card-title">Total Technician: <span class="badge badge-secondary">{{$technician->count()}}</span></h3>
                <a href="{{route('admin.technician.create')}}" type="button" class="btn-sm btn-success float-right">Add Technician</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Stock Device</th>
                  <th>Total Stock</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

@foreach($technician as $key=>$technician_data)

                <tr>
                  <td>{{$technician_data->id}}</td>
                  <td>
                      <a href="{{route('admin.technician.show',$technician_data->id)}}">{{$technician_data->name}}</a>

                  </td>
                  <td>{{$technician_data->phone}}</td>
                  <td>{{$technician_data->email}}</td>
                  <td>{{$technician_data->address}}</td>
                    <td>
                    @php($device = \App\technican_stock::where('technicain_id',$technician_data->id)->get())
                        @foreach($device as $key=>$device_data)
                            {{$key+1}}. <span class="right badge badge-success">{{$device_data->model}}</span> -> {{$device_data->quantity}} Peace <br>
                        @endforeach
                    </td>
                    <td><span class="badge badge-secondary">{{\App\technican_stock::where('technicain_id',$technician_data->id)->sum('quantity')}}</span></td>


                    <td>
{{--                          <a class="btn btn-primary btn-sm" href="{{route('admin.technician.show',$technician_data->id)}}">--}}
{{--                              <i class="fas fa-folder">--}}
{{--                              </i>--}}
{{--                              View--}}
{{--                          </a>--}}
                          <a class="btn btn-info btn-sm" href="{{route('admin.technician.edit',$technician_data->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
{{--                          <a class="btn btn-danger btn-sm" href="{{route('admin.technician_delete',$technician_data->id)}}">--}}
{{--                              <i class="fas fa-trash">--}}
{{--                              </i>--}}
{{--                              Delete--}}
{{--                          </a>--}}
                        <a class="btn btn-primary btn-sm" href="{{route('admin.technician.show',$technician_data->id)}}">
                              <i class="fas fa-eye">
                              </i>
                              Details
                          </a>
                   </td>
                </tr>

@endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>Stock Device</th>
                  <th>Total Stock</th>
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
