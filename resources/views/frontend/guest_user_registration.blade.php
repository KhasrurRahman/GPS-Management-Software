@extends('frontend.layout.app')
@section('title','Payment')
@push('css')
@endpush
@section('content')


<!-- Checkout Area -->
            <div class="tm-section tm-checkout-area bg-white tm-padding-section">
                <div class="container">
                    <form action="{{route('guest_customer_order_with_package_id',$package->id)}}" class="tm-form tm-checkout-form" method="post">
                        @csrf
                 <div class="row">

                  <div class="col-md-6 col-sm-12">
                   <!-- Shopping Cart Table -->
                    <div class="tm-cart-table table-responsive" style="border: 1px solid #f36d3d">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th class="tm-cart-col-productname" scope="col">Package Name</th>
                                    <th class="tm-cart-col-price" scope="col">Price</th>
                                    <th class="tm-cart-col-quantity" scope="col">Quantity</th>
                                    <th class="tm-cart-col-total" scope="col">Total</th>
                                </tr>
                            </thead>


                            <tbody>
                                <tr>
                                    <td>
                                        {{$package->name}}
                                    </td>
                                    <td class="tm-cart-price">{{$package->device_price}}</td>
                                    <td>
                                        <div class="tm-quantitybox">
                                            <input type="text" value="1">
                                        </div>
                                    </td>
                                    <td>
                                        <span class="tm-cart-totalprice">{{$package->device_price}}</span>
                                    </td>
                                </tr>



                            </tbody>
                        </table>
                    </div>
                    <!--// Shopping Cart Table -->
                                    <div class="tm-form-inner p-3 mt-3" style="border: 2px solid #1cb9c8;background: whitesmoke;font-weight: bold"><div class="row">
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="name">Your name<font color="red">*</font></label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ old('name') }}">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
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
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="email">Email address<font color="red">*</font></label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your valid email address" value="{{ old('email') }}" autocomplete="off">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
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
                                            <div class="col-sm-12 col-lg-6">
                                                <div class="form-group">
                                                    <label for="password">Password (Min 4 character)<font color="red">*</font></label>
                                                    <input type="password" class="form-control" id="password" name="password" placeholder="Your password" autocomplete="off">
                                                </div>
                                                @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                            <div class="col-sm-12 col-lg-6">
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
                                        </div>

                                    </div>

                  </div>


                    <div class="col-sm-12 col-md-4">
                                <div class="tm-checkout-orderinfo" style="height: 100%">
                                    <div class="table-responsive">
                                        <table class="table table-borderless tm-checkout-ordertable">
                                            <thead>
                                                <tr>
                                                    <th>Package</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$package->name}}</td>
                                                    <td>{{$package->monthly_charge + $package->device_price}}</td>
                                                </tr>

                                            </tbody>
                                            <tfoot>
                                                <tr class="tm-checkout-subtotal">
                                                    <td>Quantity</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr class="tm-checkout-shipping">
                                                    <td>Device price</td>
                                                    <td>{{$package->device_price}}</td>
                                                </tr>
                                                <tr class="tm-checkout-shipping">
                                                    <td>Monthly Charge <small>(1 Month)</small></td>
                                                    <td>300tk</td>
                                                </tr>

                                                <tr class="tm-checkout-total">
                                                    <td>Total</td>
                                                    <td>{{$package->monthly_charge + $package->device_price}}tk</td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                    <div class="tm-checkout-payment">
                                        <h4>Select Payment Method</h4>
                                        <div class="tm-form-inner">
{{--                                            <div class="tm-form-field">--}}
{{--                                                <input type="radio" name="paymeny_method" id="checkout-payment-paypal"  checked>--}}
{{--                                                <label for="checkout-payment-paypal">Pay via SSLCOMARZ</label>--}}
{{--                                                <div class="tm-checkout-payment-content">--}}
{{--                                                    <p>Card, bkash, Rocket, Bank</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="tm-form-field">
                                                <input type="radio" name="paymeny_method_2"  checked id="checkout-payment-cashondelivery">
                                                <label for="checkout-payment-cashondelivery">Cash On Delivery</label>
                                                <div class="tm-checkout-payment-content">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tm-checkout-submit">
                                        <p>After </p>
                                        <div class="tm-form-inner">
{{--                                            <div class="tm-form-field">--}}
{{--                                                <input type="checkbox" name="checkout-read-terms" id="checkout-read-terms" required>--}}
{{--                                                <label for="checkout-read-terms">I have read and agree to the website--}}
{{--                                                    terms and conditions</label>--}}
{{--                                            </div>--}}

                                            <div class="tm-form-field" id="paymeny_method_1">
                                                <button type="submit" class="tm-button btn-block">Place Order <b></b></button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                     </div>

                    </form>
                </div>
            </div>
            <!--// Checkout Area -->



<script>

    $(".paymeny_method").click(function() {
        $("paymeny_method_2").hide();
        $("paymeny_method_1").show();
    });
    $("paymeny_method_1").click(function() {
        $("paymeny_method_1").hide();
        $("paymeny_method_2").show();
    });

</script>



@endsection
@push('js')
@endpush
