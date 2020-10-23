<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Viezel\OTP\Middleware\VerifyIdentityMiddleware;

Route::middleware(config('otp.route_middleware'))
    ->prefix(config('otp.route_prefix'))
    ->group(function () {
        Route::get('verify', Viezel\OTP\Controllers\VerifyIdentity::class)
            ->name('viezel.otp.verify');

        Route::post('verify', Viezel\OTP\Controllers\VerifyIdentity::class)
            ->name('viezel.otp.verify_identity')
            ->middleware(VerifyIdentityMiddleware::class);

        Route::get('verify/resend', Viezel\OTP\Controllers\ResendVerifyIdentity::class)
            ->name('viezel.otp.verify_identity.resend');
    });
