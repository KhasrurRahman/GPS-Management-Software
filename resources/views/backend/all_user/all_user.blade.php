@extends('backend.layout.app')
@section('title','All User')
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
            <h3 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h3>
            @if(\Request::is('admin/due_user'))
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle float-right" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Send SMS
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{route('admin.send_sms_to_due_user')}}">Reminder SMS</a>
                        <a class="dropdown-item" href="{{route('admin.send_sms_to_due_user')}}">First SMS</a>
                        <a class="dropdown-item" href="{{route('admin.over_due_sms')}}">OverDue SMS</a>
                    </div>
                </div>
            @else
                <a href="{{route('admin.all_user.create')}}" type="button" class="btn-sm btn-success float-right">Add User</a>
            @endif
        </div>
        <div class="card-body">
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Ref Id</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Car Number</th>
                    <th>Monthly Bill</th>
                    <th>Assign Technician</th>
                    <th>Note</th>
                    <th>Activation Status</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr> 
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    @include('backend.all_user.assigen_techician_modal')
    @include('backend.all_user.bill_schedule_modal')
    @include('backend.all_user.sens_sms_modal')
@endsection
@push('js')
    <script src="{{asset('public/assets/backend/js/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/js/jquery.validate.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('public/assets/backend/js/sweetalart.js')}}"></script>
    <script src="{{asset('public/js/jquery.loadscript.js')}}"></script>
    @include('backend.all_user.all_user_js')
@endpush
