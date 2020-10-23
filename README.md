# One Time Password for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/viezel/otp.svg?style=flat-square)](https://packagist.org/packages/viezel/otp)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/viezel/otp/run-tests?label=tests)](https://github.com/viezel/otp/actions?query=workflow%3Arun-tests+branch%3Amaster)

This package is sending out a 6 digit verification code per email, when a user visits a route in your Laravel app. 

## Installation

1. Install the package via composer:

```bash
composer require viezel/otp
php artisan vendor:publish --provider="Viezel\OTP\OTPServiceProvider" --tag="migrations"
php artisan migrate
```

2. Add Middleware `check_otp` to the routes that should verify the User Identity. 

```php
Route::get('some/protected/route', MyController::class)->middleware(['auth', 'check_otp']);
Route::get('other/route', MyOtherController::class)->middleware(['auth', 'check_otp']);
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

    /*
     * Route Prefix
     */
    'route_prefix' => '',

    /*
     * Route Middleware
     */
    'route_middleware' => ['auth'],
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
