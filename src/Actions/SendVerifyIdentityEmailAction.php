<?php
declare(strict_types=1);

namespace Viezel\OTP\Actions;

use Illuminate\Support\Facades\Mail;
use Viezel\OTP\Mails\VerifyIdentityEmail;
use Viezel\OTP\OTP;

class SendVerifyIdentityEmailAction
{
    public function handle(string $email, string $url)
    {
        $verificationCode = OTP::generateCodeForUrl($url);

        if (config('otp.use_queue') === true) {
            Mail::to($email)->queue(new VerifyIdentityEmail($verificationCode));
        } else {
            Mail::to($email)->send(new VerifyIdentityEmail($verificationCode));
        }
    }
}
