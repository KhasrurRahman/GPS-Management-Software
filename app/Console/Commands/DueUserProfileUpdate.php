<?php

namespace App\Console\Commands;

use App\AllUser;
use App\Jobs\DueUserProfileUpdate1;
use App\Jobs\DueUserProfileUpdate2;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class DueUserProfileUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DueUserProfileUpdate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $one_months_plus = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->firstOfMonth()->addMonths()->firstOfMonth();
        $now = Carbon::createFromFormat('Y-m-d', Carbon::now()->toDateString())->firstOfMonth();
        
        $total_due_user = AllUser::where('next_payment_date', '<=', $now)->where('status',null)->chunk(50, function ($total_due_user) {
           DueUserProfileUpdate1::dispatch($total_due_user);
        });
        
        $this_months_paid = AllUser::where('next_payment_date', '=', $one_months_plus)->where('payment_status', 0)->where('status',null)->chunk(50, function ($this_months_paid) {
           DueUserProfileUpdate2::dispatch($this_months_paid);
        });
    }
}
