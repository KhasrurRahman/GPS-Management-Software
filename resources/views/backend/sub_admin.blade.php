@extends('backend.layout.app')
@section('title','Sub Admins')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Sub Admins')
@section('link',route('admin.adminDashboard'))
@section('content')




<div class="card">
            <div class="card-header">
              <h3 class="card-title">Total User: <span class="badge badge-secondary">{{$user->count()}}</span></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($user as $key=>$data)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$data->name}}</td>
                        <td>{{$data->email}}</td>
                        <td>{{$data->phone}}</td>
                        <td>
                            @if($data->role == 3)
                                <span class="right badge badge-danger">Not Approve</span>
                            @elseif($data->role == 0)
                                <span class="right badge badge-success">Approved</span>
                            @endif
                        </td>
                        <td>
                            @if($data->role == 3)
                                <a href="{{route('admin.sub_admins_approve',$data->id)}}" class="btn btn-success">Approve</a>
                            @elseif($data->role == 0)
                                <a href="{{route('admin.sub_admins_approve',$data->id)}}" class="btn btn-danger">Not Approve</a>
                            @endif

                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->







@endsection
@push('js')
@endpush
