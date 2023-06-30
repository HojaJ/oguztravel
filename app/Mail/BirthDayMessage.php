<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BirthDayMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Email From Oguz Travel';

    protected $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('mail.birthday')->with(['data'=>$this->data]);
    }

}
