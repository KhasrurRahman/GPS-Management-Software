@extends('backend.layout.app')
@section('title','Edit Device')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Edit Device')
@section('link',route('admin.adminDashboard'))
@section('content')


<form role="form" action="{{route('admin.device.update',$device->id)}}" method="post">
    @csrf
    @method('Patch')
<div class="row">
    <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Device Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Device Company name</label>
                    <input type="text" class="form-control" id="Name" name="device_name" value="{{$device->device_name}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Device Model</label>
                    <input type="text" class="form-control" id="Phone" name="device_model" value="{{$device->device_model}}">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Device Price</label>
                    <input type="text" class="form-control" id="Email" name="device_price" value="{{$device->device_price}}">
                  </div>
                    <div class="form-group">
                    <label for="exampleInputPassword1">Device quantity</label>
                    <input type="number" class="form-control" id="Email" name="quantity" value="{{$device->quantity}}">
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
    <button type="submit" class="btn btn-success ml-2">Save</button>
    </div>

</div>
</form>









@endsection
@push('js')
@endpush
