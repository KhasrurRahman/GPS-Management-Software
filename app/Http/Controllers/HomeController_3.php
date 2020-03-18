<?php

namespace App\Http\Controllers;

use App\AllUser;
use App\order;
use App\Payment;
use App\Price_categaroy;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController_3 extends Controller
{
    public function guest_customer_order($id)
    {
        $package = Price_categaroy::find($id);
        return view('frontend.guest_user_registration',compact('package'));
    }

    public function guest_customer_order_with_package_id(Request $request,$id)
    {
            $request->validate([
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255',],
                    'password' => ['required', 'string', 'min:4', 'confirmed'],
                    'phone' => ['required','unique:users'],
                    'car_model' => 'required',
                    'par_add' => 'required',
             ]);

            $package = Price_categaroy::find($id);
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
            $user->user_type = 1;
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
            $order->package_id = $id;
            $order->transaction_id  =$payments->id;
            $order->save();


            Toastr::success('New Order created Successfully','Success');
            return redirect()->route('user_login');
    }

    public function guest_user_registration(Request $request)
    {
              $validator =   $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',],
                'password' => ['required', 'string', 'min:4', 'confirmed'],
                'phone' => ['required','unique:users'],
                'car_model' => 'required',
                'par_add' => 'required',
         ]);


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

        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->due_date = $request->due_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->total_due = $request->total_due;
        $user->next_payment_date = '-';
        $user->total_paied = $request->total_paied;
        $user->save();

        Toastr::success('You have Successfully registered ','Registration Successfull');
         return redirect()->route('user_login')->with('message','You have Successfully registered');


    }
}
