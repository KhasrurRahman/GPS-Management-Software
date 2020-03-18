@extends('backend.layout.app')
@section('title','All Device')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','All Device')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="card">
            <div class="card-header">
              <h3 class="card-title">Total Device: <span class="badge badge-secondary">{{$device->count()}}</span></h3>
              @if(\Illuminate\Support\Facades\Auth::user()->type == 'admin')
                <a href="{{route('admin.device.create')}}" type="button" class="btn-sm btn-success float-right">Add Device</a>
                @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Device Company name</th>
                  <th>Device Model</th>
                  <th>Device Cost</th>
                  <th>Quantity</th>
                  <th>Assigned to Technician</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

@foreach($device as $key=>$device_data)

                <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$device_data->device_name}}</td>
                  <td>{{$device_data->device_model}}</td>
                  <td>{{$device_data->device_price}}</td>
                  <td>{{$device_data->quantity}}</td>

                    <td>
                        @php($total =  \App\technican_stock::where('device_id',$device_data->id)->sum('quantity'))
                        <span class="badge badge-secondary"> {{$total}}</span>
                    </td>
                    <td>
{{--                          <a class="btn btn-primary btn-sm" href="{{route('admin.technician.show',$device_data->id)}}">--}}
{{--                              <i class="fas fa-folder">--}}
{{--                              </i>--}}
{{--                              View--}}
{{--                          </a>--}}
@if(\Illuminate\Support\Facades\Auth::user()->type == "admin")
                          <a class="btn btn-info btn-sm" href="{{route('admin.device.edit',$device_data->id)}}">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Update
                          </a>
@endif
                        <a class="btn btn-danger btn-sm" href="#" onclick="assign_technicain({{$device_data->id}})">
                              <i class="fas fa-trash">
                              </i>
                              Assign technician
                          </a>


                   </td>
                </tr>

@endforeach


                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Device name</th>
                  <th>Device Model</th>
                  <th>Device Price</th>
                  <th>Quantity</th>
                  <th>Total Assigned</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->




    <!-- Modal -->
<div class="modal fade" id="assign_tec" tabindex="-1" role="dialog" aria-labelledby="assign_tecLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <form action="{{route('admin.assign_technician_from_device_stock')}}" method="post">
        @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="assign_tecLabel">Assign Technician</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" id="device_id" name="device_id">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Select Technician</label>
            <select class="form-control" id="exampleFormControlSelect1" name="technican_id" required>
                <option>Select Technician</option>
                @foreach($technician as $key=>$data)
                    <option value="{{$data->id}}">{{$key+1}}. {{$data->name}}</option>
                @endforeach
            </select>
          </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Quantity</label>
            <input type="number" class="form-control"  placeholder="Enter quantity" required name="quantity">
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Assign</button>
      </div>

        </form>
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


    <script type="text/javascript">
        function deletepost(id) {
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })
            swalWithBootstrapButtons({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-'+id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }
    </script>



    <script>
        function assign_technicain(device_id) {
            document.getElementById('device_id').value = device_id;
            $('#assign_tec').modal('show')
        }
    </script>



@endpush
