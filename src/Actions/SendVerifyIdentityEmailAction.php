<?php
declare(strict_types=1);

namespace Viezel\OTP\Actions;

use Illuminate\Support\Facades\Mail;
use Viezel\OTP\OTP;
use Viezel\OTP\Mails\VerifyIdentityEmail;

class SendVerifyIdentityEmailAction
{
    public function handle(string $email, string $url)
    {
        $verificationCode = OTP::generateCodeForUrl($url);

        Mail::to($email)->queue(new VerifyIdentityEmail($verificationCode));
    }

}
