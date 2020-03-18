<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\custom_order;
use App\Device;
use App\order;
use App\Payment;
use App\Price_categaroy;
use App\Technician;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_user = AllUser::where('order_status',1)->latest()->get();
        $orders = order::where('order_status',0)->where('payment_status','completed')->orwhere('payment_status','cash_on_delivery')->latest()->get();
        $technician = Technician::all();
        $device = Device::all();

        return view('backend.order.order',compact('all_user','orders','technician','device'));
    }





    public function assigned_order()
    {
        $all_user = AllUser::where('order_status',1)->latest()->get();
        $orders = order::where('order_status',0)->where('payment_status','completed')->latest()->get();
        $technician = Technician::all();
        $device = Device::all();

        return view('backend.order.assigned_order',compact('all_user','orders','technician','device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $package = Price_categaroy::all();
        $user = AllUser::all();
        return  view('backend.order.add_custome_order',compact('package','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->radio == 'new_user'){

            $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255',],
                    'password' => ['required', 'string', 'min:4', 'confirmed'],
                    'phone' => ['required','unique:users'],
                    'car_model' => 'required',
                    'par_add' => 'required',
                    'package_id' => 'required',
             ]);

            $package = Price_categaroy::find($request->package_id);
            $for_user_table = new User();
            $for_user_table->name = $request->name;
            $for_user_table->email = $request->email;
            $for_user_table->phone = $request->phone;
            $for_user_table->password = Hash::make($request->password);
            $for_user_table->role = 2;
            $for_user_table->type = 'user';
            $for_user_table->save();


            $user = new AllUser();
            $user->name = $request->name;
            $user->phone = $request->phone;
            $user->user_id = $for_user_table->id;
            $user->alter_phone = $request->alter_phone;
            $user->email = $request->email;
            $user->par_add = $request->par_add;
            $user->user_type = 2;
            $user->order_status = 1;

            $user->car_number = $request->car_number;
            $user->car_model = $request->car_model;
            $user->monthly_bill = $request->monthly_charge;
            $user->next_payment_date = '-';
            $user->save();

            $payments = new Payment();
            $payments->name = $user->name;
            $payments->user_id = $user->user_id;
            $payments->email = $user->email;
            $payments->phone = $user->phone;
            $payments->amount = $package->monthly_charge + $package->device_price;
            $payments->status = 'Processing';
            $payments->address = $user->par_add;
            $payments->transaction_id = uniqid();
            $payments->currency = 'BDT';
            $payments->save();

            $order = new order();
            $order->user_id = $for_user_table->id;
            $order->order_status = 0;
            $order->payment_status = 'completed';
            $order->package_id = $request->package_id;
            $order->transaction_id  =$payments->id;
            $order->save();


            Toastr::success('New Order created Successfully','Success');
            return redirect()->route('admin.order.index');

        }

        elseif ($request->radio == 'old_user'){
            $request->validate([
                'package_id' => 'required',
                'user_id' => 'required',
            ]);

            $package = Price_categaroy::find($request->package_id);

            $all_user = AllUser::find($request->user_id);
            $all_user->monthly_bill = $all_user->monthly_bill + $request->monthly_charge;
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
            $order->payment_status = 'completed';
            $order->package_id = $request->package_id;
            $order->transaction_id  =$payments->id;
            $order->save();

            Toastr::success('New Order created Successfully','Success');
            return redirect()->route('admin.order.index');


        }

        else{
            Toastr::error('Please Select Something','Error');
             return redirect()->back();
        }










    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


}
