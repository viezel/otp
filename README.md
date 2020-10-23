# One Time Password for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/viezel/otp.svg?style=flat-square)](https://packagist.org/packages/viezel/otp)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/viezel/otp/run-tests?label=tests)](https://github.com/viezel/otp/actions?query=workflow%3Arun-tests+branch%3Amaster)

This package is sending out a 6 digit verification code per email, when a user visits a route in your Laravel app.
The only thing you will have to do.

## Installation

1. You can install the package via composer:

```bash
composer require viezel/otp
php artisan vendor:publish --provider="Viezel\OTP\OTPServiceProvider" --tag="migrations"
php artisan migrate
```

2. Register the Middlewares in `app/Http/Kernal.php`

```php
protected $routeMiddleware = [
    'check_otp' => \Viezel\OTP\Middleware\CheckIdentityMiddleware::class,
    'verify_otp' => \Viezel\OTP\Middleware\VerifyIdentityMiddleware::class,
];   
```

3. Add Middleware `check_otp` to the routes that should verify the User Identity. 


```php
Route::get('some/protected/route', App\Http\Controllers\MyController::class)->middleware(['auth', 'check_otp']);
Route::get('other/route', App\Http\Controllers\MyOtherController::class)->middleware(['auth', 'check_otp']);
```

4. Add the following routes to your app. 

```php
Route::middleware('auth')->group(function() {
    Route::post('verify', Viezel\OTP\Controllers\VerifyIdentity::class)->name('viezel.otp.verify_identity')->middleware('verify_otp');
    Route::get('verify', Viezel\OTP\Controllers\VerifyIdentity::class)->name('viezel.otp.verify');
    Route::get('verify/resend', Viezel\OTP\Controllers\ResendVerifyIdentity::class)->name('viezel.otp.verify_identity.resend');
});
```

## Config

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Viezel\OTP\OTPServiceProvider" --tag="otp-config"
```


```php
return [
    /*
     * How long time in minutes should the verification code be valid for
     */
    'link_expires_in_minutes' => 300,

    /*
     * How long time in minutes should the user be verified for the certain route
     */
    'validation_expires_after_minutes' => 30,

    /*
     * Should be use the queue to sent out the verification email
     */
    'use_queue' => false,
];
```

### Customize

You can build up your own verification view. Just publish the views and change what you need. 

The package provides a blade component to reuse. Its based on Alpine.js and Tailwind CSS.  

```html
<x-otp::pincode></x-otp::pincode>
```

## Testing

``` bash
composer test
```

## Credits

- [Mads Møller](https://github.com/viezel)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
