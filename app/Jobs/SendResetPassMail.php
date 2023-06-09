<?php

namespace App\Jobs;

use App\Mail\ResetPassNotify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendResetPassMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $data_user = [];
    public function __construct(array $data_user)
    {
        $this->data_user = $data_user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data_user = $this->data_user;
        Mail::to($data_user['email'])->send(new ResetPassNotify($data_user));
    }
}
