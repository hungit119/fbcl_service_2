<?php

namespace App\Services\Email;

use App\Services\BaseService;
use Illuminate\Support\Facades\Mail;

class MailService extends BaseService implements MailServiceInterface
{
    public function __construct()
    {
    }
    public function sendMail($to, $template){
        Mail::to($to)->send($template);
    }
}
