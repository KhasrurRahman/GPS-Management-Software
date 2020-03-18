@extends('backend.layout.app')
@section('title','Edit price category')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Edit price category')
@section('link',route('admin.adminDashboard'))
@section('content')



<div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Price List Category</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

              <form method="post" action="{{route('admin.price_list.update',$price->id)}}" enctype="multipart/form-data">
                  @csrf
                  @method('PATCH')
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Category Name</label>
                <input type="text" id="inputName" class="form-control" placeholder="Category Name" name="name" value="{{$price->name}}" required>
              </div>

                <div class="form-group">
                <label for="inputName">Device price</label>
                <input type="text" id="inputName" class="form-control" placeholder="Device price" name="device_price" value="{{$price->device_price}}" required>
              </div>

                <div class="form-group">
                <label for="inputName">Monthly Charge</label>
                <input type="text" id="inputName" class="form-control" placeholder="Monthly Charge" name="monthly_charge" value="{{$price->monthly_charge}}" required>
              </div>

                <div class="form-group">
                <label for="inputName">Background Image</label>
                <input type="file" id="inputName" class="form-control" name="bg_image">
                    <img src="{{asset('storage/app/public/price_list/'.$price->bg_image)}}" alt="" height="100">

              </div>

                <button type="submit" class="btn btn-success">Update</button>

            </div>

              </form>

          </div>
          <!-- /.card -->
        </div>

      </div>







@endsection
@push('js')
@endpush
