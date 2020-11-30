<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMailRegister implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $token;
    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
