@extends('backend.layout.app')
@section('title','Edit User')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Edit user')
@section('link',route('admin.adminDashboard'))
@section('content')


<form role="form" action="{{route('admin.all_user.update',$user->id)}}" method="post">
    @csrf
    @method('PATCH')
<div class="row">
    <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">User Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="Name" placeholder="Enter email" name="name" value="{{$user->name}}">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Alternative Phone(If Any)</label>
                    <input type="text" class="form-control" id="Phone" placeholder="Alternative Phone" name="alter_phone" value="{{$user->phone}}">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="Email" placeholder="Email" name="email" value="{{$user->email}}" >
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Present Address</label>
                    <input type="text" class="form-control" id="Present Address" placeholder="Password" name="par_add" value="{{$user->par_add}}">
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>
    <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Car Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Car Number</label>
                    <input type="text" class="form-control" id="Name" placeholder="Car Number" name="car_number" value="{{$user->car_number}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Car Model</label>
                    <input type="text" class="form-control" id="Phone" placeholder="Car Model" name="car_model" value="{{$user->car_model}}">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">installation Date</label>
                    <input type="date" class="form-control" id="Email" placeholder="installation Date" name="installation_date" value="{{$user->installation_date}}">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Device Price</label>
                    <input type="number" class="form-control"  placeholder="Device Price" name="device_price" value="{{$user->device_price}}">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Monthly Bill</label>
                    <input type="text" class="form-control" id="Present Address" placeholder="Monthly Bill" name="monthly_bill" value="{{$user->monthly_bill}}">
                  </div>

                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
    </div>

    <button type="submit" class="btn btn-success ml-2">Update user</button>
</div>
</form>









@endsection
@push('js')
@endpush
