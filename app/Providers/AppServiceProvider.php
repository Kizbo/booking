<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!app()->runningInConsole()) {
            $site_settings = Setting::all()->mapWithKeys(fn (Setting $setting) => [$setting->name => $setting->value]);
            Config::set("site_settings", $site_settings);
            View::share("site_settings", $site_settings);

            Validator::extend('phone_number', function ($attribute, $value, $parameters) {
                return preg_match("/^\+[0-9]{7,12}$/", $value) === 1;
            });
        }
    }
}
