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

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        # Here you have to receive all the order data to initate the payment.
        # Let's say, your oder transaction informations are saving in a table called "payments"
        # In "payments" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

//        return $request;

        $user_id = Auth::id();

        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $request->name;
        $post_data['cus_email'] = $request->email;
        $post_data['cus_add1'] = $request->address;
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
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('payments')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'user_id' => $user_id,
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);


                $transaction_id = DB::table('payments')->where('transaction_id',$post_data['tran_id'])->first();


                    $order = new order();
                    $order->user_id = $user_id;
                    $order->transaction_id = $transaction_id->id;
                    $order->package_id = $request->package_id;
                    $order->payment_status = 'Pending';
                    $order->order_status = 0;//0=pending,1=process,2=complete
//                    $order->device_quantity = ;
                    $order->save();


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }


    public function guest_user_register_order(Request $request,$id)
    {


         $validator =   $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',],
                'password' => ['required', 'string', 'min:4', 'confirmed'],
                'phone' => ['required','unique:users'],
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
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
        $update_product = DB::table('payments')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'user_id' => $for_user_table->id,
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);


                $transaction_id = DB::table('payments')->where('transaction_id',$post_data['tran_id'])->first();


                    $order = new order();
                    $order->user_id = $for_user_table->id;
                    $order->transaction_id = $transaction_id->id;
                    $order->package_id = $id;
                    $order->payment_status = 'incomplete';
                    $order->order_status = 0;//0=pending,1=process,2=complete
//                    $order->device_quantity = ;
                    $order->save();


        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }




    public function bill_payment_pay(Request $request,$id)
    {

        $user_id = AllUser::find($id);

        if ($user_id->order_status == 1){
            Toastr::error('You have still Running a order,please wait for the confirmation','success');
            return redirect()->back();
        }

        $post_data = array();
        $post_data['total_amount'] = $request->amount; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $user_id->name;
        $post_data['cus_email'] = $user_id->email;
        $post_data['cus_add1'] = $user_id->par_add;
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
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";

        #Before  going to initiate the payment order status need to insert or update as Pending.
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
                'number_of_months' => $request->number_of_months
            ]);





        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
        }

    }

    public function payViaAjax(Request $request)
    {



        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "payments"
        # In payments table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

        $post_data = array();
        $post_data['total_amount'] = ''; # You cant not pay less than 10
        $post_data['currency'] = "BDT";
        $post_data['tran_id'] = uniqid(); // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = 'Customer Name';
        $post_data['cus_email'] = 'customer@mail.com';
        $post_data['cus_add1'] = 'Customer Address';
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = "";
        $post_data['cus_state'] = "";
        $post_data['cus_postcode'] = "";
        $post_data['cus_country'] = "Bangladesh";
        $post_data['cus_phone'] = '8801XXXXXXXXX';
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
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('payments')
            ->where('transaction_id', $post_data['tran_id'])
            ->updateOrInsert([
                'name' => $post_data['cus_name'],
                'email' => $post_data['cus_email'],
                'phone' => $post_data['cus_phone'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'address' => $post_data['cus_add1'],
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency']
            ]);





        $sslc = new SslCommerzNotification();
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

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

        $sslc = new SslCommerzNotification();

        #Check order status in order tabel against the transaction id or order id.
        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount','id','number_of_months','user_id')->first();




        if ($order_detials->status == 'Pending') {
            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $request->all());

            if ($validation == TRUE) {

                /*
                That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                in order table as Processing or Complete.
                Here you can also sent sms or email for successfull transaction to customer
                */
                $update_product = DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Processing']);

                     if($order_detials->number_of_months == null) {
                         $user = AllUser::where('user_id', $order_detials->user_id)->first();
                         $user->order_status = 1;
                         $user->update();
                     }
                     if($order_detials->number_of_months == null) {
                         $all_user = AllUser::where('user_id', $order_detials->user_id)->first();
                         $all_user->payment_status = 1;
                         $all_user->update();
                     }
                    if($order_detials->number_of_months == null) {
                        $order = order::where('transaction_id', $order_detials->id)->first();
                        $order->payment_status = 'completed';
                        $order->update();

                                                $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('
Thank you for your order. We have received your order for. Our Technical team contact with you soon.
Safety GPS Tracker').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);
                    }

                    if($order_detials->number_of_months !== null){

                        $user = AllUser::where('user_id',$order_detials->user_id)->first();
                        $number_of_months = $order_detials->number_of_months;
                        $last_payment_date = $user->next_payment_date;

                        if ($amount <  (($user->monthly_bill)*$number_of_months)){
                            Toastr::error('Please input A valid Amount '.($user->monthly_bill)*$number_of_months.' for '.$number_of_months.' months','Invaild Input');
                            return redirect()->route('online_payment',$order_detials->user_id);
                        }
                        elseif($amount >=  (($user->monthly_bill)*$number_of_months)){

                //update previous due history
                $previous_due_history = payment_history::where('user_id',$user->id)->where('payment_status',0)->get();
                $number_of_due_month = $previous_due_history->count();


            if ($number_of_due_month > $number_of_months){

                $previous_due_history_limit = payment_history::where('user_id',$user->id)->where('payment_status',0)->take($number_of_months)->get();
                foreach ($previous_due_history_limit as $data)
                {
                    $data->payment_this_date = $user->monthly_bill;
                    $data->total_due = '0';
                    $data->payment_status = 1;
                    $data->update();
                }


               Toastr::success('Payment status Successfully Updated','success');
               return redirect()->route('online_payment',$order_detials->user_id);
            }
            elseif ($number_of_due_month == $number_of_months)
            {
                $start_date  = Carbon::createFromFormat('Y-m-d H:i:s', $last_payment_date)->firstOfMonth();
                $previous_due_history_ = payment_history::where('user_id',$user->id)->where('payment_status',0)->get();
                foreach ($previous_due_history_ as $data)
                {
                    $data->payment_this_date = $user->monthly_bill;
                    $data->payment_status = 1;
                    $data->total_due = '0';
                    $data->update();
                }
                $user->payment_status = 1;
                $user->update();



               Toastr::success('Payment status Successfully Updated','success');
               return redirect()->route('online_payment',$order_detials->user_id);
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
                                $payment_history->user_id = $user->id;
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


                            Toastr::success('Payment status Successfully Updated','success');
                            return redirect()->route('online_payment',$order_detials->user_id);

                        }elseif ($number_of_due_month >= 1)
                        {
                            $due_from = payment_history::where('user_id',$user->id)->where('payment_status',0)->orderBy('id','desc')->first();
                            $previous_due_history = payment_history::where('user_id',$user->id)->where('payment_status',0)->get();
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
                                $payment_history->user_id = $user->id;
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



                            Toastr::success('Payment status Successfully Updated','success');
                            return redirect()->route('online_payment',$order_detials->user_id);
                        }

                    }


        }


                    }



                Toastr::success('Transaction is successfully Completed','Success');
                return redirect()->route('user.user_dashboard');
            } else {
                /*
                That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                Here you need to update order status as Failed in order table.
                */
                $update_product = DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->update(['status' => 'Failed']);
                    if($order_detials->number_of_months == null){
                        $order = order::where('transaction_id',$order_detials->id)->first();
                                        $order->payment_status = 'Failed';
                                        $order->update();

                    }




                Toastr::Error('validation Fail','Success');
                return redirect()->route('user.user_dashboard');
            }
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {

            /*
             That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
             */
                    $user_id = Auth::id();
                    if($order_detials->number_of_months == null) {
                        $user = AllUser::where('user_id', $order_detials->user_id)->first();
                        $user->order_status = 1;
                        $user->update();
                    }
                    if($order_detials->number_of_months == null) {
                        $all_user = AllUser::where('user_id', $order_detials->user_id)->first();
                        $all_user->payment_status = 1;
                        $all_user->update();
                    }
                    if($order_detials->number_of_months == null) {
                        $order = order::where('transaction_id', $order_detials->id)->first();
                        $order->payment_status = 'completed';
                        $order->update();


                        $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('
Thank you for your order. We have received your order for. Our Technical team contact with you soon.
Safety GPS Tracker').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);


                    }

                    if($order_detials->number_of_months !== null){

                        $user = AllUser::where('user_id',$order_detials->user_id)->first();
                        $number_of_months = $order_detials->number_of_months;
                        $last_payment_date = $user->next_payment_date;

                        if ($amount <  (($user->monthly_bill)*$number_of_months)){
                            Toastr::error('Please input A valid Amount '.($user->monthly_bill)*$number_of_months.' for '.$number_of_months.' months','Invaild Input');
                            return redirect()->route('online_payment',$order_detials->user_id);
                        }
                        elseif($amount >=  (($user->monthly_bill)*$number_of_months)){

                //update previous due history
                $previous_due_history = payment_history::where('user_id',$user->id)->where('payment_status',0)->get();
                $number_of_due_month = $previous_due_history->count();


            if ($number_of_due_month > $number_of_months){

                $previous_due_history_limit = payment_history::where('user_id',$user->id)->where('payment_status',0)->take($number_of_months)->get();
                foreach ($previous_due_history_limit as $data)
                {
                    $data->payment_this_date = $user->monthly_bill;
                    $data->total_due = '0';
                    $data->payment_status = 1;
                    $data->update();
                }


               Toastr::success('Payment status Successfully Updated','success');
               return redirect()->route('online_payment',$order_detials->user_id);
            }
            elseif ($number_of_due_month == $number_of_months)
            {
                $start_date  = Carbon::createFromFormat('Y-m-d H:i:s', $last_payment_date)->firstOfMonth();
                $previous_due_history_ = payment_history::where('user_id',$user->id)->where('payment_status',0)->get();
                foreach ($previous_due_history_ as $data)
                {
                    $data->payment_this_date = $user->monthly_bill;
                    $data->payment_status = 1;
                    $data->total_due = '0';
                    $data->update();
                }
                $user->payment_status = 1;
                $user->update();



               Toastr::success('Payment status Successfully Updated','success');
               return redirect()->route('online_payment',$order_detials->user_id);
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
                                $payment_history->user_id = $user->id;
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


                            Toastr::success('Payment status Successfully Updated','success');
                            return redirect()->route('online_payment',$order_detials->user_id);

                        }elseif ($number_of_due_month >= 1)
                        {
                            $due_from = payment_history::where('user_id',$user->id)->where('payment_status',0)->orderBy('id','desc')->first();
                            $previous_due_history = payment_history::where('user_id',$user->id)->where('payment_status',0)->get();
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
                                $payment_history->user_id = $user->id;
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



                            Toastr::success('Payment status Successfully Updated','success');
                            return redirect()->route('online_payment',$order_detials->user_id);
                        }

                    }


        }




                    }



            Toastr::success('Transaction is successfully Completed','Success');
             return redirect()->route('user.user_dashboard');
        } else {
            #That means something wrong happened. You can redirect customer to your product page.
            Toastr::success('Invalid Transaction','Success');
             return redirect()->route('user.user_dashboard');
        }


    }


    public function fail(Request $request)
    {
        Toastr::Error('Your Transaction Failed','Success');
        return redirect()->route('user.user_dashboard');

        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount','id','number_of_months','user_id')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Failed']);

                if($order_detials->number_of_months == null) {
                    $order = order::where('transaction_id', $order_detials->id)->first();
                    $order->payment_status = 'Failed';
                    $order->update();
                }

                if($order_detials->number_of_months == null) {
                Toastr::success('Transaction is Falied','Success');
                return redirect()->route('online_payment',$order_detials->user_id);
            }
            Toastr::success('Transaction is Falied','Success');
            return redirect()->route('user.user_dashboard');

        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            Toastr::success('Transaction is already Successful','Success');
            return redirect()->route('user.user_dashboard');
        } else {
            Toastr::success('Transaction is Invalid','Success');
            return redirect()->route('user.user_dashboard');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('tran_id');

        $order_detials = DB::table('payments')
            ->where('transaction_id', $tran_id)
            ->select('transaction_id', 'status', 'currency', 'amount','id','number_of_months','user_id')->first();

        if ($order_detials->status == 'Pending') {
            $update_product = DB::table('payments')
                ->where('transaction_id', $tran_id)
                ->update(['status' => 'Canceled']);

            if($order_detials->number_of_months == null) {
                $order = order::where('transaction_id', $order_detials->id)->first();
                $order->payment_status = 'Canceled';
                $order->update();
            }
            if($order_detials->number_of_months == null) {
                Toastr::Error('Transaction is Cancel','Success');
                return redirect()->route('online_payment',$order_detials->user_id);
            }
            Toastr::Error('Transaction is Cancel','Success');
            return redirect()->route('user.user_dashboard');
        } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
            Toastr::success('Transaction is already Successful','Success');
            return redirect()->route('user.user_dashboard');
        } else {
            Toastr::Error('Transaction is Invalid','Success');
            return redirect()->route('user.user_dashboard');
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
                    Toastr::success('Transaction is successfully Completed','Success');
                    return redirect()->route('user.user_dashboard');

                } else {
                    /*
                    That means IPN worked, but Transation validation failed.
                    Here you need to update order status as Failed in order table.
                    */
                    $update_product = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);

                    Toastr::error('validation Fail','Success');
                    return redirect()->route('user.user_dashboard');
                }

            } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                #That means Order status already updated. No need to udate database.
                Toastr::success('Transaction is already successfully Completed','Success');
                return redirect()->route('user.user_dashboard');
            } else {
                #That means something wrong happened. You can redirect customer to your product page.
                Toastr::error('Invalid Transaction','Success');
                return redirect()->route('user.user_dashboard');
                echo "Invalid Transaction";
            }
        } else {
            Toastr::error('Invalid Data','Success');
            return redirect()->route('user.user_dashboard');
        }
    }




    public function by_me()
    {
            $post_data = array();
            $post_data['store_id'] = "epweb5e4939c9164a2";
            $post_data['store_passwd'] = "epweb5e4939c9164a2@ssl";
            $post_data['total_amount'] = "103";
            $post_data['currency'] = "BDT";
            $post_data['tran_id'] = "SSLCZ_TEST_".uniqid();
            $post_data['success_url'] = "http://localhost/new_sslcz_gw/success.php";
            $post_data['fail_url'] = "http://localhost/new_sslcz_gw/fail.php";
            $post_data['cancel_url'] = "http://localhost/new_sslcz_gw/cancel.php";
            # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE

            # EMI INFO
            $post_data['emi_option'] = "1";
            $post_data['emi_max_inst_option'] = "9";
            $post_data['emi_selected_inst'] = "9";

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = "Test Customer";
            $post_data['cus_email'] = "test@test.com";
            $post_data['cus_add1'] = "Dhaka";
            $post_data['cus_add2'] = "Dhaka";
            $post_data['cus_city'] = "Dhaka";
            $post_data['cus_state'] = "Dhaka";
            $post_data['cus_postcode'] = "1000";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = "01711111111";
            $post_data['cus_fax'] = "01711111111";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1 '] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_country'] = "Bangladesh";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "ref001";
            $post_data['value_b '] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";

            # CART PARAMETERS
            $post_data['cart'] = json_encode(array(
                array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
                array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
                array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
                array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")
            ));
            $post_data['product_amount'] = "100";
            $post_data['vat'] = "5";
            $post_data['discount_amount'] = "5";
            $post_data['convenience_fee'] = "3";


            # REQUEST SEND TO SSLCOMMERZ
            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";

            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, $direct_api_url );
            curl_setopt($handle, CURLOPT_TIMEOUT, 30);
            curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($handle, CURLOPT_POST, 1 );
            curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC


            $content = curl_exec($handle );

            $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);

            if($code == 200 && !( curl_errno($handle))) {
                curl_close( $handle);
                $sslcommerzResponse = $content;
            } else {
                curl_close( $handle);
                echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
                exit;
            }

            # PARSE THE JSON RESPONSE
            $sslcz = json_decode($sslcommerzResponse, true );

            if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
                    # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                    # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
                # header("Location: ". $sslcz['GatewayPageURL']);
                exit;
            } else {
                echo "JSON Data parsing error!";
            }



    }

}
