<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        \Blade::if('hasAccess', function (string $value) {

            if (auth()->check()) {
                return auth()->user()->hasAccess($value);
            }

            return false;
        });

    }
}
