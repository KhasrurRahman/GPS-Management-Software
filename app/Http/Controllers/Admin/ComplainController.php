<?php

namespace App\Http\Controllers\Admin;

use App\AllUser;
use App\Complain;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplainController extends Controller
{
    public function all_complain()
    {
        $complain = Complain::latest()->get();
        return view('backend.complain.complain',compact('complain'));
    }

    public function solve_complain($id)
    {
        $complain = Complain::find($id);
        $complain->status = 'Solved';
        $complain->update();

        $user = AllUser::find($complain->user_id);

        $curl = curl_init();
        curl_setopt_array($curl, array( CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://sms.sslwireless.com/pushapi/dynamic/server.php?user=safetygps&pass=22p>7E36&sid=SafetyGPS&sms='.urlencode('Hi,'.$user->name.' this is to confirm that your technical issue has been resolved. If you have any questions, please contact us at 01713546487. Thank you.”').'&msisdn=88'.$user->phone.'&csmsid=123456789', CURLOPT_USERAGENT => 'Sample cURL Request' ));
        $resp = curl_exec($curl);
        curl_close($curl);

        Toastr::success('Complain solved Successfully','Success');
        return redirect()->back();
    }
}
