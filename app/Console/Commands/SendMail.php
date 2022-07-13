<?php

namespace App\Console\Commands;

use App\Jobs\SendMailJob;
use Illuminate\Console\Command;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:cronMail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Artisan commands to send mail every minutes based on database entries';

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
        $details = [
            'con' => 'Test Notification'
        ];

        $job = (new SendMailJob($details))
            ->delay(now()->addSeconds(5));

        dispatch($job);
        info('mail task running');
    }
}