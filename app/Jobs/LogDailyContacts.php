<?php

namespace App\Jobs;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class LogDailyContacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $createdContacts = Contact::whereDate('created_at', today())->count();
        $updatedContacts = Contact::whereDate('updated_at', today())->count();
        $log = "Contacts created today: {$createdContacts} \nContacts updated today: {$updatedContacts}";
        // store the log in a file
        file_put_contents(storage_path('logs/daily-contacts.log'), $log);
    }
}
