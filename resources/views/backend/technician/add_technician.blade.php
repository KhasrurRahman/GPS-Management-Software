@extends('backend.layout.app')
@section('title','Add Technician')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Add Technician')
@section('link',route('admin.adminDashboard'))
@section('content')


<form role="form" action="{{route('admin.technician.store')}}" method="post">
    @csrf
<div class="row">
    <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Technician Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="Name" placeholder="Enter name" name="name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="text" class="form-control" id="Phone" placeholder="Phone" name="phone">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="Email" placeholder="Email" name="email">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="text" class="form-control" id="Present Address" placeholder="Present Address" name="address">
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
    <button type="submit" class="btn btn-success ml-2">Add Technician</button>
    </div>

</div>
</form>









@endsection
@push('js')
@endpush
