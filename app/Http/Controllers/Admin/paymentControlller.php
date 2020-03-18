<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\payment_confarmation_history;
use App\payment_history;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class paymentControlller extends Controller
{
    public function update_payment(Request $request,$id)
    {

        $request->validate([
                'number_of_months' => 'required',
                'payment_this_date' => 'required',
         ]);

        $user = AllUser::find($id);
        $number_of_months = $request->number_of_months;
        $amount = $request->payment_this_date;
        $last_payment_date = $user->next_payment_date;


        if ($amount <  (($user->monthly_bill)*$number_of_months)){
            Toastr::error('Please input A valid Amount '.($user->monthly_bill)*$number_of_months.' for '.$number_of_months.' months','Invaild Input');
            return redirect()->back();
        }
        elseif($amount >=  (($user->monthly_bill)*$number_of_months)){

            //update previous due history
            $previous_due_history = payment_history::where('user_id',$id)->where('payment_status',0)->get();
            $number_of_due_month = $previous_due_history->count();


            if ($number_of_due_month > $number_of_months){

                $previous_due_history_limit = payment_history::where('user_id',$id)->where('payment_status',0)->take($number_of_months)->get();
                foreach ($previous_due_history_limit as $data)
                {
                    $data->payment_this_date = $user->monthly_bill;
                    $data->total_due = '0';
                    $data->payment_status = 1;
                    $data->update();
                }

                $last_payment_history_id = payment_history::where('user_id',$id)->orderBy('id','desc')->first();
                $admin_payment_confarmation_history = new payment_confarmation_history();
                $admin_payment_confarmation_history->user_id = $id;
                $admin_payment_confarmation_history->admin_id = Auth::user()->id;
                $admin_payment_confarmation_history->payment_history_id  = $last_payment_history_id->id;
                $admin_payment_confarmation_history->updated_amount  = $amount;
                $admin_payment_confarmation_history->payment_for_month  = $number_of_months;
                $admin_payment_confarmation_history->save();

               Toastr::success('Payment status Successfully Updated','success');
               return redirect()->back();


//        $curl = curl_init();
//        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Thank for Your payment '.(($user->monthly_bill)*$number_of_months).'Tk for '.$number_of_months.' month.
//Safety GPS Tracker').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//        $resp = curl_exec($curl);
//        curl_close($curl);


            }
            elseif ($number_of_due_month == $number_of_months)
            {
                $start_date  = Carbon::createFromFormat('Y-m-d H:i:s', $last_payment_date)->firstOfMonth();
                $previous_due_history_ = payment_history::where('user_id',$id)->where('payment_status',0)->get();
                foreach ($previous_due_history_ as $data)
                {
                    $data->payment_this_date = $user->monthly_bill;
                    $data->payment_status = 1;
                    $data->total_due = '0';
                    $data->update();
                }
                $user->payment_status = 1;
                $user->update();

                $last_payment_history_id = payment_history::where('user_id',$id)->orderBy('id','desc')->first();;
                $admin_payment_confarmation_history = new payment_confarmation_history();
                $admin_payment_confarmation_history->user_id = $id;
                $admin_payment_confarmation_history->admin_id = Auth::user()->id;
                $admin_payment_confarmation_history->payment_history_id  = $last_payment_history_id->id;
                $admin_payment_confarmation_history->updated_amount  = $amount;
                $admin_payment_confarmation_history->payment_for_month  = $number_of_months;
                $admin_payment_confarmation_history->save();


//         $curl = curl_init();
//        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Thank for Your payment '.(($user->monthly_bill)*$number_of_months).'Tk for '.$number_of_months.' months.
//Safety GPS Tracker').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//        $resp = curl_exec($curl);
//        curl_close($curl);

               Toastr::success('Payment status Successfully Updated','success');
               return redirect()->back();
            }
            elseif ($number_of_due_month<$number_of_months)
            {
                $extra_payment_month = $number_of_months - $number_of_due_month;
                if ($number_of_due_month == 0){
                    $last_paid_month = payment_history::where('user_id',$user->id)->where('payment_status',1)->orderBy('id','desc')->first();
                    $start_date  = Carbon::createFromFormat('Y-m-d H:i:s', $last_paid_month->month_name)->firstOfMonth();

                    for($i=1;$i<=$extra_payment_month;$i++)
                    {
                        $payment_history = new payment_history();
                        $payment_history->user_id = $id;
                        $payment_history->month_name = $start_date->addMonth();
                        $payment_history->payment_this_date = $user->monthly_bill;
                        $payment_history->total_paid_until_this_date = '';
                        $payment_history->total_due =  0;
                        $payment_history->payment_status =  1;
                        $payment_history->save();
                    }
                    $next_payment_date = $start_date->addMonth();
                    $user->next_payment_date = $next_payment_date;
                    $user->payment_status = 1;
                    $user->update();

                    $last_payment_history_id = payment_history::where('user_id',$id)->orderBy('id','desc')->first();;
                    $admin_payment_confarmation_history = new payment_confarmation_history();
                    $admin_payment_confarmation_history->user_id = $id;
                    $admin_payment_confarmation_history->admin_id = Auth::user()->id;
                    $admin_payment_confarmation_history->payment_history_id  = $last_payment_history_id->id;
                    $admin_payment_confarmation_history->updated_amount  = $amount;
                    $admin_payment_confarmation_history->payment_for_month  = $number_of_months;
                    $admin_payment_confarmation_history->save();

//                    $curl = curl_init();
//        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Thank for Your payment '.(($user->monthly_bill)*$number_of_months).'Tk for '.$number_of_months.' months.
//Safety GPS Tracker').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//        $resp = curl_exec($curl);
//        curl_close($curl);

                    Toastr::success('Payment status Successfully Updated','success');
                    return redirect()->back();

                }elseif ($number_of_due_month >= 1)
                {
                    $due_from = payment_history::where('user_id',$user->id)->where('payment_status',0)->orderBy('id','desc')->first();
                    $previous_due_history = payment_history::where('user_id',$id)->where('payment_status',0)->get();
                    foreach ($previous_due_history as $data)
                    {
                        $data->payment_this_date = $user->monthly_bill;
                        $data->payment_status = 1;
                        $data->total_due = '0';
                        $data->update();
                    }

                    $start_date  = Carbon::createFromFormat('Y-m-d H:i:s', $due_from->month_name)->firstOfMonth();
                    for($i=1;$i<=$extra_payment_month;$i++)
                    {
                        $payment_history = new payment_history();
                        $payment_history->user_id = $id;
                        $payment_history->month_name = $start_date->addMonth();
                        $payment_history->payment_this_date = $user->monthly_bill;
                        $payment_history->total_paid_until_this_date = '';
                        $payment_history->total_due =  0;
                        $payment_history->payment_status =  1;
                        $payment_history->save();
                    }

                    $next_payment_date = $start_date->addMonth();
                    $user->next_payment_date = $next_payment_date;
                    $user->payment_status = 1;
                    $user->update();

                    $last_payment_history_id = payment_history::where('user_id',$id)->orderBy('id','desc')->first();;
                    $admin_payment_confarmation_history = new payment_confarmation_history();
                    $admin_payment_confarmation_history->user_id = $id;
                    $admin_payment_confarmation_history->admin_id = Auth::user()->id;
                    $admin_payment_confarmation_history->payment_history_id  = $last_payment_history_id->id;
                    $admin_payment_confarmation_history->updated_amount  = $amount;
                    $admin_payment_confarmation_history->payment_for_month  = $number_of_months;
                    $admin_payment_confarmation_history->save();


//                    $curl = curl_init();
//        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Thank for Your payment '.(($user->monthly_bill)*$number_of_months).'Tk for '.$number_of_months.' months.
//Safety GPS Tracker').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//        $resp = curl_exec($curl);
//        curl_close($curl);

                    Toastr::success('Payment status Successfully Updated','success');
                    return redirect()->back();
                }

            }


        }
    }




    public function delete_payment_history($id)
    {
        $payment = payment_history::find($id);

        $database_date = Carbon::createFromFormat('Y-m-d H:i:s', $payment->month_name)->firstOfMonth();

        $corrent_date = Carbon::createFromFormat('Y-m-d',Carbon::now()->toDateString())->firstOfMonth();

        if($database_date > $corrent_date)
        {
            $all_user = AllUser::find($payment->user_id);
            $all_user->next_payment_date = $payment->month_name;
            $all_user->update();
        }elseif($database_date == $corrent_date)
        {
            $all_user = AllUser::find($payment->user_id);
            $all_user->next_payment_date = $payment->month_name;
            $all_user->update();
        }

        $payment->delete();


        Toastr::success('Payment History Deleted Successful','success');
        return redirect()->back();
    }





}
