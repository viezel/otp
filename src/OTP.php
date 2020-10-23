<?php
declare(strict_types=1);

namespace Viezel\OTP;

use Illuminate\Support\Facades\Date;
use Viezel\OTP\Models\OneTimePassword;

class OTP
{
    /**
     * Indicates if routes will be registered.
     *
     * @var bool
     */
    public static $registersRoutes = true;

    public static function shouldVerify(string $url): bool
    {
        $verifiedAt = time() - request()->session()->get('otp.email_verified_at_'. $url, 0);

        return $verifiedAt > config('otp.validation_expires_after_minutes');
    }

    public static function setVerified(string $url): void
    {
        request()->session()->put('otp.email_verified_at_'. $url, time());
    }

    public static function validate(string $url, int $code): bool
    {
        return OneTimePassword::query()
            ->where('url', $url)
            ->where('code', $code)
            ->where('expires_at', '>', Date::now())
            ->exists();
    }

    public static function shouldGenerateCode(string $url): bool
    {
        return ! self::hasValidCode($url);
    }

    public static function hasValidCode(string $url): bool
    {
        return OneTimePassword::query()
            ->where('url', $url)
            ->where('expires_at', '>', Date::now())
            ->exists();
    }

    public static function generateCodeForUrl(string $url): int
    {
        $code = mt_rand(100000, 999999);

        OneTimePassword::create([
            'url' => $url,
            'code' => $code,
            'expires_at' => Date::now()->addMinutes(config('otp.link_expires_in_minutes')),
        ]);

        return $code;
    }
}
