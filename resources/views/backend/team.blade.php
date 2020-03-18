@extends('backend.layout.app')
@section('title','Team')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Team')
@section('link',route('admin.adminDashboard'))
@section('content')


<div class="row">
@if($team->count() <5)
    <div class="col-md-12" style="margin-bottom: 10px">
    <a href="" type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add_happy_client">Add Member</a>
    </div>
@endif

@if($team->count() != 0)
<div class="col-md-12">
<div class="card card-solid">
        <div class="card-body pb-0">
        <div class="row">
            @foreach($team as $team_data)
            <div class="col-3">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b>{{$team_data->name}}</b></h2>
                      <p class="text-muted text-sm">{{$team_data->designation}}</p>
                        <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fab fa-facebook-f"></i></span>{{$team_data->fb_link}}</li>
                        <li class="small"><span class="fa-li"><i class="fab fa-skype"></i></span>{{$team_data->skipe_link}}</li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="{{asset('storage/app/public/team/'.$team_data->image)}}" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">

                    <a href="{{route('admin.team_delete',$team_data->id)}}" class="btn btn-sm btn-danger">
                     Delete
                    </a>
                  </div>
                </div>
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

  <form action="{{route('admin.team_save')}}" method="post" enctype="multipart/form-data">
      @csrf
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add_happy_clientLabel">Add Team Member</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Member name</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Member name" name="name">
                  </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Member Designation</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Member Designation" name="designation">
                  </div>

          <div class="form-group">
                    <label for="exampleInputEmail1">Facebook link</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Facebook link" name="fb_link">
                  </div>
          <div class="form-group">
                    <label for="exampleInputEmail1">skype link</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Facebook link" name="skipe_link">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">profile Picture</label>
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
