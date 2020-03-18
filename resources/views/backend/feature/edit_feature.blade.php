@extends('backend.layout.app')
@section('title','Edit feature')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Edit feature')
@section('link',route('admin.adminDashboard'))
@section('content')



<div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Feature</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

              <form method="post" action="{{route('admin.update_feature',$feature->id)}}" enctype="multipart/form-data">
                  @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Feature Name</label>
                <input type="text" id="inputName" class="form-control" placeholder="Category Name" name="name" value="{{$feature->name}}" required>
              </div>

                <div class="form-group">
                <label for="inputName">Image (70x70)</label>
                <input type="file" id="inputName" class="form-control" name="image">
                <img src="{{asset('storage/app/public/feature/'.$feature->image)}}" alt="" height="100" class="product-image-thumb">

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
