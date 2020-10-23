<?php
declare(strict_types=1);

namespace Viezel\OTP;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Viezel\OTP\Middleware\CheckIdentityMiddleware;
use Viezel\OTP\Middleware\VerifyIdentityMiddleware;

class OTPServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/otp.php' => config_path('otp.php'),
            ], 'otp-config');

            $this->publishes([
                __DIR__ . '/../resources/views' => base_path('resources/views/vendor/otp'),
            ], 'otp-views');

            $migrationFileName = 'create_otp_table.php';
            if (! $this->migrationFileExists($migrationFileName)) {
                $this->publishes([
                    __DIR__ . "/../database/migrations/{$migrationFileName}.stub" => database_path('migrations/' . date('Y_m_d_His', time()) . '_' . $migrationFileName),
                ], 'migrations');
            }
        }

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'otp');

        $this->registerMiddlewares();

        if (OTP::$registersRoutes) {
            $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/otp.php', 'otp');
    }

    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }

    public function registerMiddlewares()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('check_otp', CheckIdentityMiddleware::class);
        $router->aliasMiddleware('verify_otp', VerifyIdentityMiddleware::class);
    }
}
