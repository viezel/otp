# One Time Password for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/viezel/otp.svg?style=flat-square)](https://packagist.org/packages/viezel/otp)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/viezel/otp/run-tests?label=tests)](https://github.com/viezel/otp/actions?query=workflow%3Arun-tests+branch%3Amaster)


## Installation

You can install the package via composer:

```bash
composer require viezel/otp
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Viezel\OTP\OTPServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Viezel\OTP\OTPServiceProvider" --tag="config"
```


## Usage

1. Register the Middlewares in `app/Http/Kernal.php`

```php
protected $routeMiddleware = [
    'verify_otp' => \Viezel\OTP\Middleware\VerifyIdentityMiddleware::class
];   
```

2. Add the following routes to your app. 

Lets say you have a route `/some-protected-route` and want to have a Verification on each visit to this route. You can point the GET route to
`Viezel\OTP\Controllers\VerifyIdentity` as shown below. 
Your application route should then be the POST route instead. Because we validate the request in the middleware `verify_otp`. 

```php
Route::post('some-protected-route', App\Http\Controllers\MyController::class)->name('viezel.otp.verify_identity')->middleware('verify_otp');
Route::get('some-protected-route', Viezel\OTP\Controllers\VerifyIdentity::class)->name('frontend.share.shorturl');
Route::get('verify/resend', Viezel\OTP\Controllers\ResendVerifyIdentity::class)->name('viezel.otp.verify_identity.resend');
```

3. Optional: You can build up your own verification view. The package provides a blade component to reuse. Its based on Alpine.js and Tailwind CSS.  

```html
<x-otp-pincode></x-otp-pincode>
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
