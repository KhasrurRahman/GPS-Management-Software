<?php

namespace App\Http\Controllers\Admin;

use App\Assign_technician_device;
use App\Device;
use App\technican_stock;
use App\Technician;
use App\Transaction_history;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $technician = Technician::all();
        $device = Device::all();
        return view('backend.device.all_device',compact('device','technician'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('backend.device.add_device');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $device = new Device();
        $device->device_name = $request->device_name;
        $device->device_model = $request->device_model;
        $device->device_price = $request->device_price;
        $device->quantity = $request->quantity;
        $device->save();

        Toastr::success('Device Added Successfully :)','Success');
        return redirect()->route('admin.device.index');
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
        $device = Device::find($id);
        return view('backend.device.edit_device',compact('device'));
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
        $device = Device::find($id);
        $device->device_name = $request->device_name;
        $device->device_model = $request->device_model;
        $device->device_price = $request->device_price;
        $device->quantity = $request->quantity;
        $device->update();

        Toastr::success('Device Updated Successfully :)','Success');
        return redirect()->route('admin.device.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id)->delete();
        Toastr::success('Device Deleted Successfully :)','Success');
        return redirect()->back();
    }

    public function device_delete($id)
    {
        $device = Device::find($id)->delete();
        Toastr::success('Device Deleted Successfully :)','Success');
        return redirect()->route('admin.device.index');
    }

    public function assign_technician(Request $request,$id)
    {

        $device = Device::find($id);

        $technician_id = $request->technician_id;
        $given_quantity = $request->given_quantity;

        if ($given_quantity > $device->quantity){
            Toastr::Error('There is not enough Quantity for this Device','Success');
            return redirect()->back();
        }else{
        $technician = new Assign_technician_device();
        $technician->technician_id = $technician_id;
        $technician->device_id = $id;
        $technician->quantity = $given_quantity;
        $technician->save();

        Toastr::success('Device Assign Successfull','Success');
        return redirect()->back();

        }

    }

    public function assign_technician_from_device_stock(Request $request)
    {


        $device = Device::find($request->device_id);
        if ($device->quantity < $request->quantity){
            Toastr::Error('There is not Enough quantity for this device in the stock','Error');
            return redirect()->back();
        }

        $device->quantity -=$request->quantity;
        $device->update();


        if (technican_stock::where('device_id',$request->device_id)->where('technicain_id',$request->technican_id)->exists())
        {
            $technican_stock = technican_stock::where('device_id',$request->device_id)->first();
            $technican_stock->quantity += $request->quantity;
            $technican_stock->update();
        }else{

            $technican_stock = new technican_stock();
            $technican_stock->model = $device->device_model;
            $technican_stock->device_id = $request->device_id;
            $technican_stock->quantity = $request->quantity;
            $technican_stock->technicain_id = $request->technican_id;
            $technican_stock->save();
        }

        Toastr::success('Device Assign Successfull','Success');
        return redirect()->back();

    }



    public function device_transaction_history(){

        $transaction_hisytory = Transaction_history::latest()->get();
        $total_profit_loss = Transaction_history::sum('profit_or_loss');
        $total_device_costing = Transaction_history::sum('device_costing');
        $total_sell_price = Transaction_history::sum('sell_price');
        $total_installation_cost = Transaction_history::sum('installation_cost');
        return view('backend.device.transaction_history',compact('transaction_hisytory','total_profit_loss','total_device_costing','total_sell_price','total_installation_cost'));
    }


    public function device_transaction_history_date(Request $request)
    {
        $start_date = Carbon::parse($request->start_date)->startOfDay()->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->startOfDay()->toDateTimeString();

//        $diff_in_days = $start_date->diffInDays($end_date);

        if ($start_date == $end_date){
            $transaction_hisytory = Transaction_history::whereDate('created_at', '=',$start_date)->get();
            $total_profit_loss = Transaction_history::whereDate('created_at', '=',$start_date)->sum('profit_or_loss');
            $total_device_costing = Transaction_history::whereDate('created_at', '=',$start_date)->sum('device_costing');
            $total_sell_price = Transaction_history::whereDate('created_at', '=',$start_date)->sum('sell_price');
            $total_installation_cost = Transaction_history::whereDate('created_at', '=',$start_date)->sum('installation_cost');
        }else{

        $transaction_hisytory = Transaction_history::whereBetween('created_at', [$start_date, $end_date])->get();
        $total_profit_loss = Transaction_history::whereBetween('created_at', [$start_date, $end_date])->sum('profit_or_loss');
        $total_device_costing = Transaction_history::whereBetween('created_at', [$start_date, $end_date])->sum('device_costing');
        $total_sell_price = Transaction_history::whereBetween('created_at', [$start_date, $end_date])->sum('sell_price');
        $total_installation_cost = Transaction_history::whereBetween('created_at', [$start_date, $end_date])->sum('installation_cost');
        }

        return view('backend.device.transaction_history',compact('transaction_hisytory','total_profit_loss','total_device_costing','total_sell_price','total_installation_cost'));
    }


    public function device_transaction_history_date_single(Request $request)
    {
        $date = Carbon::parse($request->date)->startOfDay()->toDateTimeString();


        $transaction_hisytory = Transaction_history::whereDate('created_at', '=',$date)->get();
        $total_profit_loss = Transaction_history::whereDate('created_at', '=',$date)->sum('profit_or_loss');
        $total_device_costing = Transaction_history::whereDate('created_at', '=',$date)->sum('device_costing');
        $total_sell_price = Transaction_history::whereDate('created_at', '=',$date)->sum('sell_price');
        $total_installation_cost = Transaction_history::whereDate('created_at', '=',$date)->sum('installation_cost');
        return view('backend.device.transaction_history',compact('transaction_hisytory','total_profit_loss','total_device_costing','total_sell_price','total_installation_cost'));
    }



    public function technician_stock()
    {
        $technican = Technician::latest()->get();

        return view('backend.technician.technician_device_stock',compact('technican'));
    }

    public function ajax_search_for_assign_tech($id)
    {
        $device = technican_stock::where('technicain_id',$id)->get();
            return response()->json($device);
    }


}
