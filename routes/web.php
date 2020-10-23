<?php
declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Viezel\OTP\Middleware\VerifyIdentityMiddleware;

Route::middleware(config('opt.route_middleware'))
    ->prefix(config('opt.route_prefix'))
    ->group(function () {
        Route::get('verify', Viezel\OTP\Controllers\VerifyIdentity::class)
            ->name('viezel.otp.verify');

        Route::post('verify', Viezel\OTP\Controllers\VerifyIdentity::class)
            ->name('viezel.otp.verify_identity')
            ->middleware(VerifyIdentityMiddleware::class);

        Route::get('verify/resend', Viezel\OTP\Controllers\ResendVerifyIdentity::class)
            ->name('viezel.otp.verify_identity.resend');
    });
