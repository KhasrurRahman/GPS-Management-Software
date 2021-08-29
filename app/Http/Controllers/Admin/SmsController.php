<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Notifications\EmailNotifier;
use App\payment_history;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class SmsController extends Controller
{

    public function send_sms_to_selected_user_view()
    {
        return view('backend.sms.send_sms_notification');
    }

    public function send_sms_to_selected_user(Request $request)
    {
        $request->validate([
            'sms' => 'required',
        ]);

        if ($request->ajax()) {
            $query = AllUser::query();
            if ($request->username !== null) {
                $query->where('name', 'like', '%' . $request->username . '%');
            }
            if ($request->email !== null) {
                $query->where('email', 'like', '%' . $request->email . '%');
            }
            if ($request->search_car_number !== null) {
                $query->where('car_number', 'like', '%' . $request->search_car_number . '%');
            }
            if ($request->search_user_type !== null) {
                $query->where('user_type', $request->search_user_type);
            }
            if ($request->search_activation_type !== null) {
                $query->where('expair_status', $request->search_activation_type);
            }
            if ($request->search_payment_status !== null) {
                $query->where('payment_status', $request->search_payment_status);
            }
            if ($request->mobile !== null) {
                $query->where('phone', $request->mobile);
            }
            if ($request->ref_id !== null) {
                $query->where('id', $request->ref_id);
            }
            $query->select('all_users.phone as mobile');
            $result = $query->get();
            foreach ($result as $res) {
                $mobile_number[] = $res['mobile'];
            }
            
            send_sms($request->sms, $mobile_number); 
        }
        
        return response()->json(['success' => 'Done']);
    }

    public function single_sms(Request $request)
    {
        $request->validate([
            'personal_sms_body' => 'required',
        ]);

//    $user = AllUser::find($id);
//    $number_of_due_months = payment_history::where('user_id',$user->id)->where('payment_status',0)->get()->count();
//            $curl = curl_init();
//            curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Your monthly bill '.$number_of_due_months * $user->monthly_bill.' tk was due. Please pay the bill before the expair your connection. bkash- 01713546487. Use ref. Id- '.$user->id.'
//            Safety GPS').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//            $resp = curl_exec($curl);
//            curl_close($curl);

        return response()->json(['success' => 'Done']);
    }


}
