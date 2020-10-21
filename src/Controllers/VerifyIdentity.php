<?php
declare(strict_types=1);

namespace Viezel\OTP\Controllers;

use Illuminate\Http\Request;
use Viezel\OTP\OTP;
use Viezel\OTP\Actions\SendVerifyIdentityEmailAction;

class VerifyIdentity
{
    public function __invoke(Request $request)
    {
        $url = request()->getUri();
        $email = auth()->user()->email;

        if (OTP::shouldGenerateCode($url)) {
            (new SendVerifyIdentityEmailAction)->handle($email, $url);
        }

        return view('verify-identity');
    }
}
