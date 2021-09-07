<?php

namespace App\Http\Controllers;

use App\AllUser;
use App\Assign_technician_device;
use App\Complain;
use App\Contact_info;
use App\Feature;
use App\HappyClient;
use App\HomePageModel;
use App\page;
use App\payment_confarmation_history;
use App\payment_history;
use App\Price_categaroy;
use App\TrackingDevice;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class HomeController2 extends Controller
{

    public function index()
    {
        $price = Price_categaroy::all();
        $feature = Feature::latest()->get();
        $happy_client = HappyClient::latest()->get();

        return view('home', compact('price', 'feature', 'happy_client'));
    }

    public function contact()
    {
        $contact = Contact_info::all();
        return view('contact', compact('contact'));
    }

    public function user_complain_save(Request $request)
    {
        $complain = new Complain();
        $complain->name = $request->name;
        $complain->phone = $request->mobile;
        $complain->email = $request->email;
        $complain->status = "pending";
        $complain->description = $request->complain;
        $complain->save();

        Toastr::success('Our Team will contact with you soon', 'Successfully palce');
        return redirect()->back();
    }

    public function user_registration()
    {
        return view('frontend.registration');
    }

    public function user_registration_store(Request $request)
    {
        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255',],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
            'phone' => ['required', 'unique:users'],
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
        $user->user_type = 1;
        $user->order_status = 1;

        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->due_date = $request->due_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->total_due = $request->total_due;
        $user->next_payment_date = '-';
        $user->total_paied = $request->total_paied;
        $user->save();

        Toastr::success('You have Successfully registered ', 'Registration Successfull');
        return redirect()->route('user_login')->with('message', 'You have Successfully registered');

    }


    public function user_login()
    {
        return view('frontend.user_login');
    }


    public function update_user_info(Request $request, $id)
    {

        $main_user_table = User::find($id);

        if ($request->phone == $main_user_table->phone) {

            $main_user_table->phone = $request->phone;
            $main_user_table->name = $request->name;
            $main_user_table->email = $request->email;
            $main_user_table->update();


            $old_user_table = AllUser::where('user_id', $id)->first();
            $old_user_table->phone = $request->phone;
            $old_user_table->name = $request->name;
            $old_user_table->email = $request->email;
            $old_user_table->par_add = $request->par_add;
            $old_user_table->update();

            Toastr::success('Account Information updated Successfully', 'Success');
            return redirect()->back()->with('message', 'Account Information updated Successfully');
        }


        $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users'],
        ]);


        $main_user_table->phone = $request->phone;
        $main_user_table->name = $request->name;
        $main_user_table->email = $request->email;
        $main_user_table->update();


        $old_user_table = AllUser::where('user_id', $id)->first();
        $old_user_table->phone = $request->phone;
        $old_user_table->name = $request->name;
        $old_user_table->email = $request->email;
        $old_user_table->par_add = $request->par_add;
        $old_user_table->update();

        Toastr::success('Account Information updated Successfully', 'Success');
        return redirect()->back()->with('message', 'Account Information updated Successfully');

    }

    public function price_list()
    {
        $price = Price_categaroy::all();
        return view('frontend.price_list', compact('price'));
    }

    public function post_complain(Request $request)
    {

    }


    public function feature()
    {
        $feature = Feature::latest()->get();
        return view('frontend.feature', compact('feature'));
    }

    public function our_devices()
    {
        $device = TrackingDevice::latest()->get();
        $feature = Feature::latest()->get();
        return view('frontend.devices', compact('device', 'feature'));
    }

    public function map()
    {
        return view('frontend.map');
    }

    public function Pay_bill()
    {
        return view('frontend.pay_bill');
    }

    public function phone_number_search(Request $request)
    {
        $query = $request->get('query');
        if ($query !== '') {
            $phone = $request->get('query');
            $data1 = User::where('phone', $phone)->get();
            $data_count = User::where('phone', $phone)->count();

            if ($data_count > 0) {
                $data2 = AllUser::where('user_id', $data1->first()->id)->get()->first();

                $previous_due_history = payment_history::where('user_id', $data2->id)->where('payment_status', 0)->latest()->get();

                if ($previous_due_history->count() !== 0) {
                    $number_of_due_first_month = date("F", strtotime($previous_due_history->last()->month_name));
                    $number_of_due_last_month = date("F", strtotime($previous_due_history->first()->month_name));
                } else {
                    $number_of_due_first_month = '  ';
                    $number_of_due_last_month = '  ';
                }


                $data = array(
                    'user' => $data2,
                    'fast_due_month' => $number_of_due_first_month,
                    'last_due_month' => $number_of_due_last_month,
                    'total_due_month' => $previous_due_history->count(),
                );

                return Response($data);
            } else {
                $data = 'null';
                return Response($data);
            }
        } else {
            $data = 'null';
            return Response($data);
        }

    }

    public function online_payment($id)
    {
        $user = User::find($id);
        $all_user = AllUser::where('user_id', $id)->first();

        $payment = payment_history::where('user_id', $all_user->id)->orderBy('id', 'desc')->get();
        return view('frontend.payment_online', compact('all_user', 'payment'));
    }

    public function single_page($id)
    {
        $page = Page::find($id);
        return view('frontend.single_page', compact('page'));
    }


    public function dashboardreport($type)
    {
        if ($type == "onlinepayment") {
            //        payment history last 30 days
            $day_by_day_payment_history = DB::table('payments')->where('status', 'Processing')->select('amount', 'created_at')->whereDate('payments.created_at', '>', Carbon::now()->subYear(2))->get()->groupBy
            (function ($grouped) {
                return (new Carbon($grouped->created_at))->format('d/m/y');
            });
            foreach ($day_by_day_payment_history as $key => $value) {
                $lebel[] = $key;
                $data[] = $value->sum('amount');
            }
        } elseif ($type == "manual_payment") {
            //        payment history last 30 days
            $day_by_day_payment_history = DB::table('payment_confarmation_histories')->select('updated_amount', 'created_at')->whereDate('payment_confarmation_histories.created_at', '>', Carbon::now()->subDay(30))->get()->groupBy
            (function ($grouped) {
                return (new Carbon($grouped->created_at))->format('d/m/y');
            });
            foreach ($day_by_day_payment_history as $key => $value) {
                $lebel[] = $key;
                $data[] = $value->sum('updated_amount');
            }
        }
        return Response::json(['lebel' => $lebel, 'data' => $data], 200);
    }


}
