<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgotPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $code;
    protected $fullname;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code,$fullname)
    {
        $this->code = $code;
        $this->fullname = $fullname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail')->with([
            'code' => $this->code,
            'fullname' => $this->fullname,
        ]);
    }
}
