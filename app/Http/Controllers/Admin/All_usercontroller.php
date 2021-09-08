<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Assign_technician_device;
use App\Billing_shedule;
use App\Device;
use App\Exports\UsersExport;
use App\monthly_bill_update_status;
use App\Payment;
use App\payment_confarmation_history;
use App\payment_history;
use App\Technician;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Webpatser\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

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
        $user = AllUser::where('order_status', 0)->latest()->get();
        $device = Device::all();
        return view('backend.all_user.all_user', compact('user', 'technician', 'device'));
    }

    public function corporate_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('user_type', 2)->latest()->get();
        $device = Device::all();
        return view('backend.all_user.all_user', compact('user', 'technician', 'device'));
    }

    public function individual_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('user_type', 1)->latest()->get();
        $device = Device::all();
        return view('backend.all_user.all_user', compact('user', 'technician', 'device'));
    }

    public function expire_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('expair_status', 1)->latest()->get();
        $device = Device::all();
        return view('backend.all_user.all_user', compact('user', 'technician', 'device'));
    }


    public function paid_user()
    {
        $technician = Technician::all();
        $user = AllUser::where('payment_status', 1)->where('expair_status', 0)->latest()->get();
        $device = Device::all();
        return view('backend.all_user.all_user', compact('user', 'technician', 'device'));
    }

    public function due_user()
    {
        $one_months_plus = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->firstOfMonth()->addMonths()->firstOfMonth();

        $now = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->firstOfMonth();

        $total_due_user = AllUser::where('next_payment_date', '<=', $now)->get();
        $this_months_paid = AllUser::where('next_payment_date', '=', $one_months_plus)->where('payment_status', 0)->get();

        // dd($one_months_plus);
        foreach ($total_due_user as $data) {
            $user = AllUser::find($data->id);
            $user->next_payment_date = $one_months_plus;
            $user->payment_status = 0;
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

        foreach ($this_months_paid as $data) {

            $user = AllUser::find($data->id);
            $user->payment_status = 0;
            $user->update();
        }


        $technician = Technician::all();
        $user = AllUser::where('payment_status', 0)->where('expair_status', 0)->latest()->get();
        $device = Device::all();
        return view('backend.all_user.all_user', compact('user', 'technician', 'device'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.all_user.add_user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'unique:users'],
            'user_type' => 'required',
            'car_number' => 'required',
            //                'car_model' => 'required',
            'installation_date' => 'required',
            'monthly_bill' => 'required',
            'due_date' => 'required',
            //                'device_price' => 'required',
        ]);

        $due_date = $request->due_date;

        $from = Carbon::createFromFormat('Y-m-d', $due_date)->firstOfMonth();

        $to = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->firstOfMonth();


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


        if ($to < $from) {
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
        } elseif ($to == $from) {
            $after_reduce_one_months = $from->subMonth();
            for ($i = 0; $i <= $diff_in_months; $i++) {
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
        } elseif ($to > $from) {
            $after_reduce_one_months = $from->subMonth();
            for ($i = 0; $i <= $diff_in_months + 1; $i++) {
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


        Toastr::success('save Successfully :)', 'Success');
        return redirect()->route('admin.all_user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $user = AllUser::find($id);
        $payment = payment_history::where('user_id', $user->id)->orderBy('id', 'desc')->get();
//        dd($payment);
        $payment_confermation = payment_confarmation_history::where('user_id', $id)->latest()->get();
        $monthly_bill_update_history = monthly_bill_update_status::where('user_id', $id)->latest()->get();
        $onloine_payment = Payment::where('user_id', $user->user_id)->where('status', 'Processing')->orderBy('id', 'desc')->get();

        return view('backend.all_user.user_profile', compact('user', 'payment', 'payment_confermation', 'monthly_bill_update_history', 'onloine_payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = AllUser::findOrFail($id);
        return view('backend.all_user.edit_user', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
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
        $for_user_table->phone = $request->phone;
        $for_user_table->password = Hash::make('123456');
        $for_user_table->update();


        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->par_add = $request->par_add;
        $user->car_number = $request->car_number;
        $user->car_model = $request->car_model;
        $user->installation_date = $request->installation_date;
        $user->monthly_bill = $request->monthly_bill;
        $user->device_price = $request->device_price;
        $user->update();

        Toastr::success('Update Successfully :)', 'Success');
        return redirect()->route('admin.all_user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = AllUser::findOrFail($id)->delete();
        Toastr::success('Deleted Successfully :)', 'Success');
        return redirect()->back();
    }

    public function user_delete($id)
    {
        $user = AllUser::findOrFail($id);
        $user->expair_status = 1;
        $user->update();

        $previous_due_history = payment_history::where('user_id', $user->id)->where('payment_status', 0)->get();
        if ($previous_due_history->count() !== 0) {
            $number_of_due_first_month = date("F", strtotime($previous_due_history->last()->month_name));
            $number_of_due_last_month = date("F", strtotime($previous_due_history->first()->month_name));
        } else {
            $number_of_due_first_month = '  ';
            $number_of_due_last_month = '  ';
        }

        $total_due = $previous_due_history->count() * $user->monthly_bil;
        $mobile[] = $user->phone;
        $sms = "Your Connection has been expired. Please pay the due bill to active your connection. Your total due bill is $total_due tk from $number_of_due_first_month - $number_of_due_last_month. If you need any further information please contact our care number ( 01713546487)";
        send_sms($sms,$mobile);

        return response()->json(['success' => 'Done']);
    }

    public function delete_user_permanently($id)
    {
        $user = AllUser::findOrFail($id);
        $user->status = "deleted";
        $user->update();
        return response()->json(['success' => 'Done']);
    }

    public function active_user($id)
    {
        $user = AllUser::findOrFail($id);
        $user->expair_status = 0;
        $user->update();
        
        $mobile[] = $user->phone;
        $sms = "Thank You for Your Payment,Your Connection is Now Active";
        send_sms($sms,$mobile);

        Toastr::success('Activated Successfully :)', 'Success');
        return redirect()->back();
    }

    public function monthly_bill_update(Request $request, $id)
    {

        $request->validate([
            'monthly_bill' => 'required',
        ]);

        $user = AllUser::find($id);

        if ($user->monthly_bill == $request->monthly_bill) {
            Toastr::Error('You Write The Same Previous Amount', 'Success');
            return redirect()->back();
        } else {
            $user->monthly_bill = $request->monthly_bill;
            $user->update();

            $monthly_bill_update_status = new monthly_bill_update_status();
            $monthly_bill_update_status->user_id = $id;
            $monthly_bill_update_status->admin_id = Auth::id();
            $monthly_bill_update_status->monthly_bill = $request->monthly_bill;
            $monthly_bill_update_status->save();

            Toastr::success('Monthly Bill Updated Successfully :)', 'Success');
            return redirect()->back();
        }
    }


    public function full_order_history($id)
    {
        $user = AllUser::findOrFail($id);
        $orders = Assign_technician_device::where('user_id', $user->id)->latest()->get();
        $payment_confermation = payment_confarmation_history::where('user_id', $id)->latest()->get();
        $monthly_bill_update_history = monthly_bill_update_status::where('user_id', $id)->latest()->get();
        $payment = payment_history::where('user_id', $user->id)->orderBy('id', 'desc')->get();


        return view('backend.all_user.order_history', compact('user', 'orders', 'payment_confermation', 'monthly_bill_update_history', 'payment'));
    }


    public function bill_schedule(Request $request)
    {
        $request->validate([
            'note' => 'required',
            'schedule_date' => 'required',
        ]);
        $bill_schedule = new Billing_shedule();
        $bill_schedule->note = $request->note;
        $bill_schedule->date = $request->schedule_date;
        $bill_schedule->user_id = $request->user_id;
        $bill_schedule->save();

        return response()->json(['success' => 'Done']);
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
            'phone' => ['required', 'unique:users'],
            'user_type' => 'required',
            'car_number' => 'required',
            //                'car_model' => 'required',
            'installation_date' => 'required',
            'monthly_bill' => 'required',
            'due_date' => 'required',
            //                'device_price' => 'required',
        ]);

        $due_date = $request->due_date;

        $from = Carbon::createFromFormat('Y-m-d', $due_date)->firstOfMonth();

        $to = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->firstOfMonth();


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


        if ($to < $from) {
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
        } elseif ($to == $from) {
            $after_reduce_one_months = $from->subMonth();
            for ($i = 0; $i <= $diff_in_months; $i++) {
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
        } elseif ($to > $from) {
            $after_reduce_one_months = $from->subMonth();
            for ($i = 0; $i <= $diff_in_months + 1; $i++) {
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


        Toastr::success('Please Dont Mistake Again', 'Success');
        return redirect()->route('admin.all_user.index');
    }

    public function user_note_save(Request $request, $id)
    {
        $all_user = AllUser::find($id);
        $all_user->note = $request->note;
        $all_user->update();


        return response()->json([
            'message' => $all_user,
        ]);
    }


    public function search_user(Request $request)
    {
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

            $query->orderBy('all_users.id', 'desc');

            return Datatables::of($query)
                ->setTotalRecords($query->count())
                ->addIndexColumn()
                ->addColumn('id', function ($data) {
                    return $data->id;
                })->addColumn('name', function ($data) {
                    return '<a  href="' . url('admin/all_user/' . $data->id) . '" target="_blank">' . $data->name . '</a>';
                })->addColumn('phone', function ($data) {
                    return $data->phone;
                })->addColumn('email', function ($data) {
                    return $data->email ? $data->email : '';
                })->addColumn('car_number', function ($data) {
                    return $data->car_number;
                })->addColumn('monthly_bill', function ($data) {
                    return $data->monthly_bill ? $data->monthly_bill : '';
                })->addColumn('note', function ($data) {
                    return str_limit($data->note, 30);
                })->addColumn('assign_technician', function ($data) {
                    return $data->assign_techician ? '<a  href="' . url('admin/technician/' . $data->assign_techician->technician_id) . '" target="_blank">' . $data->assign_techician->technician->name . '</a>' . '<br><span class="right badge badge-success">' . $data->assign_techician->created_at->diffForHumans() . '</span>' : '';
                })->addColumn('expair_status', function ($data) {
                    $status = '';
                    if ($data->expair_status == 0) {
                        $status = '<span class="right badge badge-info">Active</span>';
                    } else {
                        $status = '<span class="right badge badge-warning">Expired</span>';
                    }
                    return $status;
                })->addColumn('payment_status', function ($data) {
                    $status = '';
                    if ($data->payment_status == 1) {
                        $status = '<span class="right badge badge-info">Paid</span>';
                    } else {
                        $status = '<span class="right badge badge-warning">Unpaid</span>';
                    }
                    return $status;
                })
                ->addColumn('action', function ($data) {
                    $expair_status = $data->expair_status == 0 ? '<a class="dropdown-item" href="#" onclick="expier_user(' . $data->id . ')" >Expire</a>' : '<a class="dropdown-item" href="#" onclick="active_user(' . $data->id . ')">Active</a> ';

                    $delete_user = '<a class="dropdown-item" href="#" onclick="delete_user(' . $data->id . ')" >Expire</a>';

                    $bill_schedule_status = $data->bill_schedule ? '<button type="button" id="mouse_hover" class="dropdown-item bg-pink" data-toggle="tooltip" data-placement="top" title="Scheduled at: ' . $data->bill_schedule->created_at . ', comment: ' . $data->bill_schedule->note . '">Scheduled </button> ' : ' <a class="dropdown-item" href="" data-toggle="modal" data-target="#bill_shedule" onclick="bill_user_id(' . $data->id . ')">Bill Schedule</a>';

                    $assign_technician = $data->assign_techician ? '' : ' <a class="dropdown-item" href="" data-toggle="modal" data-target="#assign_technician" onclick="user_id(' . $data->id . ')">Assign Technician</a>';

                    //                    $action_button = ' <a class="dropdown-item" href="' . route('admin.all_user.edit', $data->id) . '"><i class="fas fa-edit"></i></a> ' . $expair_status . $bill_schedule_status . $assign_technician . ' <dropdown-item bg-pink" href="#" onclick="send_sms(' . $data->id . ')"><i class="fas fa-sms"></i></a>';

                    $action_button = '<div class="btn-group"> <button type="button" class="btn btn-sm dropdown-item dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: #0d8d2d;color: white;text-align: center"> Action </button> <div class="dropdown-menu dropdown-menu-right text-center"> <a class="dropdown-item" href="' . route('admin.all_user.edit', $data->id) . '">Edit User ' . $expair_status . $bill_schedule_status . $assign_technician . ' <a class="dropdown-item" href="#" onclick="show_devices(' . $data->id . ')">Show Devices</a> <a class="dropdown-item" href="#" onclick="open_send_sms_modal(' . $data->id . ')">Send Sms</a><a class="dropdown-item" href="#" onclick="delete_user(' . $data->id . ')" >Delete User</a> </div> </div>';
                    return $action_button;
                })
                ->rawColumns(['action', 'id', 'name', 'phone', 'email', 'car_number', 'monthly_bill', 'payment_status', 'note', 'assign_technician', 'expair_status'])
                ->make(true);
        }
    }

    public function show_devices($id)
    {
        $user = AllUser::find($id);
        $email = $user->email;
        if (check_user($email) == 'true') {
            $objects = json_decode(user_objects($email), true);
            //            return $objects;
            $object_loop_active = '';
            $object_loop_inactive = '';
            foreach ($objects as $objects_data) {
                if ($objects_data['active'] == 'true') {
                    $object_loop_active .= '<input type="hidden" value="' . $id . '" id="object_user_id"><li class="list-group-item"> <div class="form-check"> <input class="form-check-input" type="checkbox" value="' . $objects_data['imei'] . '" id="defaultCheck' . $objects_data['imei'] . '" name="object_name_active" checked> <label class="form-check-label" for="defaultCheck' . $objects_data['imei'] . '"> ' . $objects_data['name'] . ' </label> </div></li>';
                } else {
                    $object_loop_inactive .= '<input type="hidden" value="' . $id . '" id="object_user_id"><li class="list-group-item"> <div class="form-check"> <input class="form-check-input" type="checkbox" value="' . $objects_data['imei'] . '" id="defaultCheck' . $objects_data['imei'] . '" name="object_name_inactive" checked> <label class="form-check-label" for="defaultCheck' . $objects_data['imei'] . '"> ' . $objects_data['name'] . ' </label> </div></li>';
                }
            }
            return $object_array = [
                'active' => $object_loop_active,
                'inactive' => $object_loop_inactive,
            ];
        } else {
            return 'user not found';
        }
    }


    public function deactive_object(Request $request)
    {
        deactive_user_objects($request->active_object);
        return response()->json(['success' => 'Done']);
    }


    public function active_object(Request $request)
    {
        $request->validate([
            'expaire_date' => ['required'],
        ]);
        active_user_objects($request->active_object, $request->expaire_date);
        return response()->json(['success' => 'Done']);
    }
    
    public function send_manual_message()
    {
        Artisan::call('SendDueUserSms');
        Artisan::call('queue:work --stop-when-empty');
        return response()->json(['success' => 'Done']);
    }
    
    
    
}
