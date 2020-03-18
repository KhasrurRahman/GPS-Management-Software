@extends('frontend.layout.app')
@section('title','Payment')
@push('css')
@endpush
@section('content')


<!-- Checkout Area -->
            <div class="tm-section tm-checkout-area bg-white tm-padding-section">
                <div class="container">
{{--                    <div class="tm-checkout-coupon">--}}
{{--                        <a href="#checkout-couponform" data-toggle="collapse"><span>Have a coupon code?</span> Click--}}
{{--                            here and enter your code.</a>--}}
{{--                        <div id="checkout-couponform" class="collapse">--}}
{{--                            <form action="#" class="tm-checkout-couponform">--}}
{{--                                <input type="text" id="coupon-field" placeholder="Enter coupon code" required="required">--}}
{{--                                <button type="submit" class="tm-button">Submit <b></b></button>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <form action="{{route('user.cash_on_delevery')}}" class="tm-form tm-checkout-form" method="post" id="order_form">
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
                                    <div class="tm-form-inner p-3 mt-3" style="border: 2px solid #1cb9c8;background: whitesmoke;font-weight: bold">
                                        <div class="tm-form-field">
                                            <label for="differentform-firstname">Name</label>
                                            <input type="text" name="name" value="{{$user->name}}" readonly required>
                                        </div>

                                            <input type="hidden" name="user_id" value="{{$user->id}}" readonly required>



                                            <input type="hidden" name="amount" value="{{$package->monthly_charge + $package->device_price}}" readonly required>
                                            <input type="hidden" name="package_id" value="{{$package->id}}" readonly required>


                                        <div class="tm-form-field">
                                            <label for="differentform-companyname">Company name(Optional)</label>
                                            <input type="text" name="company_name" placeholder="Company Name">
                                        </div>

                                        <div class="tm-form-field">
                                            <label for="differentform-email">Email address</label>
                                            <input type="email" name="email" value="{{$user->email}}" required readonly>
                                        </div>


                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <label for="differentform-phone">Phone</label>
                                            <input type="text" value="{{$user->phone}}" name="phone" required readonly>
                                        </div>

                                        <div class="tm-form-field tm-form-fieldhalf">
                                            <label for="differentform-phone">Secondary Phone(Optional)</label>
                                            <input type="text" name="phone_2" >
                                        </div>

                                        <div class="tm-form-field">
                                            <label for="differentform-address">Address</label>
                                            <input type="text" name="address"  placeholder="Address" value="{{$user->par_add}}" required >
                                        </div>

                                        <div class="tm-form-field">
                                            <label for="differentform-address">Car Model</label>
                                            <input type="text"  placeholder="Car model" name="car_model" required>
                                        </div>

                                        <div class="tm-form-field">
                                            <label>Installation Date</label>
                                            <input type="date"  placeholder="Installation date" name="installation_date" required>
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
                                                    <td>5</td>
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
{{--                                                <input type="radio" name="paymeny_method" id="checkout-payment-paypal"  checked onclick="cashpay()">--}}
{{--                                                <label for="checkout-payment-paypal">Pay via SSLCOMARZ</label>--}}
{{--                                                <div class="tm-checkout-payment-content">--}}
{{--                                                    <p>Card, bkash, Rocket, Bank</p>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="tm-form-field">
                                                <input type="radio" name="paymeny_method_2" id="checkout-payment-cashondelivery" checked onclick="cashon_delevery()">
                                                <label for="checkout-payment-cashondelivery">Cash On Delivery</label>
                                                <div class="tm-checkout-payment-content">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tm-checkout-submit">
                                        <p>Your personal data will be used to process your order, support your
                                            experience throughout this website, and for other purposes described in our
                                            privacy policy.</p>
                                        <div class="tm-form-inner">
                                            <div class="tm-form-field">
                                                <input type="checkbox" name="checkout-read-terms" id="checkout-read-terms" required>
                                                <label for="checkout-read-terms">I have read and agree to the website
                                                    terms and conditions</label>
                                            </div>

                                            <div class="tm-form-field" id="paymeny_method_1">
                                                <button type="submit" class="tm-button btn-block">Place Order<b></b></button>
                                            </div>

{{--                                            <div class="tm-form-field" id="paymeny_method_2">--}}
{{--                                                <button type="submit" class="tm-button btn-block">Place Order <b></b></button>--}}
{{--                                            </div>--}}
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



    function cashon_delevery() {
        $('#order_form').attr('action','{{route('user.cash_on_delevery')}}');
    }
    function cashpay() {
        $('#order_form').attr('action','{{ url('/pay') }}');
    }

</script>



@endsection
@push('js')
@endpush
