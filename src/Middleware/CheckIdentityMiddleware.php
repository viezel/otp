<?php
declare(strict_types=1);

namespace Viezel\OTP\Middleware;

use Closure;
use Viezel\OTP\Actions\SendVerifyIdentityEmailAction;
use Viezel\OTP\OTP;

class CheckIdentityMiddleware
{
    public function handle($request, Closure $next)
    {
        $url = $request->getUri();
        $email = auth()->user()->email;

        if (! OTP::shouldVerify($url)) {
            return $next($request);
        }

        if (OTP::shouldGenerateCode($url)) {
            (new SendVerifyIdentityEmailAction)->handle($email, $url);
        }

        $request->session()->put('otp_url', $url);

        return redirect()->route('viezel.otp.verify');
    }
}
