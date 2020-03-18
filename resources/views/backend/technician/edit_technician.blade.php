@extends('backend.layout.app')
@section('title','Edit Technician')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Edit Technician')
@section('link',route('admin.adminDashboard'))
@section('content')


<form role="form" action="{{route('admin.technician.update',$technician->id)}}" method="post">
    @csrf
    @method('PATCH')
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
                    <input type="text" class="form-control" id="Name" placeholder="Enter name" name="name" value="{{$technician->name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Phone</label>
                    <input type="text" class="form-control" id="Phone" placeholder="Phone" name="phone" value="{{$technician->phone}}">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="Email" placeholder="Email" name="email" value="{{$technician->email}}">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <input type="text" class="form-control" id="Present Address" placeholder="Present Address" name="address" value="{{$technician->address}}">
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
    <button type="submit" class="btn btn-success ml-2">Update Technician</button>
    </div>

</div>
</form>









@endsection
@push('js')
@endpush
