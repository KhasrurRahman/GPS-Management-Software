<!-- Footer Area -->
        <footer class="footer" data-bgimage="" data-black-overlay="9">

            <!-- Footer Widgets -->
            <div class="footer-toparea tm-padding-section">
                <div class="container">
                    <div class="row widgets footer-widgets">
                            <div class="col-lg-4 col-md-6 col-12">
                                <!-- Single Widget (Widget Info) -->
                                <div class="single-widget widget-info">
                                    <a href="index.html" class="widget-info-logo">
                                        <img src="{{asset("public/assets/backend/img/gps-tracker.png")}}" alt="logo" style="height: 45px">

                                    </a>
                                    <p>Safety GPS Tracker offer real time GPS Vehicle Tracking Solution. Our GPS Tracking Software enables you to track accurate location of your Fleet & Vehicles.</p>
                                </div>
                                <!--// Single Widget (Widget Info) -->
                            </div>

                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget (Widget Contact) -->
                            <div class="single-widget widget-contact">
                                <h5 class="widget-title" style="font-weight: bold">Our Office Address</h5>

                                @php($contact = \App\Contact_info::all())

                                @if(count($contact) > 0)
                                    @php($contact_data = \App\Contact_info::all()->first())

                                <ul>
                                    <li>
                                        <i class="fas fa-map-marker-alt"></i>
                                        <p>{{$contact_data->address}}</p>
                                    </li>
                                    <li>
                                        <i class="fas fa-envelope"></i>
                                        <p>Email: <a href="#">{{$contact_data->email}}</a></p>
                                    </li>
                                    <li>
                                        <i class="fas fa-phone"></i>
                                        <p>Sales: <a href="tel://{{$contact_data->header_phone_1}}">{{$contact_data->header_phone_1}}</a></p>

                                    </li>

                                    <li>
                                        <i class="fas fa-phone"></i>

                                        <p>Support: <a href="tel://{{$contact_data->header_phone_2}}">{{$contact_data->header_phone_2}}</a></p>
                                    </li>

                                    <li>
                                        <i class="fas fa-phone"></i>
                                        <p>Billing: <a href="tel://{{$contact_data->header_phone_3}}">{{$contact_data->header_phone_3}}</a></p>
                                    </li>
                                </ul>
                                 @endif

                            </div>
                            <!--// Single Widget (Widget Contact) -->
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                            <!-- Single Widget (Widget Newsletter) -->
                            <div class="single-widget widget-newsletter">
                                <h5 class="widget-title text-bold" style="font-weight: bold">Like Us</h5>
{{--                                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fsafetygpstracker%2F&amp;tabs&amp;width=280&amp;height=181&amp;small_header=false&amp;adapt_container_width=true&amp;hide_cover=false&amp;show_facepile=true&amp;appId" width="280" height="181" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>--}}

                            </div>
                            <!--// Single Widget (Widget Newsletter) -->
                        </div>


                    </div>
                </div>
            </div>
            <!--// Footer Widgets -->

            <!-- Footer -->
            <div class="footer-bottomarea bg-white p-0">
                <div class="container">
                    <div class="col-lg-12 col-md-12 col-12">
                            <!-- Single Widget (Widget Newsletter) -->
                            <div class="single-widget widget-newsletter m-0">
                                <img src="{{asset('public/assets/frontend/images/bg/ssl.png')}}" alt="logo">

                            </div>
                            <!--// Single Widget (Widget Newsletter) -->
                    </div>
                </div>
            </div>
            <!--// Footer -->

        </footer>
        <!--// Footer Area -->
            <!-- Js Files -->
    <script src="{{asset('public/assets/frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/frontend/js/popper.min.js')}}"></script>
    <script src="{{asset('public/assets/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/assets/frontend/js/plugins.js')}}"></script>
    <script src="{{asset('public/assets/frontend/js/main.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}
<script>
    @if($errors->any())
        @foreach($errors->all() as $error)
              toastr.error('{{ $error }}','Error',{
                  closeButton:true,
                  progressBar:true,
               });
        @endforeach
    @endif
</script>
    <!--// Js Files -->
</html>

