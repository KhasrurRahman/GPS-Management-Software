<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Billing_shedule;
use App\Device;
use App\Technician;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillScheduleController extends Controller
{

   public function calendar()
    {
            $formate_date =  'null';
            $technician = Technician::all();
            $device = Device::all();
            $schedule = Billing_shedule::latest()->get();
        return view('backend.bill_schedule.bill_schedule',compact('schedule','formate_date','technician','device'));
    }


    public function calendar_search(Request $request)
    {
            $formate_date =  date("yy-m-d", strtotime($request->date));

            $technician = Technician::all();
            $device = Device::all();
            $schedule = Billing_shedule::whereDate('date', '=', $formate_date)->get();

        return view('backend.bill_schedule.bill_schedule',compact('schedule','formate_date','technician','device'));

    }


    public function all_bill_schedule()
    {
            $technician = Technician::all();
            $device = Device::all();

            $schedule = Billing_shedule::latest()->get();
            return view('backend.bill_schedule.all_schedule',compact('schedule','technician','device'));
    }

    public function rebill_schedule(Request $request){
       $schedule = Billing_shedule::find($request->schedule_id);
       $schedule->note = $request->note;
       $schedule->date = $request->date;
       $schedule->update();

       Toastr::success('Reschedule Successful','Success');
        return redirect()->back();
    }
}
