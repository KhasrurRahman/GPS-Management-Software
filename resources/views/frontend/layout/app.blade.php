<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - {{ config('app.name', 'GPS Tracker') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" href="{{asset("public/assets/frontend/images/unnamed.png")}}">
    <link rel="shortcut icon" href="{{asset("public/assets/frontend/images/unnamed.png")}}">

    <!-- Google Font (font-family: 'Open Sans', sans-serif;) -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700" rel="stylesheet">
    <!-- Google Font (font-family: 'Roboto', sans-serif;) -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/plugins.css")}}">
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/style.css")}}">

    <!-- Please Remove this line after choosing color file -->
    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/tm-customizer.css")}}">
    <link rel="stylesheet" href="#" data-color-css>

    <link rel="stylesheet" href="{{asset("public/assets/frontend/css/custom.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')

    <STYLE>
        .service_border_radious{
            border: 1px solid #1cbac9;
            background: #1cbac966;
            border-radius: 5%;
        }
        .service_image{
            height: 164px;
        }
        .hover:hover{
            color: white !important;
        }
        @media only screen and (max-width: 600px) {
          .header-topsocial {
            display: none;
          }

           .header-topinfo ul li a{
            font-size: 10px;
          }
        }

        @media only screen and (max-width: 450px) {
          .header-topsocial {
            display: none;
          }

           .header-topinfo ul li a{
            font-size: 7px;
          }
        }

    </STYLE>
</head>

<body>
    <div id="wrapper" class="wrapper">
        <!-- Header Area -->
        <div class="header">

            <!-- Header Top Area -->
            <div class="header-toparea">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="header-topinfo">
                                @php($contact = \App\Contact_info::all())

                                @if(count($contact) > 0)
                                    @php($contact_data = \App\Contact_info::all()->first())
                                <ul>
                                    <li><a href="tel://{{$contact_data->header_phone_1}}" style="color:#6c63ff;font-weight: bold;"><i class="fa fa-phone"></i><span>Sales:</span> {{$contact_data->header_phone_1}}</a></li>
                                    <li><a href="tel://{{$contact_data->header_phone_2}}" style="color:#f15922;font-weight: bold;"><i class="fa fa-phone"></i><span>Billing:</span> {{$contact_data->header_phone_2}}</a></li>
                                    <li><a href="tel://{{$contact_data->header_phone_3}}" style="color:green;font-weight: bold;"><i class="fa fa-phone"></i><span>Support:</span> {{$contact_data->header_phone_3}}</a></li>
                                </ul>
                                 @endif

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--// Header Top Area -->
@include('frontend.layout.main_menu')
        </div>
        <!--// Header Area -->
<!-- Main Content -->
        <main class="main-content" style="background: {{Request::is('user/user_dashboard')?'#136b63fc': ''}}{{Request::is('online_payment*')?'#136b63fc': ''}}" >
            @yield('content')
        </main>
        <!--// Main Content -->
@include('frontend.layout.footer')
@stack('js')
    </div>
</body>
