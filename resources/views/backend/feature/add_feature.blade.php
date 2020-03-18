@extends('backend.layout.app')
@section('title','Add Feature')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Add Feature')
@section('link',route('admin.adminDashboard'))
@section('content')



<div class="row">
     @if(count($feature) <20)
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add feature</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

              <form method="post" action="{{route('admin.feature_save')}}" enctype="multipart/form-data">
                  @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Feature Name</label>
                <input type="text" id="inputName" class="form-control" placeholder="Category Name" name="name" required>
              </div>

               <div class="form-group">
                <label for="inputName">Background Image(70 x 70)</label>
                <input type="file" id="inputName" class="form-control" name="image" required>
              </div>

                <button type="submit" class="btn btn-success">Save</button>

            </div>

              </form>

          </div>
          <!-- /.card -->
        </div>
        @endif


        <div class="col-md-6">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Price Category (Total = {{count($feature)}})</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Feature Name</th>
                    <th>Feature Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

    @foreach($feature as $data)

                  <tr>
                    <td>{{$data->name}}</td>
                    <td><img src="{{asset('storage/app/public/feature/'.$data->image)}}" alt="" height="50"></td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="{{route('admin.feature_edit',$data->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin.feature_delete',$data->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                      </div>
                    </td>
                  </tr>

    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>







@endsection
@push('js')
@endpush
