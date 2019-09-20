<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // custom validation rule to check for valid domain in email
        Validator::extend('is_valid_domain', function($attribute, $value, $parameter, $validator) {
            $domain = substr($value, strpos($value, '@') + 1);
            if  (checkdnsrr($domain) !== FALSE) {
                return true;
            } else {
                return false;
            }
        });
    }
}
