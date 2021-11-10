<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Notifications\ReminderVerificationEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;

class SendEmailToNonVerifiedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send-non-verified-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email for Non Verified Users.';

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
     * @return int
     */
    public function handle()
    {
        //return Command::SUCCESS;
        $users = User::unverified()->get();
        foreach ($users as $user){
            Notification::send($user, new ReminderVerificationEmail($user));
        }
    }
}
