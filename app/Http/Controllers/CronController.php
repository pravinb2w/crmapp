<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use Illuminate\Http\Request;

class CronController extends Controller
{
    public function sendMail(Request $request)
    {
        $details = [
            'con' => 'Test Notification'
        ];

        $job = (new SendMailJob($details))
            ->delay(now()->addSeconds(5));

        dispatch($job);
        echo "Mail send successfully !!";
    }
}