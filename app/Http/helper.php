<?php

use GuzzleHttp\Client;

function send_sms($message, $mobile_number)
{
    $number = implode('|', $mobile_number);
    $data = array(
        'user' => 'safetygps',
        'pass' => '22p>7E36',
        'sid' => 'SafetyGPS',
        'sms' => $message,
        'msisdn' => $number,
        'csmsid' => '123456789',
    );
    $url = "http://sms.sslwireless.com/pushapi/dynamic/server.php";
    $handle = curl_init($url);
    curl_setopt($handle, CURLOPT_POST, true);
    curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
    curl_exec($handle);
    curl_close($handle);
    dd($url);
}


function send_sms2()
{
    $user = "safetygps";
    $pass = "22p>7E36";
    $sid = "SafetyGPS";
    $url = "http://sms.sslwireless.com/pushapi/dynamic/server.php";
    $param = "user=$user&pass=$pass&sms[0][0]= 8801761955765 &sms[0][1]=" . urlencode("Test 
SMS 1") . "&sid=$sid";
    $crl = curl_init();
    curl_setopt($crl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($crl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl, CURLOPT_HEADER, 0);
    curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($crl, CURLOPT_POST, 1);
    curl_setopt($crl, CURLOPT_POSTFIELDS, $param);
    $response = curl_exec($crl);
    curl_close($crl);
    dd($response);
}

function api_cinfig()
{
    return 'key=A7A2CBE63242A5AB2519F13FA72DCA21';
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
        curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://safetyvts.com/api/api.php?api=server&ver=1.0&' . api_cinfig() . '&cmd=ADD_USER,' . $email.',true', CURLOPT_USERAGENT => 'Sample cURL Request'));
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

function object_set_activity()
{
    https://safetyvts.com/api/api.php?api=server&ver=1.0&key=A7A2CBE63242A5AB2519F13FA72DCA21&cmd=USER_GET_OBJECTS
}



//https://safetyvts.com/api/api.php?api=server&ver=1.0&key=A7A2CBE63242A5AB2519F13FA72DCA21&cmd=CHECK_USER_EXISTS,ratin@gmail.com

//https://safetyvts.com/api/api.php?api=server&ver=1.0&key=A7A2CBE63242A5AB2519F13FA72DCA21&cmd=OBJECT_SET_ACTIVITY,1256315271,true,true,2021-10-01