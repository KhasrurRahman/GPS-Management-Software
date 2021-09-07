<?php

namespace App\Http\Controllers;

use App\AllUser;
use App\order;
use App\payment_history;
use App\Price_categaroy;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SslCommerzPaymentController extends Controller
{
    public function guest_user_register_order(Request $request, $id)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'phone' => ['required', 'unique:users'],
            'car_model' => 'required',
            'par_add' => 'required',
        ]);

        $package = Price_categaroy::find($id);
        $total_amount = $package->device_price + $package->monthly_charge;

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

        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->due_date = $request->due_date;
        $user->monthly_bill = $package->monthly_charge;
        $user->total_due = 0;
        $user->next_payment_date = '-';
        $user->total_paied = $total_amount;
        $user->save();


        $post_data = array();
        $post_data['total_amount'] = $total_amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->par_add;
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $request->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "order_payment";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('payments')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'user_id' => $user->id,
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);
        
        $order = new order();
        $order->user_id = $user->id;
        $order->order_status = 0;
        $order->payment_status = 'Pending';
        $order->package_id = $id;
        $order->transaction_id = $post_data['tran_id'];
        $order->save();
        
        
        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function bill_payment_pay(Request $request, $id)
    {
        $user_id = AllUser::find($id);

        if ($user_id->order_status == 1) {
            Toastr::error('You have still Running a order,please wait for the confirmation', 'success');
            return redirect()->back();
        }

        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user_id->name;
        $post_data['cus_email'] = $user_id->email;
        $post_data['cus_add1'] = isset($user_id->par_add) ? $user_id->par_add : 'dhaka';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = $user_id->phone;
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "Computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = isset($request->order_payment) ? 'order_payment' : 'monthly_payment';
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        $update_product = DB::table('payments')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'user_id' => $user_id->user_id,
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'number_of_months' => isset($request->order_payment) ? 1 : $request->number_of_months,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ]);

        if ($request->order_payment != null) {
            $order = new order();
            $order->user_id = $id;
            $order->order_status = 0;
            $order->payment_status = 'Pending';
            $order->package_id = $request->package_id;
            $order->transaction_id = $post_data['tran_id'];
            $order->save();
        }

        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');
        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');
        $order_type = $request->value_a;

        $sslc = new SslCommerzNotification();

        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'id', 'number_of_months', 'user_id')->first();

        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {
                DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                if ($order_type == 'order_payment') {
                    $user = AllUser::where('user_id', $order_detials->user_id)->first();
                    $user->order_status = 1;
                    $user->update();

                    $order = order::where('transaction_id', $tran_id)->first();
                    $order->payment_status = 'completed';
                    $order->update();

                    Toastr::success('Payment status Successfully Updated', 'success');
                    return redirect()->route('user.user_dashboard');
                } else {
                    $this->update_monthly_status($order_detials, $amount);
                    Toastr::success('Payment status Successfully Updated', 'success');
                    return redirect()->route('online_payment', $order_detials->user_id);
                }
            } else {
                DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                $order = order::where('transaction_id', $tran_id)->first();
                $order->payment_status = 'Failed';
                $order->update();

                Toastr::Error('validation Fail', 'Success');
                return redirect()->route('online_payment', $order_detials->user_id);
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            $user_id = Auth::id();
            if ($order_type == 'order_payment') {
                $user = AllUser::where('user_id', $order_detials->user_id)->first();
                $user->order_status = 1;
                $user->update();

                $order = order::where('transaction_id', $tran_id)->first();
                $order->payment_status = 'completed';
                $order->update();

                Toastr::success('Payment status Successfully Updated', 'success');
                return redirect()->route('online_payment', $order_detials->user_id);
            }else {
                    $this->update_monthly_status($order_detials, $amount);
                    Toastr::success('Payment status Successfully Updated', 'success');
                    return redirect()->route('online_payment', $order_detials->user_id);
                }
        } else {
            DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'canceled']);
            Toastr::success('Invalid Transaction', 'Success');
            return redirect()->route('online_payment', $order_detials->user_id);
        }
    }

    public function fail(Request $request)
    {
        Toastr::Error('Your Transaction Failed', 'Success');
        return redirect()->route('user.user_dashboard');

        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'id', 'number_of_months', 'user_id')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);

            if ($order_detials->number_of_months == null) {
                $order = order::where('transaction_id', $order_detials->id)->first();
                $order->payment_status = 'Failed';
                $order->update();
            }

            if ($order_detials->number_of_months == null) {
                Toastr::success('Transaction is Falied', 'Success');
                return redirect()->route('online_payment', $order_detials->user_id);
            }
            Toastr::success('Transaction is Falied', 'Success');
            return redirect()->route('user.user_dashboard');

        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            Toastr::success('Transaction is already Successful', 'Success');
            return redirect()->route('user.user_dashboard');
        } else {
            Toastr::success('Transaction is Invalid', 'Success');
            return redirect()->route('user.user_dashboard');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount', 'id', 'number_of_months', 'user_id')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

            if ($order_detials->number_of_months == null) {
                $order = order::where('transaction_id', $order_detials->id)->first();
                $order->payment_status = 'Canceled';
                $order->update();
            }
            if ($order_detials->number_of_months == null) {
                Toastr::Error('Transaction is Cancel', 'Success');
                return redirect()->route('online_payment', $order_detials->user_id);
            }
            Toastr::Error('Transaction is Cancel', 'Success');
            return redirect()->route('user.user_dashboard');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            Toastr::success('Transaction is already Successful', 'Success');
            return redirect()->route('online_payment', $order_detials->user_id);
        } else {
            Toastr::Error('Transaction is Invalid', 'Success');
            return redirect()->route('online_payment', $order_detials->user_id);
        }

    }

    public function ipn(Request $request)
    {
        #Received all the payement information from the gateway
        if ($request->input('tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->select('transaction_id', 'status', 'currency', 'amount')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                if ($validation == TRUE) {
                    /*
                    That means IPN worked. Here you need to update order status
                    in order table as Processing or Complete.
                    Here you can also sent sms or email for successful transaction to customer
                    */
                    $update_product = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);
                    Toastr::success('Transaction is successfully Completed', 'Success');
                    return redirect()->route('user.user_dashboard');

                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    Toastr::error('validation Fail', 'Success');
                    return redirect()->route('user.user_dashboard');
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.
                Toastr::success('Transaction is already successfully Completed', 'Success');
                return redirect()->route('user.user_dashboard');
            } else {
                #That means something wrong happened. You can redirect customer to your product page.
                Toastr::error('Invalid Transaction', 'Success');
                return redirect()->route('user.user_dashboard');
                echo "Invalid Transaction";
            }
        } else {
            Toastr::error('Invalid Data', 'Success');
            return redirect()->route('user.user_dashboard');
        }
    }

    private function active_user_object_after_payment($user_id)
    {
        $user = AllUser::find($user_id);
        $email = $user->email;
        $user_last_active_payment_month = Carbon::createFromFormat('Y-m-d H:i:s', $user->last_active_payment->first()->month_name)->lastOfMonth()->toDateString();
        $corrent_month = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->lastOfMonth()->toDateString();
        if ($user_last_active_payment_month >= $corrent_month) {
            $objects = json_decode(user_objects($email), true);
            if (isset($objects)) {
                $all_object_array = array();
                foreach ($objects as $objects_data) {
                    $all_object_array[] = $objects_data['imei'];
                }
                active_user_objects($all_object_array, $user_last_active_payment_month);
            } else {
                Toastr::error('No Device Found', 'error');
                return redirect()->back();
            }

        }
    }

    private function update_monthly_status($order_detials, $amount)
    {
        $user = AllUser::where('user_id', $order_detials->user_id)->first();
        $number_of_months = $order_detials->number_of_months;
        $last_payment_date = $user->next_payment_date;

        if ($amount < (($user->monthly_bill) * $number_of_months)) {
            Toastr::error('Please input A valid Amount ' . ($user->monthly_bill) * $number_of_months . ' for ' . $number_of_months . ' months', 'Invaild Input');
            return redirect()->route('online_payment', $order_detials->user_id);
        } elseif ($amount >= (($user->monthly_bill) * $number_of_months)) {

            //update previous due history
            $previous_due_history = payment_history::where('user_id', $user->id)->where('payment_status', 0)->get();
            $number_of_due_month = $previous_due_history->count();


            if ($number_of_due_month > $number_of_months) {

                $previous_due_history_limit = payment_history::where('user_id', $user->id)->where('payment_status', 0)->take($number_of_months)->get();
                foreach ($previous_due_history_limit as $data) {
                    $data->payment_this_date = $user->monthly_bill;
                    $data->total_due = '0';
                    $data->payment_status = 1;
                    $data->update();
                }


                $this->active_user_object_after_payment($user->id);
                Toastr::success('Payment status Successfully Updated', 'success');
                return redirect()->route('online_payment', $order_detials->user_id);
            } elseif ($number_of_due_month == $number_of_months) {
                $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $last_payment_date)->firstOfMonth();
                $previous_due_history_ = payment_history::where('user_id', $user->id)->where('payment_status', 0)->get();
                foreach ($previous_due_history_ as $data) {
                    $data->payment_this_date = $user->monthly_bill;
                    $data->payment_status = 1;
                    $data->total_due = '0';
                    $data->update();
                }
                $user->payment_status = 1;
                $user->update();


                $this->active_user_object_after_payment($user->id);
                Toastr::success('Payment status Successfully Updated', 'success');
                return redirect()->route('online_payment', $order_detials->user_id);
            } elseif ($number_of_due_month < $number_of_months) {
                $extra_payment_month = $number_of_months - $number_of_due_month;
                if ($number_of_due_month == 0) {
                    $last_paid_month = payment_history::where('user_id', $user->id)->where('payment_status', 1)->orderBy('id', 'desc')->first();
                    $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $last_paid_month->month_name)->firstOfMonth();

                    for ($i = 1; $i <= $extra_payment_month; $i++) {
                        $payment_history = new payment_history();
                        $payment_history->user_id = $user->id;
                        $payment_history->month_name = $start_date->addMonth();
                        $payment_history->payment_this_date = $user->monthly_bill;
                        $payment_history->total_paid_until_this_date = '';
                        $payment_history->total_due = 0;
                        $payment_history->payment_status = 1;
                        $payment_history->save();
                    }
                    $next_payment_date = $start_date->addMonth();
                    $user->next_payment_date = $next_payment_date;
                    $user->payment_status = 1;
                    $user->update();


                    $this->active_user_object_after_payment($user->id);
                    Toastr::success('Payment status Successfully Updated', 'success');
                    return redirect()->route('online_payment', $order_detials->user_id);

                } elseif ($number_of_due_month >= 1) {
                    $due_from = payment_history::where('user_id', $user->id)->where('payment_status', 0)->orderBy('id', 'desc')->first();
                    $previous_due_history = payment_history::where('user_id', $user->id)->where('payment_status', 0)->get();
                    foreach ($previous_due_history as $data) {
                        $data->payment_this_date = $user->monthly_bill;
                        $data->payment_status = 1;
                        $data->total_due = '0';
                        $data->update();
                    }

                    $start_date = Carbon::createFromFormat('Y-m-d H:i:s', $due_from->month_name)->firstOfMonth();
                    for ($i = 1; $i <= $extra_payment_month; $i++) {
                        $payment_history = new payment_history();
                        $payment_history->user_id = $user->id;
                        $payment_history->month_name = $start_date->addMonth();
                        $payment_history->payment_this_date = $user->monthly_bill;
                        $payment_history->total_paid_until_this_date = '';
                        $payment_history->total_due = 0;
                        $payment_history->payment_status = 1;
                        $payment_history->save();
                    }

                    $next_payment_date = $start_date->addMonth();
                    $user->next_payment_date = $next_payment_date;
                    $user->payment_status = 1;
                    $user->update();


                    $this->active_user_object_after_payment($user->id);
                    Toastr::success('Payment status Successfully Updated', 'success');
                    return redirect()->route('online_payment', $order_detials->user_id);
                }

            }


        }
    }


}
