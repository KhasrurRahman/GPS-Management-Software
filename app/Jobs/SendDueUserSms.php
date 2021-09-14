<?php

namespace App\Jobs;

use App\AllUser;
use App\payment_history;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendDueUserSms implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $key=>$value) {
            $user = AllUser::findOrFail($value->id);
            $previous_due_history = payment_history::where('user_id', $user->id)->where('payment_status', 0)->get();
            $total_due_money = $previous_due_history->count() * $user->monthly_bill;
            $message = "Your monthly bill $total_due_money taka was due. Please pay the bill before expire your connection. bkash- 01713546487. Your ref. Id is- $value->id";
            $number[] = $value->phone;
            $this->send_sms($message, $number);
            print_r('----->>>'.$key++);
        }
    }


    private function send_sms($message, $mobile_number)
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
        print_r($response.'--------------------');
    }
}
