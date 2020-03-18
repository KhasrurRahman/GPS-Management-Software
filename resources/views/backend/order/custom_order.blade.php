@extends('backend.layout.app')
@section('title','New order')
@push('css')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','New order')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="card">
            <div class="card-header">
{{--              <h3 class="card-title">Total Device: <span class="badge badge-secondary">{{$device->count()}}</span></h3>--}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Customer Name</th>
                  <th>Month Charge</th>
                  <th>Device quantity</th>
                  <th>Device price</th>
                  <th>Total Amount</th>
                  <th>Order Status</th>
                  <th>Assigned Technician</th>
                  <th>Order Time</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($orders as $key=>$data)
                <tr>
                  <td>{{$key+1}}</td>
                    <td>
                        <a href="{{route('admin.all_user.show',\App\AllUser::find($data->user_id)->first()->id)}}">{{\App\AllUser::find($data->user_id)->first()->name}}</a>
                    </td>
                  <td>
                      {{$data->month_charge}}
                  </td>

                    <td>
                        1
                    </td>
                    <td>
                        {{$data->device_price}}

                    </td>

                    <td>{{$data->device_price + $data->month_charge }}</td>

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
                        @php($assigen_technician = \App\Assign_technician_device::where('user_id',\App\AllUser::find($data->user_id)->first()->id)->where('status',0)->get())

                      @if($assigen_technician->count() !== 0)
                          @foreach($assigen_technician as $assigen_technician_data)
                              <a href="{{route('admin.technician.show',$assigen_technician_data->technician_id)}}">{{\App\Technician::find($assigen_technician_data->technician_id)->name}}</a>
                              <span class="right badge badge-success">{{$assigen_technician_data->created_at->diffForHumans()}}</span><br>
                          @endforeach

                       @elseif($assigen_technician->count() ==  0)
                          No Technician Assigned
                       @endif
                    </td>
                    <td>
                        {{date("jS  F Y - h:i:s A", strtotime($data->created_at))}}
                    </td>
                    <td>

                        @if($assigen_technician = \App\Assign_technician_device::where('user_id',\App\AllUser::find($data->user_id)->first()->id)->where('status',0)->exists())

                            <a class="btn btn-secondary btn-sm" href="#" style="background: #5BBC2E;width: 103px">
                              <i class="fas fa-tag">
                              </i>
                              Assigned
                          </a>
                         @else

                        @php($all_user_id = \App\AllUser::find($data->user_id)->first())
                        <a class="btn btn-secondary btn-sm" href="" data-toggle="modal" data-target="#assign_technician" onclick="user_id('{{$all_user_id->id}}','{{$data->id}}')">
                              <i class="fas fa-assistive-listening-systems">
                              </i>
                              Assign Tech
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
                  <th>Month Charge</th>
                  <th>Device quantity</th>
                  <th>Device price</th>
                  <th>Total Amount</th>
                  <th>Order Status</th>
                  <th>Assigned Technician</th>
                  <th>Order Time</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->



    <!-- Modal -->
<div class="modal fade" id="assign_technician" tabindex="-1" role="dialog" aria-labelledby="assign_technicianLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <form action="{{route('admin.technician_assign')}}" method="post">
        @CSRF
      <div class="modal-header">
        <h5 class="modal-title" id="assign_technicianLabel">Assign Technician</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <input type="hidden" value="" id="hidden_user_id" name="user_id">
          <input type="hidden" value="" id="hidden_order_id" name="order_id">
            <div class="form-group">
                    <label for="exampleFormControlSelect1">Technician Name</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="technician_id">
                        <option selected disabled>Select Technician</option>
                        @foreach($technician as $technician_data)
                      <option value="{{$technician_data->id}}">{{$technician_data->name}}</option>
                            @endforeach
                    </select>
             </div>
          <div class="form-group">
                    <label for="exampleFormControlSelect1">Collect Amount</label>
                    <input type="number" class="form-control" id="Email" name="collect_amount">
             </div>
            <div class="checkbox">
              <label><input type="checkbox" value="0" onclick="hidetable()" name="for_repair"> Only For Repair</label>
            </div>
          <table class="table table-bordered" id="dynamic_field" >
                    <tr>
                        <td>
                            <label for="exampleFormControlSelect1">Device Model</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="device_id[]">
                                <option selected disabled>Select Device</option>
                                @foreach($device as $device_data)
                              <option value="{{$device_data->id}}">{{$device_data->device_model}}</option>
                                    @endforeach
                            </select>
                            </td>
                        <td>
                            <label for="exampleFormControlSelect1">Device Quantity</label>
                            <input type="text" name="quantity[]" placeholder="Enter Quantity" class="form-control name_list" />
                        </td>
                        <td><button type="button" name="add" id="add" class="btn btn-success mt-4">Add More</button></td>
                    </tr>
          </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
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

    <script>
        var i=1;

      $('#add').click(function(){
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><select class="form-control" id="exampleFormControlSelect1" name="device_id[]"> <option selected disabled>Select Device</option>@foreach($device as $device_data)<option value="{{$device_data->id}}">{{$device_data->device_model}}</option>@endforeach</select><td><input type="text" name="quantity[]" placeholder="Enter Quantity" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></td></tr>');
      });


      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });



  function hidetable() {
  var x = document.getElementById("dynamic_field");
  if (x.style.display === "none") {
    x.style.display = "";
  } else {
    x.style.display = "none";
  }
}


function user_id(user_id,order_id) {
// hidden_user_id
    document.getElementById('hidden_user_id').value = user_id;
    document.getElementById('hidden_order_id').value = order_id;
}
    </script>

    <script type="text/javascript">
        function expier_user(id) {
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })
            swalWithBootstrapButtons({
                title: 'Are you sure Want To Expire this user?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Expire it!',
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

    <script type="text/javascript">
        function active_user(id) {
            const swalWithBootstrapButtons = swal.mixin({
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
            })
            swalWithBootstrapButtons({
                title: 'Are you sure Want To Active this user?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, Active it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('active-form-'+id).submit();
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


@endpush
