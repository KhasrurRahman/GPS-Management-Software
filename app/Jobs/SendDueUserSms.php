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
        foreach ($this->data as $value) {
            $user = AllUser::findOrFail($value->id);
            $previous_due_history = payment_history::where('user_id', $user->id)->where('payment_status', 0)->get();
            if ($previous_due_history->count() !== 0) {
                $number_of_due_first_month = date("F", strtotime($previous_due_history->last()->month_name));
                $number_of_due_last_month = date("F", strtotime($previous_due_history->first()->month_name));
            } else {
                $number_of_due_first_month = '  ';
                $number_of_due_last_month = '  ';
            }
            $total_due_money = $previous_due_history->count() * $user->monthly_bill;
            $message = "Your Connection has been expired. Please pay the due bill to active your connection. Your total due bill is $total_due_money tk from $number_of_due_first_month - $number_of_due_last_month. If you need any further information please contact our care number ( 01713546487)";
            $number[] = $value->phone;
            send_sms($message, $number);
        }
    }
}
