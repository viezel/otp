<?php
declare(strict_types=1);

namespace Viezel\OTP;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
}
