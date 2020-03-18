@extends('backend.layout.app')
@section('title','Technician device Stock')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Technician device Stock')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="card">

            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Stock Device</th>
                  <th>Last Stock Added date</th>
                  <th>Technician Assigned By</th>
                </tr>
                </thead>
                <tbody>

@foreach($technican as $key=>$data)
                <td>{{$key+1}}</td>
                <td>{{$data->name}}</td>
                <td>{{$data->phone}}</td>
                <td>
                    @php($device = \App\technican_stock::where('technician_id',$data->technician_id)->get())
                    @foreach($device as $key_$device_data)
                    {{$technicaian_details->PHONE}}
                        @endforeach
                </td>
@endforeach



                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Stock Device</th>
                  <th>Last Stock Added date</th>
                  <th>Technician Assigned By</th>
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
