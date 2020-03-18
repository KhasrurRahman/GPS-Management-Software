@extends('backend.layout.app')
@section('title','Add Service')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Add Service')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">

    <div class="col-md-12" style="margin-bottom: 10px">
    <a href="" type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add_happy_client">Add Demo Theme</a>
    </div>


@if($demo->count() != 0)

<div class="col-md-12">
<div class="card card-solid">
        <div class="card-body pb-0">
        <div class="row">
            @foreach($demo as $demo_data)
            <div class="card col-2 m-4" style="width: 18rem;">
              <img class="card-img-top" src="{{asset('storage/app/public/demo/'.$demo_data->image)}}" alt="Card image cap">
              <div class="card-body">
                <p class="card-text">{{$demo_data->link}}</p>
                <a href="{{route('admin.demo_delete',$demo_data->id)}}" class="btn btn-danger">Delete</a>
              </div>
            </div>
            @endforeach

        </div>
          </div>
        </div>

</div>

@endif
</div>






    <!-- Modal -->
<div class="modal fade" id="add_happy_client" tabindex="-1" role="dialog" aria-labelledby="add_happy_clientLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">

  <form action="{{route('admin.demo_save')}}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_happy_clientLabel">Add demo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
                    <label for="exampleInputEmail1">Demo link</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Demo Link" name="link">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">service Image</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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
