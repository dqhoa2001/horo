<?php

namespace App\Jobs;

use App\Mail\User\ReminderPurchaseSolar;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRemindPurchaseMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $now = now()->addMonths(3)->format('m-d');
        $reminderUsers = User::where('birthday', 'LIKE', '%' . $now . '%')->get();
        foreach ($reminderUsers as $user) {
            Mail::to($user->email)->send(new ReminderPurchaseSolar($user));
        }
    }
}
