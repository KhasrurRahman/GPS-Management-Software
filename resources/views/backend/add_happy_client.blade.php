@extends('backend.layout.app')
@section('title','Blank')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Blank')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">

    <div class="col-md-12" style="margin-bottom: 10px">
    <a href="" type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add_happy_client">Add Happy Client</a>
    </div>

    @if($client->count() != 0)

<div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <div class="card-title">
                  Our happy Client
                </div>
              </div>
              <div class="card-body">
                <div class="row">

@foreach($client as $client_data)

                  <div class="col-sm-2">
                    <a href="{{asset('storage/app/public/happy_client/'.$client_data->image)}}" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery" >
                     <img src="{{asset('storage/app/public/happy_client/'.$client_data->image)}}" alt="..." style="height: 150px;" class="img-thumbnail">
                    </a>
                      <a href="{{route('admin.happy_client_delete',$client_data->id)}}" type="button" class="btn btn-danger">Delete</a>
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

  <form action="{{route('admin.happy_client_save')}}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_happy_clientLabel">Add Happy Client Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
                    <label for="exampleInputFile">Cover Image</label>
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
