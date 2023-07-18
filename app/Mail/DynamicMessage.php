<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DynamicMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Email From Oguz Travel';

    protected $html;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($html)
    {
        $this->html = $html;
    }

    public function build()
    {
        return $this->view($this->html);
    }

}
