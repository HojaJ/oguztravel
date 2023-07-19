<?php

namespace App\Jobs;

use App\Mail\BirthDayMessage;
use App\Mail\DynamicMessage;
use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BirthdayEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $person;


    public $tries = 2;
    public $maxExceptions = 3;



    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email,$person)
    {
        $this->email = $email;
        $this->person = $person;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::mailer('smtp2')->to($this->email)->send(new BirthDayMessage($this->person));
    }
}
