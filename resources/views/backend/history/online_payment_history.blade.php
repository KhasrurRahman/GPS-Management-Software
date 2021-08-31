@extends('backend.layout.app')
@section('title','Online Payment History')
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

        .dropdown-item:focus, .dropdown-item:hover {
            background-color: #ff931e;
        }
    </style>
@endpush
@section('main_menu','HOME')
@section('active_menu','Online Payment History')
@section('link',route('admin.adminDashboard'))
@section('content')

    <div class="card">
        <div class="card-header">
            @include('backend.history.online_payment_search')
            <h3 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered yajra-datatable">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Pay Amount</th>
                    <th>Number of Months</th>
                    <th>Customer</th>
                    <th>Payment Date</th>
                </tr>
                </thead>
                <tbody>
                <tfoot>
                <tr>
                    <th style="text-align:right;">Total:</th>
                    <th style="background: red;color: white"></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('public/assets/backend/js/datatables.min.js')}}"></script>
    <script src="{{asset('public/assets/backend/js/jquery.validate.js')}}"></script>
    <script src="{{asset('public/assets/backend/plugins/select2/js/select2.js')}}"></script>
    <script src="{{asset('public/assets/backend/js/sweetalart.js')}}"></script>
    <script src="{{asset('public/js/jquery.loadscript.js')}}"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.22/api/sum().js"></script>
    @include('backend.history.online_payment_js')
@endpush
