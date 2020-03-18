<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Assign_technician_device;
use App\Billing_shedule;
use App\Device;
use App\Exports\UsersExport;
use App\monthly_bill_update_status;
use App\payment_confarmation_history;
use App\payment_history;
use App\Technician;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Webpatser\Uuid\Uuid;

class All_usercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technician = Technician::all();
        $user = AllUser::where('order_status',0)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }

    public function corporate_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('user_type',2)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }

    public function individual_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('user_type',1)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }
    public function expire_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('expair_status',1)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }



    public function paid_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('payment_status',1)->where('expair_status',0)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }

    public function due_user()
    {
        $now = Carbon::createFromFormat('Y-m-d',Carbon::now()->toDateString())->firstOfMonth();
        $total_due_user = AllUser::where('next_payment_date','<',$now)->get();
        foreach ($total_due_user as $data)
        {
            $user = AllUser::find($data->id);
            $user->next_payment_date = $now->firstOfMonth();
            $user->update();


            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $now;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $user->monthly_bill;
            $payment_history->payment_status = 0;
            $payment_history->nest_payment_date = $user->next_payment_date;
            $payment_history->save();


        }


        $technician = Technician::all();
        $user = AllUser::where('payment_status',0)->where('expair_status',0)->latest()->get();
        $device = Device::all();
        return  view('backend.all_user.all_user',compact('user','technician','device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('backend.all_user.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required','unique:users'],
                'user_type' => 'required',
                'car_number' => 'required',
//                'car_model' => 'required',
                'installation_date' => 'required',
                'monthly_bill' => 'required',
                'due_date' => 'required',
//                'device_price' => 'required',
         ]);

        $due_date =  $request->due_date;

        $from = Carbon::createFromFormat('Y-m-d', $due_date)->firstOfMonth();

        $to = Carbon::createFromFormat('Y-m-d',Carbon::now()->toDateString())->firstOfMonth();




        $diff_in_months = $to->diffInMonths($from);
//        dd($to < $from,$to > $from,$to  == $from);



        $for_user_table = new User();
        $for_user_table->name = $request->name;
        $for_user_table->email = $request->email;
        $for_user_table->phone = $request->phone;
        $for_user_table->role = 2;
        $for_user_table->password = Hash::make('123456');
        $for_user_table->save();


        $user = new AllUser();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->user_id = $for_user_table->id;
        $user->alter_phone = $request->alter_phone;
        $user->email = $request->email;
        $user->par_add = $request->par_add;
        $user->user_type = $request->user_type;

        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->due_date = $request->due_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->total_due = $request->total_due;
        $user->total_paied = $request->total_paied;
        $user->device_price = $request->device_price;
        $user->save();


        if ($to < $from){
//            if ($request->payment_this_date == null){
//                Toastr::error('Please Input the advanced amount:)','Advanced payment Field Required');
//                return redirect()->back();
//            }

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $from;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;
            $payment_history->payment_status = 0;
            $payment_history->nest_payment_date = $from->firstOfMonth();
            $payment_history->save();

            $user->next_payment_date = $from->addMonths()->firstOfMonth();
            $user->payment_status = 1;
            $user->update();
        }elseif($to == $from)
        {
            $after_reduce_one_months = $from->subMonth();
            for ($i=0; $i<=$diff_in_months;$i++){
            $trialExpires = $after_reduce_one_months->addMonths(1);

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $trialExpires;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;

            $payment_history->save();
            }
               $user->next_payment_date = $trialExpires->addMonths()->firstOfMonth();
               $user->payment_status = 0;
               $user->update();
        }

        elseif($to > $from){
            $after_reduce_one_months = $from->subMonth();
            for ($i=0; $i<=$diff_in_months+1;$i++){
            $trialExpires = $after_reduce_one_months->addMonths(1);

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $trialExpires;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;

            $payment_history->save();
            }
               $user->next_payment_date = $trialExpires->addMonths()->firstOfMonth();
               $user->payment_status = 0;
               $user->update();

        }


        Toastr::success('save Successfully :)','Success');
        return redirect()->route('admin.all_user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = AllUser::find($id);
        $payment = payment_history::where('user_id',$user->id)->orderBy('id','desc')->get();
        $payment_confermation = payment_confarmation_history::where('user_id',$id)->latest()->get();
        $monthly_bill_update_history = monthly_bill_update_status::where('user_id',$id)->latest()->get();


        return view('backend.all_user.user_profile',compact('user','payment','payment_confermation','monthly_bill_update_history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = AllUser::findOrFail($id);
        return view('backend.all_user.edit_user',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

  $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'car_number' => 'required',
//                'car_model' => 'required',
                'installation_date' => 'required',
                'monthly_bill' => 'required',
//                'device_price' => 'required',
         ]);
        $user = AllUser::findOrFail($id);

        $for_user_table = User::find($user->user_id);
        $for_user_table->name = $request->name;
        $for_user_table->email = $request->email;
        $for_user_table->password = Hash::make('123456');
        $for_user_table->update();


        $user->name = $request->name;
        $user->alter_phone = $request->alter_phone;
        $user->email = $request->email;
        $user->par_add = $request->par_add;
        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->device_price = $request->device_price;
        $user->update();

        Toastr::success('Update Successfully :)','Success');
        return redirect()->route('admin.all_user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = AllUser::findOrFail($id)->delete();
        Toastr::success('Deleted Successfully :)','Success');
        return redirect()->back();
    }

    public function user_delete($id)
    {
        $user = AllUser::findOrFail($id);
        $user->expair_status = 1;
        $user->update();

        $payment_history = payment_history::where('user_id',$user->id)->where('payment_status',0)->get()->count();

//        $curl = curl_init();
//        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Your Connection has been expired. Please pay the due bill to active your connection. Your total due bill is '.$payment_history * $user->monthly_bill.'tk for '.$payment_history.' months. If you need any further information please contact our care number ( 01713546487)').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//        $resp = curl_exec($curl);
//        curl_close($curl);

        Toastr::success('Expired Successfully :)','Success');
        return redirect()->back();
    }

    public function active_user($id)
    {
        $user = AllUser::findOrFail($id);
        $user->expair_status = 0;
        $user->update();

//        $curl = curl_init();
//        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Thank You for Your Payment,Your Connection is Now Active').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//        $resp = curl_exec($curl);
//        curl_close($curl);

        Toastr::success('Activated Successfully :)','Success');
        return redirect()->back();
    }

    public function monthly_bill_update(Request $request,$id)
    {

        $request->validate([
                'monthly_bill' => 'required',
         ]);

        $user = AllUser::find($id);

        if ($user->monthly_bill == $request->monthly_bill){
            Toastr::Error('You Write The Same Previous Amount','Success');
            return redirect()->back();
        }else{
            $user->monthly_bill = $request->monthly_bill;
            $user->update();

            $monthly_bill_update_status = new monthly_bill_update_status();
            $monthly_bill_update_status->user_id = $id;
            $monthly_bill_update_status->admin_id = Auth::id();
            $monthly_bill_update_status->monthly_bill = $request->monthly_bill;
            $monthly_bill_update_status->save();

        Toastr::success('Monthly Bill Updated Successfully :)','Success');
        return redirect()->back();
        }

    }


    public function full_order_history($id)
    {
        $user = AllUser::findOrFail($id);
        $orders = Assign_technician_device::where('user_id',$user->id)->latest()->get();
        $payment_confermation = payment_confarmation_history::where('user_id',$id)->latest()->get();
        $monthly_bill_update_history = monthly_bill_update_status::where('user_id',$id)->latest()->get();
        $payment = payment_history::where('user_id',$user->id)->orderBy('id','desc')->get();


        return view('backend.all_user.order_history',compact('user','orders','payment_confermation','monthly_bill_update_history','payment'));
    }



    public function bill_schedule(Request $request)
    {
        $bill_schedule = new Billing_shedule();
        $bill_schedule->note = $request->note;
        $bill_schedule->date = $request->date;
        $bill_schedule->user_id = $request->user_id;
        $bill_schedule->save();

        Toastr::success('Billing Schedule Save Successfully','Success');
        return redirect()->back();
    }


    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }


public function update_user_after_mistake(Request $request)
    {
        $all_user = AllUser::find($request->user_id);
        $user = User::find($all_user->user_id)->delete();
        $all_user->delete();


        $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required','unique:users'],
                'user_type' => 'required',
                'car_number' => 'required',
//                'car_model' => 'required',
                'installation_date' => 'required',
                'monthly_bill' => 'required',
                'due_date' => 'required',
//                'device_price' => 'required',
         ]);

        $due_date =  $request->due_date;

        $from = Carbon::createFromFormat('Y-m-d', $due_date)->firstOfMonth();

        $to = Carbon::createFromFormat('Y-m-d',Carbon::now()->toDateString())->firstOfMonth();




        $diff_in_months = $to->diffInMonths($from);
//        dd($to < $from,$to > $from,$to  == $from);



        $for_user_table = new User();
        $for_user_table->name = $request->name;
        $for_user_table->email = $request->email;
        $for_user_table->phone = $request->phone;
        $for_user_table->role = 2;
        $for_user_table->password = Hash::make('123456');
        $for_user_table->save();


        $user = new AllUser();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->user_id = $for_user_table->id;
        $user->alter_phone = $request->alter_phone;
        $user->email = $request->email;
        $user->par_add = $request->par_add;
        $user->user_type = $request->user_type;

        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->due_date = $request->due_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->total_due = $request->total_due;
        $user->total_paied = $request->total_paied;
        $user->device_price = $request->device_price;
        $user->save();


        if ($to < $from){
//            if ($request->payment_this_date == null){
//                Toastr::error('Please Input the advanced amount:)','Advanced payment Field Required');
//                return redirect()->back();
//            }

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $from;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;
            $payment_history->payment_status = 0;
            $payment_history->nest_payment_date = $from->firstOfMonth();
            $payment_history->save();

            $user->next_payment_date = $from->addMonths()->firstOfMonth();
            $user->payment_status = 1;
            $user->update();
        }elseif($to == $from)
        {
            $after_reduce_one_months = $from->subMonth();
            for ($i=0; $i<=$diff_in_months;$i++){
            $trialExpires = $after_reduce_one_months->addMonths(1);

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $trialExpires;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;

            $payment_history->save();
            }
               $user->next_payment_date = $trialExpires->addMonths()->firstOfMonth();
               $user->payment_status = 0;
               $user->update();
        }

        elseif($to > $from){
            $after_reduce_one_months = $from->subMonth();
            for ($i=0; $i<=$diff_in_months+1;$i++){
            $trialExpires = $after_reduce_one_months->addMonths(1);

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $trialExpires;
            $payment_history->payment_this_date = $request->payment_this_date;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $request->monthly_bill;

            $payment_history->save();
            }
               $user->next_payment_date = $trialExpires->addMonths()->firstOfMonth();
               $user->payment_status = 0;
               $user->update();

        }


        Toastr::success('Please Dont Mistake Again','Success');
        return redirect()->route('admin.all_user.index');
    }

    public function user_note_save(Request $request,$id)
    {
        $all_user = AllUser::find($id);
        $all_user->note =$request->note;
        $all_user->update();


        return response()->json([
            'message' => $all_user,
        ]);
    }


}
