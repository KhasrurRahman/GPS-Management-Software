<?php

namespace App\Jobs;

use App\AllUser;
use App\payment_history;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class DueUserProfileUpdate1 implements ShouldQueue
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
        $one_months_plus = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->firstOfMonth()->addMonths()->firstOfMonth();
        $now = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->firstOfMonth();
        
        foreach ($this->data as $data) {
            $user = AllUser::find($data->id);
            $user->next_payment_date = $one_months_plus;
            $user->payment_status = 0;
            $user->update();

            $payment_history = new payment_history();
            $payment_history->user_id = $user->id;
            $payment_history->month_name = $now;
            $payment_history->total_paid_until_this_date = '';
            $payment_history->total_due = $user->monthly_bill;
            $payment_history->payment_status = 0;
            $payment_history->nest_payment_date = $user->next_payment_date;
            $payment_history->save();
        }
    }
}
