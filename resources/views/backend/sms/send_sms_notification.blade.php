@extends('backend.layout.app')
@section('title','Send Manual Sms')
@push('css')
    <link href="{{asset('public/assets/backend/css/datatables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/assets/backend/plugins/select2/css/select2.css')}}" rel="stylesheet">
    <style>
        .select2-container--default .select2-selection--single {
            height: 40px !important;
        }

        .bg_color {
            background: #00d28417;
        }
        .dropdown-item:focus, .dropdown-item:hover{
            background-color: #ff931e;
        }
    </style>
@endpush
@section('main_menu','HOME')
@section('active_menu','All user')
@section('link',route('admin.adminDashboard'))
@section('content')


    <div class="card">
        <div class="card-header">
            @include('backend.all_user.search_user')
        </div>
        <div class="card-body">
            @include('backend.sms.total_user_result')
        </div>
    </div>
    
    @include('backend.sms.search_result_modal')
@endsection
@push('js')
    <script src="{{asset('public/assets/backend/js/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/js/jquery.validate.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('public/assets/backend/js/sweetalart.js')}}"></script>
    <script src="{{asset('public/js/jquery.loadscript.js')}}"></script>
    @include('backend.sms.send_sms_js')
@endpush
