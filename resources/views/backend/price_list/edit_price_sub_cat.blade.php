@extends('backend.layout.app')
@section('title','Edit price specifications')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Edit price specifications')
@section('link',route('admin.adminDashboard'))
@section('content')



<div class="row">
    <a href="{{route('admin.add_price_subcategory',$sub->price_id)}}" class="btn btn-success ml-2 mb-3">Back</a>
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">specifications name : {{$sub->name}}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

              <form method="post" action="{{route('admin.sub_update',$sub->id)}}" enctype="multipart/form-data">
                  @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">specification Name</label>
                <input type="text" id="inputName" class="form-control" placeholder="Category Name" name="name" required value="{{$sub->name}}">
            </div>

              <div class="form-group">
                <label for="exampleFormControlSelect1">Active/Deactive</label>
                <select class="form-control" id="exampleFormControlSelect1" name="active_status">
                  <option value="1" {{ $sub->active_status == 1 ? 'selected':'' }}>Active</option>
                  <option value="0" {{ $sub->active_status == 0 ? 'selected':'' }}>Deactive</option>
                </select>
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
