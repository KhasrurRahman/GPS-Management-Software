<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta name="keywords"
          content="Safety gps tracker,gps tracker,gps tracking,gps tracker platform,vehicle tracking,vehicle tracker,car gps tracker,best gps tracker,gps tracker bangladesh,finder gps tracker,">
    <meta name="description"
          content="Safety GPS Tracker offer real time GPS Vehicle Tracking Solution. Our GPS Tracking Software enables you to track accurate location of your Fleet & Vehicles.">
    <meta property="fb:pages" content="198397634058306"/>
    <meta property="og:site_name" content="Safety GPS Tracker"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/backend/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
    <style>.nav-link{color:#000!important}.nav-header{color:#000!important}.color_black{color:#000}</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('backend.layout.header')
    @include('backend.layout.left_sidebar')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="@yield('link')">@yield('main_menu')</a></li>
                            <li class="breadcrumb-item active">@yield('active_menu')</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
    </div>
@include('backend.layout.footer')
