<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Assign_technician_device;
use App\Device;
use App\order;
use App\payment_history;
use App\Price_categaroy;
use App\technican_stock;
use App\Technician;
use App\technician_device_stock;
use App\Transaction_history;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technician = Technician::latest()->get();
        return view('backend.technician.technician', compact('technician'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.technician.add_technician');
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',

        ]);

        $technician = new Technician();
        $technician->name = $request->name;
        $technician->phone = $request->phone;
        $technician->email = $request->email;
        $technician->address = $request->address;
        $technician->save();

        Toastr::success('Technician Added Successfully :)', 'Success');
        return redirect()->route('admin.technician.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $completed_order = Assign_technician_device::where('status', 1)->where('technician_id', $id)->get();
        $technician = Technician::find($id);
        $technician_history = Assign_technician_device::where('technician_id', $id)->latest()->get();
        $device = Device::all();
        return view('backend.technician.technician_profile', compact('technician', 'technician_history', 'device', 'completed_order'));
    }

    public function ajax_assign_devices($id)
    {
        $assign_technician_device_stock = technician_device_stock::where('assign_id', $id)->get();

        return response()->json([
            'error' => false,
            'devices' => $assign_technician_device_stock,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $technician = Technician::find($id);
        return view('backend.technician.edit_technician', compact('technician'));
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',

        ]);
        $technician = Technician::find($id);
        $technician->name = $request->name;
        $technician->phone = $request->phone;
        $technician->email = $request->email;
        $technician->address = $request->address;
        $technician->update();

        Toastr::success('Technician Updated Successfully :)', 'Success');
        return redirect()->route('admin.technician.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Technician::find($id)->delete();
        return redirect()->back();
    }

    public function technician_delete($id)
    {
        Technician::find($id)->delete();
        Toastr::success('Technician deleted  Successfully :)', 'Success');
        return redirect()->back();
    }


    public function conpletation(Request $request)
    {

//        return $request;
        $assign_id = $request->assign_id;
        $sell_price = $request->sell_price;
        $installation_cost = $request->installation_cost;
        $number = $request->input('device_id');
        $device_costing = 0;


        if ($number == null) {
            $assign_tecnician = Assign_technician_device::find($assign_id);
            $assign_tecnician->status = 1;
            $assign_tecnician->update();

            if (isset($assign_tecnician->order_id)) {

                $user = AllUser::find($assign_tecnician->user_id);

                $order = order::find($assign_tecnician->order_id);
                $order->order_status = 2;
                $order->update();

                $package = Price_categaroy::find($order->package_id);
                if (payment_history::where('user_id', $user->id)->exists()) {
                    $user->monthly_bill += $package->monthly_charge;
                    $user->update();
                }
            }
        } else {
            for ($i = 0; $i < count($number); $i++) {
                $technician_stock = technician_device_stock::find($request->stock_id[$i]);
                $extra_device = $technician_stock->quantity - $request->quantity[$i];
                $technician_stock->quantity = $request->quantity[$i];
                $technician_stock->update();

                $assign_tecnician = Assign_technician_device::find($assign_id);
                $assign_tecnician->status = 1;
                $assign_tecnician->update();

                $device = technican_stock::find($request->device_id[$i]);
                $device->quantity = $device->quantity + $extra_device;
                $device->update();
                if ($device->quantity == 0) {
                    $device->delete();
                }

                $device_costing += ($request->quantity[$i] * $device->device_price);

            }

            $device_transaction_history = new Transaction_history();
            $device_transaction_history->device_costing = $device_costing;
            $device_transaction_history->user_id = $assign_tecnician->user_id;
            $device_transaction_history->assign_id = $assign_id;
            $device_transaction_history->technician_id = $assign_tecnician->technician_id;
            $device_transaction_history->sell_price = $sell_price;
            $device_transaction_history->installation_cost = $request->installation_cost;
            $profit_or_loss = $sell_price - ($device_costing + $installation_cost);
            $device_transaction_history->profit_or_loss = $profit_or_loss;
            $device_transaction_history->save();

            $assign_tecnician = Assign_technician_device::find($assign_id);
            $user = AllUser::find($assign_tecnician->user_id);
            $user->order_status = 0;
            $user->update();


            if (isset($assign_tecnician->order_id)) {

                $now = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->firstOfMonth();
                $user = AllUser::find($assign_tecnician->user_id);

                $order = order::find($assign_tecnician->order_id);
                $order->order_status = 2;
                $order->update();

                $package = Price_categaroy::find($order->package_id);
                if (payment_history::where('user_id', $user->id)->exists()) {
                    $user->monthly_bill += $package->monthly_charge;
                    $user->update();
                } else {
                    $user->monthly_bill = $package->monthly_charge;
                    $user->next_payment_date = $now;
                    $user->device_price = $package->device_price;
                    $user->update();

                    $payment_history = new payment_history();
                    $payment_history->user_id = $user->id;
                    $payment_history->month_name = $now;

                    $payment_history->total_paid_until_this_date = '';
                    $payment_history->total_due = $user->monthly_bill;
                    $payment_history->payment_status = 0;
                    $payment_history->nest_payment_date = $now;
                    $payment_history->save();
                }
            }

        }


        Toastr::success('Technician Successfully Complete The Order', 'Success');
        return redirect()->back();


    }

    public function technician_assign(Request $request)
    {
        $request->validate([
            'technician_id' => 'required',
        ]);
        
        $technician_id = $request->technician_id;
        $user_id = $request->user_id;
        
        $assign_tecnician = new Assign_technician_device();
        $assign_tecnician->technician_id = $technician_id;
        $assign_tecnician->user_id = $user_id;
        $assign_tecnician->note = $request->assign_reason;
        $assign_tecnician->save();

        return response()->json(['success' => 'Done']);
    }


    public function order_cancel(Request $request)
    {
        $assign_tecnician = Assign_technician_device::find($request->assign_id);
        $assign_tecnician->note = $request->note;
        $assign_tecnician->status = 2;
        $assign_tecnician->update();
        
        Toastr::error('Order cancellation  Successfully :)', 'Success');
        return redirect()->back();
    }
    
    public function confirm_complain($id)
    {
        $assign_tecnician = Assign_technician_device::find($id);
        $assign_tecnician->status = 1;
        $assign_tecnician->update();
        
        Toastr::success('Order Confiramed  Successfully :)', 'Success');
        return redirect()->back();
    }


}
