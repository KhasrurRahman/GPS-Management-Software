<?php

use GuzzleHttp\Client;
use Illuminate\Support\Carbon;

function send_sms($message, $mobile_number)
{
    $params = [
        "api_token" => 'ratin-788f2c73-802d-4d90-987e-4ae9ff0cc3e4',
        "sid" => 'SAFETYGPSMASK_1',
        "msisdn" => $mobile_number,
        "sms" => $message,
        "batch_csms_id" => '2934fe343'
    ];
    $url = trim('https://smsplus.sslwireless.com', '/') . "/api/v3/send-sms/bulk";
    $params = json_encode($params);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($params), 'accept:application/json'));
    $response = curl_exec($ch);
    curl_close($ch);
    print_r($response);
}


function api_cinfig()
{
    return $key = 'A7A2CBE63242A5AB2519F13FA72DCA21';
}
function user_api_key($email)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&key=' . api_cinfig() . '&cmd=GET_USER_API_KEY,' . $email, CURLOPT_USERAGENT => 'Sample cURL Request'));
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}

function check_user($email)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&key=' . api_cinfig() . '&cmd=CHECK_USER_EXISTS,' . $email, CURLOPT_USERAGENT => 'Sample cURL Request'));
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}

function add_user($email)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&key=' . api_cinfig() . '&cmd=ADD_USER,' . $email . ',true', CURLOPT_USERAGENT => 'Sample cURL Request'));
    $resp = curl_exec($curl);
    curl_close($curl);
    dd($resp);
}


function delete_user($email)
{
    if (check_user($email) == 'true') {
        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&key=' . api_cinfig() . '&cmd=DEL_USER,' . $email, CURLOPT_USERAGENT => 'Sample cURL Request'));
        $resp = curl_exec($curl);
        curl_close($curl);
    } else {
        return 'user not found';
    }
}

function user_objects($email)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=user&ver=1.0&key=' . user_api_key($email) . '&cmd=USER_GET_OBJECTS'));
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}

function deactive_user_objects($imei)
{
    $expaire_date = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now())->toDateString();
    foreach ($imei as $key => $value) {
        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&key=' . api_cinfig() . '&cmd=OBJECT_SET_ACTIVITY,' . $value . ',false,true,' . $expaire_date . ''));
        $resp = curl_exec($curl);
        curl_close($curl);
    }
}


function active_user_objects($imei,$expaire_date)
{
    foreach ($imei as $key => $value) {
        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&key=' . api_cinfig() . '&cmd=OBJECT_SET_ACTIVITY,' . $value . ',true,true,' . $expaire_date . ''));
        $resp = curl_exec($curl);
        curl_close($curl);
    }
}
