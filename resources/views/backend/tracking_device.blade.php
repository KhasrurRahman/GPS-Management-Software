@extends('backend.layout.app')
@section('title','Tracking Device')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Tracking Device')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">

    <div class="col-md-12" style="margin-bottom: 10px">
    <a href="" type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add_happy_client">Add Tracking Device</a>
    </div>

    @if($device->count() != 0)

<div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Tracking Device
                </div>
              </div>
              <div class="card-body">
                <div class="row">

@foreach($device as $data)

                  <div class="col-sm-2">
                    <a href="{{asset('storage/app/public/tracking_device/'.$data->image)}}" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery" >
                     <img src="{{asset('storage/app/public/tracking_device/'.$data->image)}}" alt="..." style="height: 150px;" class="img-thumbnail">
                    </a>

                      <h5>{{$data->device_name}}</h5>
                      <p>{{$data->description}}</p>

                      <a href="{{route('admin.tracking_device_delete',$data->id)}}" type="button" class="btn btn-danger">Delete</a>
                  </div>
@endforeach

                </div>
              </div>
            </div>
          </div>

</div>

@endif
    <!-- Modal -->
<div class="modal fade" id="add_happy_client" tabindex="-1" role="dialog" aria-labelledby="add_happy_clientLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

  <form action="{{route('admin.tracking_device_save')}}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_happy_clientLabel">Add Tracking Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="form-group">
            <label for="exampleInputEmail1">Device name</label>
            <input type="text" class="form-control"  placeholder="Device Name" name="name">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">Device Description</label>
            <input type="text" class="form-control"  placeholder="Device Description" name="description">
          </div>



        <div class="form-group">
                    <label for="exampleInputFile">Device Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="" id="exampleInputFile" name="image">
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                    </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
      </form>

  </div>
</div>


@endsection
@push('js')
@endpush
