<?php
declare(strict_types=1);

namespace Viezel\OTP\Controllers;

class VerifyIdentity
{
    public function __invoke()
    {
        return view('otp::verify-identity', [
            'url' => session()->get('otp_url'),
        ]);
    }
}
