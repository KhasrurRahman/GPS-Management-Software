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
    public function send_personal_sms($id)
    {
        $user = AllUser::find($id);
        $sms = Input::get('sms');


//        $curl = curl_init();
//        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode($sms).'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//        $resp = curl_exec($curl);
//        curl_close($curl);


        Notification::route('mail', $user->email)
            ->notify(new EmailNotifier($user));



          Toastr::success('Sms and Email Send Successfully','Success');
          return redirect()->back();

    }

    public function send_sms_to_due_user()
    {
        $user = AllUser::where('payment_status',0)->where('order_status',0)->get();

        foreach ($user as $key=>$data){

            $number_of_due_months = payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count();

//            $curl = curl_init();
//            curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Dear '.$data->name.', Your monthly bill '.$number_of_due_months * $data->monthly_bill.' taka was due. Please pay the bill before expire your connection.bkash merchant-01690275027.Your ref. Id is- '.$data->id.'
//Safety GPS Tracker').'&msisdn=88'.$data->phone.'&csmsid=12345678'.$key, CURLOPT_USERAGENT => 'Sample cURL Request' ));
//            $resp = curl_exec($curl);
//            curl_close($curl);


        }


        Toastr::success('Sms Send Successfully','Success');
        return redirect()->back();


    }



    public function sms_first_reminder()
    {
        $user = AllUser::where('payment_status',0)->where('order_status',0)->get();

        foreach ($user as $key=>$data){

            $number_of_due_months = payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count();

//            $curl = curl_init();
//            curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Your monthly bill '.$number_of_due_months * $data->monthly_bill.' tk was due. Please pay the bill before the expair your connection. bkash Merchant- 01690275027. Use ref. Id- '.$data->id.'
//            Safety GPS Tracker').'&msisdn=88'.$data->phone.'&csmsid=12345678'.$key, CURLOPT_USERAGENT => 'Sample cURL Request' ));
//            $resp = curl_exec($curl);
//            curl_close($curl);


        }


        Toastr::success('Sms Send Successfully','Success');
        return redirect()->back();


    }





public function over_due_sms()
{
            $user = AllUser::where('payment_status',0)->where('order_status',0)->get();

        foreach ($user as $key=>$data){

            if (payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count() > 2){
                $curl = curl_init();
            curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Your safety GPS monthly bill is overdue. Total due: ( '.$data->monthly_bill * payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count() .' ) for ('.payment_history::where('user_id',$data->id)->where('payment_status',0)->get()->count().')Please pay your bill before expiring your connection.
Safety GPS Tracker').'&msisdn=88'.$data->phone.'&csmsid=12345678'.$key, CURLOPT_USERAGENT => 'Sample cURL Request' ));
            $resp = curl_exec($curl);
            curl_close($curl);
            }



        }


        Toastr::success('Sms Send Successfully','Success');
        return redirect()->back();
}




public function single_sms($id)
{
    $user = AllUser::find($id);
    $number_of_due_months = payment_history::where('user_id',$user->id)->where('payment_status',0)->get()->count();
            $curl = curl_init();
            curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Your monthly bill '.$number_of_due_months * $user->monthly_bill.' tk was due. Please pay the bill before the expair your connection. bkash Merchant- 01690275027. Use ref. Id- '.$user->id.'
            Safety GPS').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
            $resp = curl_exec($curl);
            curl_close($curl);

            Toastr::success('SMS Send Successfully','Success');
            return redirect()->back();
}



}
