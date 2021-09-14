<?php

namespace App\Console\Commands;

use App\AllUser;
use App\Jobs\SendDueUserSms;
use Illuminate\Console\Command;

class SendDueUaserSmsCommend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendReminderSMSCommend';

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
        $users = AllUser::where('payment_status',0)->where('order_status',0)->where('expair_status',0)->where('status',null)->chunk(50, function ($users) {
           SendDueUserSms::dispatch($users);
        });
    }
}
