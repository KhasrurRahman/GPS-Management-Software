@extends('backend.layout.app')
@section('title','Add Home page Cover banner')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Add home Page banner')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">
    <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">website Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="{{route('admin.home_page_banner_save')}}" enctype="multipart/form-data">
                  @csrf
                <div class="card-body">

                    <div class="form-group">
                    <label for="exampleInputPassword1">Cover Image</label>
                    <input type="file" class="form-control" id="exampleInputPassword1" placeholder="Cover Small text" name="cover_image">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
 </div>
@foreach($home as $data)

<div class="col-md-6">
            <div class="card card-default">
              <div class="card-body">
                <div class="callout callout-warning">
                  <h5>Cover image</h5>
                    ​<picture>
                      <source srcset="{{asset('storage/app/public/home_cover/'.$data->cover_image)}}" type="image/svg+xml">
                      <img src="{{asset('storage/app/public/home_cover/'.$data->cover_image)}}" class="img-fluid img-thumbnail" alt="...">
                    </picture>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    <a href="{{route('admin.home_page_banner_delete',$data->id)}}" type="button" class="btn btn-danger">Delete</a>
</div>
@endforeach
</div>







@endsection
@push('js')
@endpush
