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
            $query = AllUser::where('status', null);
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

            if ($request->schedule_status !== null) {
                $query->whereHas('bill_schedule', function ($query2) use ($request) {
                    $query2->where('user_id', '!=', 'asdasd');
                });
            }

            if ($request->bill_schedule_date !== null) {
                $query->whereHas('bill_schedule', function ($query2) use ($request) {
                    $query2->where('date', $request->bill_schedule_date);
                });
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
        
        $mobile_number [] = AllUser::find($request->user_id)->phone;

        send_sms($request->personal_sms_body,$mobile_number);

        return response()->json(['success' => 'Done']);
    }


}
