<?php
declare(strict_types=1);

namespace Viezel\OTP\Controllers;

use Illuminate\Http\Request;

class VerifyIdentity
{
    public function __invoke()
    {
        return view('otp::verify-identity');
    }
}
