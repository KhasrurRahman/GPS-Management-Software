<?php

namespace App\Http\Controllers\User;

use App\AllUser;
use App\Assign_technician_device;
use App\Complain;
use App\order;
use App\Payment;
use App\payment_history;
use App\Price_categaroy;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function user_dashboard()
    {
        $user_id = Auth::id();
        $user_info = AllUser::where('user_id', $user_id)->first();
        $package_order = order::where('user_id', $user_info->id)->where('payment_status','completed')->latest()->get();
        $payment = payment_history::where('user_id', $user_info->id)->orderBy('id', 'desc')->get();
        $orders = Assign_technician_device::where('user_id', $user_info->id)->orderBy('id', 'desc')->get();
        return view('frontend.user_dashboard', compact('user_info', 'payment', 'orders', 'package_order'));
    }

    public function changePassword(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            Toastr::error('Your current password does not matches with the password you provided. Please try again.');
            return redirect()->back();
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            Toastr::error('New Password cannot be same as your current password. Please choose a different password.');
            return redirect()->back();
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        Toastr::success('Password changed successfully !', 'success');
        return redirect()->back()->with("success", "Password changed successfully !");

    }

    public function payment($id)
    {
        $package = Price_categaroy::find($id);
        $user = Auth::user()->all_user;
        return view('frontend.payment', compact('user', 'package'));
    }


    public function post_complain(Request $request, $id)
    {
        $complain = new Complain();
        $complain->user_id = $id;
        $complain->description = $request->Complain_description;
        $complain->save();

        Toastr::success('Your Complain Placed Successfully', 'success');
        return redirect()->back();
    }


    public function cash_on_delevery(Request $request)
    {
        $package = Price_categaroy::find($request->package_id);

        $all_user = AllUser::where('user_id', $request->user_id)->first();
        $all_user->order_status = 1;
        $all_user->update();

        $payments = new Payment();
        $payments->name = $all_user->name;
        $payments->user_id = $all_user->user_id;
        $payments->email = $all_user->email;
        $payments->phone = $all_user->phone;
        $payments->amount = $package->monthly_charge + $package->device_price;
        $payments->status = 'Processing';
        $payments->address = $all_user->par_add;
        $payments->transaction_id = uniqid();
        $payments->currency = 'BDT';
        $payments->save();

        $order = new order();
        $order->user_id = $all_user->user_id;
        $order->order_status = 0;
        $order->payment_status = 'cash_on_delivery';
        $order->package_id = $request->package_id;
        $order->transaction_id = $payments->id;
        $order->save();

        $mobile[] = $all_user->phone;
        send_sms('Thank you for your order. We have received your order for. Our Technical team contact with you soon.
Safety GPS Tracker', $mobile);


        Toastr::success('New Order Placed Successfully', 'Success');
        return redirect()->route('user.user_dashboard');
    }


}
