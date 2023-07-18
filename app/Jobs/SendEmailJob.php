<?php

namespace App\Jobs;

use App\Mail\DynamicMessage;
use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $view;


    public $tries = 2;
    public $maxExceptions = 3;



    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$view)
    {
        $this->email = $email;
        $this->view = $view;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::mailer('private')->to($this->email)->send(new DynamicMessage($this->view));
    }
}
