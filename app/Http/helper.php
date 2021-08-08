<?php

use GuzzleHttp\Client;

function send_sms($message, $mobile_number)
{
    $params = [
        "api_token" => 'ratin-788f2c73-802d-4d90-987e-4ae9ff0cc3e4',
        "sid" => 'SAFETYGPSMASK',
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
    dd($response);
}


function api_cinfig()
{
    return 'key=A7A2CBE63242A5AB2519F13FA72DCA21';
}
function user_api_key($email)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&' . api_cinfig() . '&cmd=GET_USER_API_KEY,' . $email, CURLOPT_USERAGENT => 'Sample cURL Request'));
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}

function check_user($email)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&' . api_cinfig() . '&cmd=CHECK_USER_EXISTS,' . $email, CURLOPT_USERAGENT => 'Sample cURL Request'));
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}

function add_user($email)
{
    $curl = curl_init();
    curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&' . api_cinfig() . '&cmd=ADD_USER,' . $email . ',true', CURLOPT_USERAGENT => 'Sample cURL Request'));
    $resp = curl_exec($curl);
    curl_close($curl);
    dd($resp);
}


function delete_user($email)
{
    if (check_user($email) == 'true') {
        $curl = curl_init();
        curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&' . api_cinfig() . '&cmd=DEL_USER,' . $email, CURLOPT_USERAGENT => 'Sample cURL Request'));
        $resp = curl_exec($curl);
        curl_close($curl);
    } else {
        return 'user not find';
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



//https://safetyvts.com/api/api.php?api=server&ver=1.0&key=A7A2CBE63242A5AB2519F13FA72DCA21&cmd=CHECK_USER_EXISTS,ratin@gmail.com

//https://safetyvts.com/api/api.php?api=server&ver=1.0&key=A7A2CBE63242A5AB2519F13FA72DCA21&cmd=OBJECT_SET_ACTIVITY,1256315271,true,true,2021-10-01