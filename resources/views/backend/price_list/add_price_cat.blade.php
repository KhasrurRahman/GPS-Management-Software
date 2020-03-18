@extends('backend.layout.app')
@section('title','Add price category')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Add price category')
@section('link',route('admin.adminDashboard'))
@section('content')



<div class="row">
     @if(count($price_category) <20)
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Add Price List Category</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>

              <form method="post" action="{{route('admin.price_list.store')}}" enctype="multipart/form-data">
                  @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Category Name</label>
                <input type="text" id="inputName" class="form-control" placeholder="Category Name" name="name" required>
              </div>

                <div class="form-group">
                <label for="inputName">Device price</label>
                <input type="text" id="inputName" class="form-control" placeholder="Device price" name="device_price" required>
              </div>

                <div class="form-group">
                <label for="inputName">Monthly Charge</label>
                <input type="text" id="inputName" class="form-control" placeholder="Monthly Charge" name="monthly_charge" required>
              </div>

                <div class="form-group">
                <label for="inputName">Background Image(286 x 200)</label>
                <input type="file" id="inputName" class="form-control" name="bg_image" required>
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
              <h3 class="card-title">Price Category (Total = {{count($price_category)}})</h3>

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
                    <th>MonthLy charge</th>
                    <th>Device Price</th>
                    <th>Bg Image</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

    @foreach($price_category as $data)

                  <tr>
                    <td>{{$data->name}}</td>
                    <td>{{$data->monthly_charge}}</td>
                    <td>{{$data->device_price}}</td>
                    <td><img src="{{asset('storage/app/public/price_list/'.$data->bg_image)}}" alt="" height="50"></td>
                    <td class="text-right py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="{{route('admin.add_price_subcategory',$data->id)}}" class="btn btn-info"><i class="fas fa-plus"></i></a>
                        <a href="{{route('admin.price_list.edit',$data->id)}}" class="btn btn-success"><i class="fas fa-edit"></i></a>
                        <a href="{{route('admin.price_cat_delete',$data->id)}}" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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
