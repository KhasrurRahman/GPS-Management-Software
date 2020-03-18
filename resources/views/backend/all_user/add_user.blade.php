@extends('backend.layout.app')
@section('title','Add User')
@push('css')
@endpush
@section('main_menu','HOME')
@section('active_menu','Add user')
@section('link',route('admin.adminDashboard'))
@section('content')


<form role="form" action="{{route('admin.all_user.store')}}" method="post">
    @csrf
<div class="row">
    <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">User Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{ old('name') }}">
                       @if ($errors->has('name'))
                           <span class="text-danger">{{ $errors->first('name') }}</span>
                       @endif
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text"  pattern=".{11,11}" max="11" class="form-control" id="phone" placeholder="Phone" name="phone" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                           <span class="text-danger">{{ $errors->first('phone') }}</span>
                       @endif
                  </div>
                    <div class="form-group">
                    <label for="alter_phone">Alternative Phone(If Any)</label>
                    <input type="text" class="form-control" id="alter_phone" placeholder="Alternative Phone" name="alter_phone" value="{{ old('alter_phone') }}">
                @if ($errors->has('alter_phone'))
                           <span class="text-danger">{{ $errors->first('alter_phone') }}</span>
                       @endif
                  </div>
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                           <span class="text-danger">{{ $errors->first('email') }}</span>
                       @endif
                  </div>
                    <div class="form-group">
                    <label for="par_add">Present Address</label>
                    <input type="text" class="form-control" id="par_add" placeholder="Present Address" name="par_add" value="{{ old('par_add') }}">
                @if ($errors->has('par_add'))
                           <span class="text-danger">{{ $errors->first('par_add') }}</span>
                       @endif
                  </div>
                   <div class="form-group">
                        <label>Select User Type</label>
                        <select class="form-control" name="user_type">
                          <option value="1" selected>Individual</option>
                          <option value="2">Corporate</option>
                        </select>
                   </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </div>
    <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Car Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <div class="form-group">
                    <label for="car_number">Car Number</label>
                    <input type="text" class="form-control" id="car_number" placeholder="Car Number" name="car_number" value="{{ old('car_number') }}">
                @if ($errors->has('car_number'))
                           <span class="text-danger">{{ $errors->first('car_number') }}</span>
                       @endif
                  </div>
                  <div class="form-group">
                    <label for="car_model">Car Model</label>
                    <input type="text" class="form-control" id="car_model" placeholder="Car Model" name="car_model" value="{{ old('car_model') }}">
                @if ($errors->has('car_model'))
                           <span class="text-danger">{{ $errors->first('car_model') }}</span>
                       @endif
                  </div>
                    <div class="form-group">
                    <label for="installation_date">installation Date</label>
                    <input type="date" class="form-control" id="installation_date" placeholder="installation Date" name="installation_date" value="{{ old('installation_date') }}">
                @if ($errors->has('installation_date'))
                           <span class="text-danger">{{ $errors->first('installation_date') }}</span>
                       @endif
                  </div>
                    <div class="form-group">
                    <label for="device_price">Device Price</label>
                    <input type="number" class="form-control" id="device_price" placeholder="Device Price" name="monthly_bill" value="{{ old('device_price') }}">
                @if ($errors->has('device_price'))
                           <span class="text-danger">{{ $errors->first('device_price') }}</span>
                       @endif
                  </div>
                    <div class="form-group">
                    <label for="monthly_bill">Monthly Bill</label>
                    <input type="number" class="form-control" id="monthly_bill" placeholder="Monthly Bill" name="monthly_bill" value="{{ old('monthly_bill') }}">
                @if ($errors->has('monthly_bill'))
                           <span class="text-danger">{{ $errors->first('monthly_bill') }}</span>
                       @endif
                  </div>
                    <div class="form-group">
                    <label for="due_date">Due Date</label>
                    <input type="date" class="form-control" id="due_date" placeholder="Due Date" name="due_date" value="{{ old('due_date') }}" onchange="check_date()">
                @if ($errors->has('due_date'))
                           <span class="text-danger">{{ $errors->first('due_date') }}</span>
                       @endif
                  </div>
{{--                    <div class="form-group" style="display: none" id="hidden_part">--}}
{{--                    <label for="payment_this_date">Please Input The Advance Payment Amount</label>--}}
{{--                    <input type="number" class="form-control" id="payment_this_date" placeholder="Advanced Amount" name="payment_this_date" value="{{ old('payment_this_date') }}">--}}
{{--                @if ($errors->has('payment_this_date'))--}}
{{--                           <span class="text-danger">{{ $errors->first('payment_this_date') }}</span>--}}
{{--                       @endif--}}
{{--                  </div>--}}
{{--                    <div class="form-group">--}}
{{--                    <label for="exampleInputPassword1">Total Paid Amount(if Possible)</label>--}}
{{--                    <input type="number" class="form-control" id="Present Address" placeholder="Total Paid Amount(if Possible)" name="total_paied">--}}
{{--                  </div>--}}

                </div>
                <!-- /.card-body -->

            </div>
            <!-- /.card -->
    </div>

    <button type="submit" class="btn btn-success ml-2">Add user</button>
</div>
</form>









@endsection
@push('js')

    <script>
        function check_date() {

            var picked_date = new Date(document.getElementById('due_date').value);
            picked_date = new Date(picked_date.getFullYear(), picked_date.getMonth(), 1);
            var dd = String(picked_date.getDate()).padStart(2, '0');
            var mm = String(picked_date.getMonth() - 1).padStart(2, '0'); //January is 0!
            var yyyy = picked_date.getFullYear();
            picked_date = yyyy + '-' + mm + '-' + dd;

            var today = new Date();
            var today = new Date(today.getFullYear(), today.getMonth(), 1);
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() - 1).padStart(2, '0'); //January is 0!
            var yyyy = today.getFullYear();
            today = yyyy + '-' + mm + '-' + dd;


            if(today < picked_date){
                document.getElementById('hidden_part').style.display = "block";
            }else{
                document.getElementById('hidden_part').style.display = "none";
            }
        }
    </script>
@endpush
