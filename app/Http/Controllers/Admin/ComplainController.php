<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Complain;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ComplainController extends Controller
{
    public function all_complain()
    {
        return view('backend.complain.complain');
    }

    public function complain_search(Request $request)
    {
        if ($request->ajax()) {
            $query = Complain::query();
            $query->orderBy('created_at', 'DESC');
            return Datatables::of($query)
                ->setTotalRecords($query->count())
                ->addIndexColumn()
                ->addColumn('name', function ($data) {
                    return $data->name;
                })->addColumn('email', function ($data) {
                    return $data->email;
                })->addColumn('phone', function ($data) {
                    return $data->phone;
                })->addColumn('complain', function ($data) {
                    return $data->description;
                })->addColumn('time', function ($data) {
                    return date("d-M-y h:i A", strtotime($data->created_at));
                })->addColumn('action', function ($data) {
                    $action_button = $data->status !== 'Solved' ? '<a class="btn btn-success btn-sm" href="' . url('admin/solve_complain/' . $data->id) . '">Solve it</a>' : '<a class="btn btn-info btn-sm disabled" href="">Solved</a>';
                    return $action_button;
                })
                ->rawColumns(['name', 'email', 'phone', 'complain', 'time', 'action'])
                ->make(true);
        }
    }

    public function solve_complain($id)
    {
        $complain = Complain::find($id);
        $complain->status = 'Solved';
        $complain->update();
        
//        $curl = curl_init();
//        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Hi,'.$user->name.' this is to confirm that your technical issue has been resolved. If you have any questions, please contact us at 01713546487. Thank you.”').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
//        $resp = curl_exec($curl);
//        curl_close($curl);

        Toastr::success('Complain solved Successfully', 'Success');
        return redirect()->back();
    }
}
