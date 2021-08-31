<?php

namespace App\Http\Controllers\Admin;

use App\Payment;
use App\payment_confarmation_history;
use App\technician_device_stock;
use App\Transaction_history;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class HistoryController extends Controller
{
    public function device_sell_history()
    {
        return view('backend.history.device_sell_history');
    }

    public function billing_history()
    {
        return view('backend.history.billing_confarmation_history');
    }

    public function billing_history_search_date(Request $request)
    {
        if ($request->ajax()) {
            $query = payment_confarmation_history::query();
            if ($request->start_date !== null and $request->end_date !== null) {
                $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
            }
            if ($request->phone !== null) {
                $query->whereHas('user', function ($query2) use ($request) {
                    $query2->where('phone', 'like', '%' . $request->phone . '%');
                });
            }
            if ($request->name !== null) {
                $query->whereHas('user', function ($query2) use ($request) {
                    $query2->where('name', 'like', '%' . $request->name . '%');
                });
            }
            if ($request->email !== null) {
                $query->whereHas('user', function ($query2) use ($request) {
                    $query2->where('email', 'like', '%' . $request->email . '%');
                });
            }
            $query->orderBy('created_at', 'DESC');
            return Datatables::of($query)
                ->setTotalRecords($query->count())
                ->addIndexColumn()
                ->addColumn('bill_collected', function ($data) {
                    return $data->bill_collected->name;
                })->addColumn('amount', function ($data) {
                    return $data->amount;
                })->addColumn('number_of_months', function ($data) {
                    return $data->number_of_months.' Months';
                })->addColumn('user', function ($data) {
                    if ($data->user) {
                        return '<a  href="' . url('admin/all_user/' . $data->user_id) . '" target="_blank">' . $data->user->name . '</a>';
                    }
                })->addColumn('time', function ($data) {
                    return date("d-M-y h:i A", strtotime($data->created_at));
                })->with('sum_balance', $query->sum('updated_amount'))
                ->rawColumns(['bill_collected','amount', 'user', 'time', 'number_of_months'])
                ->make(true);
        }
        
        
        
        
        
        
        
        
        
        $start_date = Carbon::parse($request->start_date)->startOfDay()->toDateTimeString();
        $end_date = Carbon::parse($request->end_date)->startOfDay()->toDateTimeString();
        if ($start_date == $end_date) {
            $billing = payment_confarmation_history::whereDate('created_at', '=', $start_date)->get();
            $total_pay_amount = payment_confarmation_history::whereDate('created_at', '=', $start_date)->sum('updated_amount');
        } else {
            $billing = payment_confarmation_history::whereBetween('created_at', [$start_date, $end_date])->get();
            $total_pay_amount = payment_confarmation_history::whereBetween('created_at', [$start_date, $end_date])->sum('updated_amount');
        }


        return view('backend.history.billing_confarmation_history', compact('billing', 'total_pay_amount'));
    }


    public function payment_by_online()
    {
        return view('backend.history.online_payment_history');

    }


    public function payment_by_online_search_date(Request $request)
    {
        if ($request->ajax()) {
            $query = payment::query()->where('status', 'Processing');
            if ($request->start_date !== null and $request->end_date !== null) {
                $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
            }
            if ($request->phone !== null) {
                $query->whereHas('user', function ($query2) use ($request) {
                    $query2->where('phone', 'like', '%' . $request->phone . '%');
                });
            }
            if ($request->name !== null) {
                $query->whereHas('user', function ($query2) use ($request) {
                    $query2->where('name', 'like', '%' . $request->name . '%');
                });
            }
            if ($request->email !== null) {
                $query->whereHas('user', function ($query2) use ($request) {
                    $query2->where('email', 'like', '%' . $request->email . '%');
                });
            }
            $query->orderBy('created_at', 'DESC');
            return Datatables::of($query)
                ->setTotalRecords($query->count())
                ->addIndexColumn()
                ->addColumn('amount', function ($data) {
                    return $data->amount;
                })->addColumn('number_of_months', function ($data) {
                    return $data->number_of_months.' Months';
                })->addColumn('user', function ($data) {
                    if ($data->user) {
                        return '<a  href="' . url('admin/all_user/' . $data->user->all_user->id) . '" target="_blank">' . $data->user->name . '</a>';
                    }
                })->addColumn('time', function ($data) {
                    return date("d-M-y h:i A", strtotime($data->created_at));
                })->with('sum_balance', $query->sum('amount'))
                ->rawColumns(['amount', 'user', 'time', 'number_of_months'])
                ->make(true);
        }
    }
}
