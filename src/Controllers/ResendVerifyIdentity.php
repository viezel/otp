<?php
declare(strict_types=1);

namespace Viezel\OTP\Controllers;

use Viezel\OTP\Actions\SendVerifyIdentityEmailAction;

class ResendVerifyIdentity
{
    public function __invoke()
    {
        $url = session('otp_url');
        $email = auth()->user()->email;
        (new SendVerifyIdentityEmailAction)->handle($email, $url);

        return back()->with(['success' => 'Verification email has been sent']);
    }
}
