<?php

namespace App\Providers;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Blade::directive('nonce', function () {
            return "<?php echo session('nonce', null) ?? ''; ?>";
        });
        Blade::if('subdomain', function ($value = '') {
            $route = str_replace('https://', '', str_replace('http://', '', request()->root()));
            return $value && Str::startsWith($route, $value) || !$value && (!$route || $route == 'www');
        });
    }
}