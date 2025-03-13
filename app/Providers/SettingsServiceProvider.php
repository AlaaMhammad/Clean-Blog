<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // get settings from database by key and value and put it to cache after that share to components/layout page
        // $settings = Setting::where('is_active', 1)->get();
        // $settings = $settings->map(function ($setting) {
        //     return [
        //         'key' => $setting->key,
        //         'value' => $setting->value,
        //     ];
        // });
        // $settings = $settings->toArray();
        Cache::remember('settings', 3600, function () {
            return Setting::pluck('value', 'key')->toArray();
        });
        // view()->share('settings', $settings);
    }
}
