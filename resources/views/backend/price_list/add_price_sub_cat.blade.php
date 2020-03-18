@extends('backend.layout.app')
@section('title','Add price specifications')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Add price specifications')
@section('link',route('admin.adminDashboard'))
@section('content')



<div class="row">



    @if(count($sub_cat) < 20)
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Category name : {{$price->name}} </h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

              <form method="post" action="{{route('admin.sub_cat_save')}}" enctype="multipart/form-data">
                  @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">specification Name</label>
                <input type="text" id="inputName" class="form-control" placeholder="Category Name" name="name" required>
                <input type="hidden" id="inputName" class="form-control" placeholder="Category Name" name="price_id" value="{{$price->id}}">
            </div>

              <div class="form-group">
                <label for="exampleFormControlSelect1">Active/Deactive</label>
                <select class="form-control" id="exampleFormControlSelect1" name="active_status">
                  <option value="1">Active</option>
                  <option value="0">Deactive</option>
                </select>
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
              <h3 class="card-title">{{$price->name}} - Category specification (Total = {{count($sub_cat)}})</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th>Category Name</th>
                    <th>Active/Deactive</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

    @foreach($sub_cat as $data)

                  <tr>
                    <td>{{$data->name}}</td>
                    <td>
                        @if($data->active_status == 1)
                            <span class="right badge badge-success">Active</span>
                            @else
                            <span class="right badge badge-danger">Not Active</span>
                        @endif
                    </td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="{{route('admin.sub_edit',$data->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin.delete_sub',$data->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
