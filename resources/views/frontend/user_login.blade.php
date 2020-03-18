@extends('frontend.layout.app')
@section('title','Login')
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
    </style>
@endpush

@section('content')

@if(session()->has('message'))
    <div class="alert alert-success text-center">
        {{ session()->get('message') }}
    </div>
@endif

    <div class="row tm-padding-section">
                <div class="col-md-12">
                    <div class="row">
                        <div class="container register-form">
                            <div class="form">
                                <div class="note">
                                    <p>Login</p>
                                    <small>Please fill in this form to Login</small>
                                </div>
                                <form id="reg_form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                     <div class="form-content">
                                        <div class="row">
                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group row">
                                                    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone number</label>

                                                    <div class="col-md-6">
                                                        <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                                        @error('phone')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group row">
                                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="col-sm-12 col-lg-12">
                                                <div class="form-group row">
                                                    <div class="col-md-6 offset-md-4">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Remember Me') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                        <button type="submit" name="save" class="btn btn-block btn-success btnSubmit" data-bs-hover-animate="pulse" style="padding: 6px;font-weight: bold">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 desktop_view sidebar">

            </div>
          </div>




@endsection
@push('js')
@endpush
