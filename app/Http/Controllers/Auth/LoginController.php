<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/admin/adminDashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check() && Auth::user()->role==0){
            $this->redirectTo=route('admin.adminDashboard');
        }elseif(Auth::check() && Auth::user()->role==1){
            $this->redirectTo=route('author.authorDashboard');
        }elseif(Auth::check() && Auth::user()->role==2){
            $this->redirectTo=route('user.user_dashboard');
        }
        $this->middleware('guest')->except('logout');
    }


    public function username()
{
    return 'phone';
}


}
