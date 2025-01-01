<?php

namespace App\Services\Email;

interface MailServiceInterface
{
    public function sendMail($to, $template);
}
