<?php
declare(strict_types=1);

namespace Viezel\OTP\Middleware;

use Closure;
use Viezel\OTP\OTP;

class VerifyIdentityMiddleware
{
    public function handle($request, Closure $next)
    {
        $url = $request->input('url');
        $result = OTP::validate($url, (int)$request->input('code'));

        if (! $result) {
            return back()
                ->withInput($request->input())
                ->withErrors(['code', 'The verification code is not valid']);
        }

        OTP::setVerified($url);

        return redirect($url);
    }
}
