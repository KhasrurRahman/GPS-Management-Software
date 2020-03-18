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

class UserController extends Controller
{
    public function user_dashboard()
{
            $package_order = order::where('user_id',Auth::id())->latest()->get();
            $user_id = Auth::id();
            $user_info = AllUser::where('user_id',$user_id)->first();
            $payment = payment_history::where('user_id',$user_info->id)->orderBy('id','desc')->get();
            $orders = Assign_technician_device::where('user_id',$user_info->id)->orderBy('id','desc')->get();
            return view('frontend.user_dashboard',compact('user_info','payment','orders','package_order'));


    }

    public function payment($id)
    {
        $package = Price_categaroy::find($id);
        $user = Auth::user();
        return view('frontend.payment',compact('user','package'));
    }


    public function post_complain(Request $request,$id)
    {
        $complain = new Complain();
        $complain->user_id = $id;
        $complain->description = $request->Complain_description;
        $complain->save();

        Toastr::success('Your Complain Placed Successfully','success');
        return redirect()->back();
    }


    public function cash_on_delevery(Request $request)
    {
        $package = Price_categaroy::find($request->package_id);

            $all_user = AllUser::where('user_id',$request->user_id)->first();
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
            $order->transaction_id  =$payments->id;
            $order->save();


            $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('
Thank you for your order. We have received your order for. Our Technical team contact with you soon.
Safety GPS Tracker').'&msisdn=88'.$all_user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);

            Toastr::success('New Order Placed Successfully','Success');
            return redirect()->route('user.user_dashboard');
    }




}
