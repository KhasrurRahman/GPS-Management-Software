 <!-- Header Bottom Area -->
            <div class="header-bottomarea">
                <div class="container">
                    <div class="header-bottominner">
                        <div class="header-logo">
                            <a href="{{url('/')}}">
                                <img src="{{asset("public/assets/backend/img/gps-tracker.png")}}" alt="logo" style="height: 45px">
                            </a>
                        </div>
                        <nav class="tm-navigation">
                            <ul>
                                <li class="tm-navigation-dropdown"><a href="{{url('/')}}">Home</a></li>
                                <li><a href="{{route('feature')}}">Features</a></li>
                                <li><a href="{{route('price_list')}}">Pricing</a></li>
                                <li><a href="{{route('our_devices')}}">Tracking Devices</a></li>
                                <li><a href="{{route('Pay_bill')}}">Pay Bill</a></li>
                                <li><a href="{{route('contact')}}">Contact</a></li>
                            </ul>
                        </nav>
                        <div class="header-icons">
                            <ul>
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    <li><a href="cart.html">
                                        <a href="{{ route('user.user_dashboard') }}" type="button" class="tm-button btn-sm hover" style="border-radius: 7%;padding: 0 9px !important;line-height: 24px !important;height: 29px;font-size: 18px;color: white;">Account<b></b></a>
                                </a></li>

                                    @else
{{--                                     <li><a href="cart.html">--}}
{{--                                        <a href="{{ route('user_login') }}" type="button" class="tm-button btn-sm hover" style="border-radius: 7%;padding: 0 9px !important;line-height: 24px !important;height: 29px;font-size: 18px;color: white;">Login<b></b></a>--}}
{{--                                </a></li>--}}

                                    <div class="dropdown">
                                          <button class="tm-button btn-sm hover dropdown-toggle" style="border-radius: 7%;padding: 0 9px !important;line-height: 24px !important;height: 29px;font-size: 18px;color: white;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('user_login')}}">Client Login</a>
                                            <a class="dropdown-item" href="{{route('user_registration')}}">Registration</a>
                                            <a class="dropdown-item" target="null" href="http://track.safetyvts.com/">Safety Tracker Login</a>
                                            <a class="dropdown-item" target="null" href="http://tracksolid.com/">Tracksolid Login</a>
                                          </div>
                                     </div>


                                @endif
                            </ul>
                        </div>
                        <div class="header-searchbox">
                            <div class="header-searchinner">
                                <form action="#" class="header-searchform">
                                    <input type="text" placeholder="Enter search keyword..">
                                </form>
                                <button class="search-close"><i class="fas fa-times"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="header-mobilemenu clearfix">
                        <div class="tm-mobilenav"></div>
                    </div>
                </div>
            </div>
            <!--// Header Bottom Area -->
