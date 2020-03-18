<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\payment_confarmation_history;
use App\technician_device_stock;
use App\Transaction_history;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    public function device_sell_history()
    {
        $device_history = Transaction_history::latest()->get();
        $total_sell_price = Transaction_history::sum('sell_price');

        return view('backend.history.device_sell_history',compact('device_history','total_sell_price'));
    }

    public function billing_history()
    {
        $billing = payment_confarmation_history::latest()->get();
        $total_pay_amount = payment_confarmation_history::get()->sum('updated_amount');
        return view('backend.history.billing_confarmation_history',compact('billing','total_pay_amount'));
    }

    public function billing_history_search_date(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->startOfDay()->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->startOfDay()->toDateTimeString();
        if ($start_date == $end_date){
            $billing = payment_confarmation_history::whereDate('created_at', '=',$start_date)->get();
            $total_pay_amount = payment_confarmation_history::whereDate('created_at', '=',$start_date)->sum('updated_amount');
        }else{
            $billing = payment_confarmation_history::whereBetween('created_at', [$start_date, $end_date])->get();
            $total_pay_amount = payment_confarmation_history::whereBetween('created_at', [$start_date, $end_date])->sum('updated_amount');
        }



         return view('backend.history.billing_confarmation_history',compact('billing','total_pay_amount'));
    }


    public function payment_by_online()
    {
        $online_payment = Payment::latest()->get();
        return view();
    }
}
