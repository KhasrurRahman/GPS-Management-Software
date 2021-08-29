@extends('backend.layout.app')
@section('title','Technician Profile')
@push('css')
    <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endpush
@section('main_menu','HOME')
@section('active_menu','Technician')
@section('link',route('admin.adminDashboard'))
@section('content')


    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Technician Detail</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12">
                            <h4>Technician History</h4>
                            <div class="card">
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Assign For</th>
                                            <th>Assign reason</th>
                                            <th>Assigned Time</th>
                                            <th>Status</th>
                                            <th>Notes</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($technician_history as $key=>$technician_history_data)

                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    @php($user_name=\App\AllUser::find($technician_history_data->user_id))
                                                    <a href="{{route('admin.all_user.show',$user_name->id)}}">{{$user_name->name}}</a>
                                                </td>
                                                <td>
                                                    {{$technician_history_data->note}}
                                                </td>
                                                <td>{{$technician_history_data->created_at->diffForHumans()}}</td>
                                                <td>
                                                    @if($technician_history_data->status == 0)
                                                        <span class="right badge badge-danger">incomplete</span>
                                                    @elseif($technician_history_data->status == 2)
                                                        <span class="right badge badge-warning">Canceled</span>
                                                    @else
                                                        <span class="right badge badge-success">Complete</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($technician_history_data->note == null)
                                                        ----
                                                    @else
                                                        {{$technician_history_data->note}}
                                                    @endif

                                                </td>
                                                <td>
                                                    @if($technician_history_data->status == 1)
                                                        <button class="btn btn-info btn-sm" href="#" disabled>
                                                            Confirm
                                                        </button>

                                                    @elseif($technician_history_data->status == 2)
                                                        <button class="btn btn-info btn-sm" href="#" disabled>
                                                            Confirm
                                                        </button>
                                                    @else
                                                        <a class="btn btn-info btn-sm" href="{{route('admin.confirm_complain',$technician_history_data->id)}}" >
                                                            Confirm
                                                        </a>

                                                        <a class="btn btn-danger btn-sm" href="#"
                                                           onclick="pass_id_to_cancel_mocel({{$technician_history_data->id}})">cancel
                                                        </a>

                                                    @endif
                                                </td>
                                            </tr>

                                        @endforeach


                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Assign For</th>
                                            <th>Assign reason</th>
                                            <th>Assigned Time</th>
                                            <th>Status</th>
                                            <th>Notes</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <!-- Widget: user widget style 2 -->
                    <div class="card card-widget widget-user-2">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header bg-warning">
                            <div class="widget-user-image">
                                <img class="img-circle elevation-2" src="{{asset('public/assets/backend/img/avatar5.png')}}" alt="User Avatar">
                            </div>
                            <!-- /.widget-user-image -->
                            <h3 class="widget-user-username">{{$technician->name}}</h3>
                            <h5 class="widget-user-desc">Technician</h5>
                        </div>
                        <div class="card-footer p-0">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Email <span class="float-right badge bg-primary">{{$technician->email}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Phone <span class="float-right badge bg-info">{{$technician->phone}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Address <span class="float-right badge bg-success">{{$technician->address}}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Order Completed <span class="float-right badge bg-danger">{{count($completed_order)}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="cancel_order" tabindex="-1" role="dialog" aria-labelledby="cancel_orderLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('admin.order_cancel')}}" id="cencel_form" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancel_orderLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Reason</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="assign_reason"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Cancel</button>
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


        function pass_id_to_cancel_mocel(id) {
            console.log(id);
            var out = '<div class="form-group"><label for="exampleInputPassword1">What Is The Reason?</label><input type="text" class="form-control" name="note"><input type="hidden" class="form-control" name="assign_id" value="' + id + '"></div>';
            $(".modal-body").html(out);
            $('#cancel_order').modal('show');
        }
    </script>

@endpush
