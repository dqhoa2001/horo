<?php

namespace App\Console\Commands;

use App\Jobs\SendRemindPurchaseMail;
use Illuminate\Console\Command;

class ReminderPurchaseSolar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ReminderPurchaseSolar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '太陽光発電の購入をリマインダーするコマンド';

    public function __construct(
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        SendRemindPurchaseMail::dispatch();
    }
}
