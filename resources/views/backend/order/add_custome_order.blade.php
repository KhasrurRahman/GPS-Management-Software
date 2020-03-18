@extends('backend.layout.app')
@section('title','Add Custom Order')
@push('css')
        <style>
        .note{
            text-align: center;
            background: -webkit-linear-gradient(left, #f15922, #ce3600);
            color:
            #fff;
            font-weight: bold;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .form-content {
            background:
            white;
            padding: 4%;
            border: 1px solid
            #ced4da;
            margin-bottom: 2%;
        }
        #reg_form .form-group input {
            background: rgba(22, 70, 158, .18);
            color: #17479e;
        }
        .custom-select {
            background: rgba(22, 70, 158, .18);
            color: #17479e;
        }

            .select2-container .select2-selection--single{
    height:34px !important;
}
.select2-container--default .select2-selection--single{
         border: 1px solid #ccc !important;
     border-radius: 0px !important;
}
    </style>



<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

@endpush
@section('main_menu','HOME')
@section('active_menu','Add Custom Order')
@section('link',route('admin.adminDashboard'))
@section('content')

<div class="container">

    <form action="{{route('admin.order.store')}}" method="post">
@csrf

    <div class="form-content">
                                        <div class="row">


                                        <div class="col-md-12 mb-3">
                                            <div class="col-md-6">
                                                <div class="radio">
                                                  <label><input type="radio" name="radio"  value="new_user" checked onclick="new_user()">New user</label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="radio">
                                                  <label><input type="radio" name="radio" value="old_user" onclick="old_user()">Old user</label>
                                                </div>
                                            </div>
                                        </div>




                                            <div class="form-group p-2">
                                                        <label for="exampleFormControlSelect1">Select Package</label>
                                                        <select class="form-control select2" id="exampleFormControlSelect2" style="width: 1022px;padding: 5px;" name="package_id">

                                                          <option disabled selected>Select package</option>

                                                            @foreach($package as $key=>$data)
                                                          <option value="{{$data->id}}">{{$key+1}}. {{$data->name}} -> Device Price {{$data->device_price}} -> Monthly Charge: {{$data->monthly_charge}}</option>
                                                            @endforeach

                                                        </select>
                                             </div>



<span class="col-md-12" id="new_user_reg_form">

                                                <div class="col-sm-12 col-lg-12">
                                                    <label for="name">User name<font color="red">*</font></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="par_add">Address details<font color="red">*</font></label>
                                                        <input type="text" class="form-control" id="par_add" name="par_add" placeholder="Enter your address details"  autocomplete="off" value="{{ old('par_add') }}">
                                                        @if ($errors->has('par_add'))
                                                            <span class="text-danger">{{ $errors->first('par_add') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="email">Email address<font color="red">*</font></label>
                                                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your valid email address" value="{{ old('email') }}" autocomplete="off">
                                                        @if ($errors->has('email'))
                                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="phone">Mobile Number<font color="red">*</font></label>
                                                        <div class="input-group mb-2">
                                                            <div class="input-group-prepend">
                                                                <div class="input-group-text">+88</div>
                                                            </div>
                                                            <input type="text" pattern=".{11,11}" max="11" class="form-control" id="phone" name="phone" placeholder="Enter your mobile number" autocomplete="off">
                                                            @if ($errors->has('phone'))
                                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="password">Password (Min 4 character)<font color="red">*</font></label>
                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Your password" autocomplete="off">
                                                    </div>
                                                    @if ($errors->has('password'))
                                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="password-confirm">Confirm password<font color="red">*</font></label>
                                                        <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="Confirm password" autocomplete="new-password">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label>Vehicle Registration Number</label>
                                                        <input type="text" class="form-control"  placeholder="Vehicle Registration Number"  name="car_number">

                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-lg-12">
                                                    <div class="form-group">
                                                        <label for="car_model">Vehicle Brand & Model<font color="red">*</font></label>
                                                        <input type="text" class="form-control"  placeholder="Vehicle Brand & Model" id="car_model" name="car_model" value="{{ old('car_model') }}">
                                                        @if ($errors->has('car_model'))
                                                            <span class="text-danger">{{ $errors->first('car_model') }}</span>
                                                     @endif
                                                    </div>
                                                </div>

</span>




<span class="col-md-12" id="old_user" style="display: none">


                                                    <div class="form-group p-2">
                                                        <label for="exampleFormControlSelect1">Select User</label>
                                                        <select class="form-control select2" id="exampleFormControlSelect1" style="width: 1022px;padding: 5px;" name="user_id">

                                                          <option disabled selected>Select User</option>

                                                            @foreach($user as $key=>$data)
                                                          <option value="{{$data->id}}">{{$key+1}}. {{$data->name}} --> {{$data->phone}}</option>
                                                            @endforeach

                                                        </select>
                                                      </div>



</span>






                                        </div>



                                        <button type="submit" name="save" class="btn btn-block btn-success btnSubmit" data-bs-hover-animate="pulse" style="padding: 10px;">
                                            Create Order
                                        </button>
                                    </div>



        </form>

</div>









@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        function new_user() {
            document.getElementById("old_user").style.display = "none";
            document.getElementById("new_user_reg_form").style.display = "block";
        }

        function old_user() {
            document.getElementById("old_user").style.display = "block";
            document.getElementById("new_user_reg_form").style.display = "none";
        }

    </script>


  <script>
    $('.select2').select2();
</script>

@endpush
